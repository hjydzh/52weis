<?php
namespace control;
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
require_once get_include_path().'/52weis/src/common/DateUtils.php';
require_once get_include_path().'/52weis/src/dao/JianDao.php';
require_once get_include_path().'/52weis/src/common/commonUtil.php';
require_once get_include_path().'/52weis/src/common/Constants.php';
use \common\PublicConstants;
use \common\Constants;
use \Exception;
class JianControlle {
	
	
	public function main(){
		$date = '20'.yestday(Constants::$TIME_FORMART_Y_M_D);
		$blogs = query_hot_blogs(10, $date);
		$redis = new \Redis();
		$redis->connect(PublicConstants::$IP, 6379);
		$redis->auth(PublicConstants::$REDIS_PASSWD);
		$blog_nums = self::query_date_blogs_nums_cache($date, $redis);
		$author_nums = self::query_date_author_nums_cache($date,$redis);
		$morning_nums = self::query_blogs_nums_date_cache("morning_nums", $date." 00:00:00", $date." 07:59:59", $redis);
		$mid_nums = self::query_blogs_nums_date_cache("mid_nums",$date." 08:00:00", $date." 15:59:59", $redis);
		$night_nums = self::query_blogs_nums_date_cache("night_nums",$date." 16:00:00", $date." 23:59:59", $redis);
		$show_time = self::query_show_time_cache($date,$redis);
		$read_rate = self::query_read_rate_cache($date,$redis);
		$date_list =self::get_date_list($date, 7);
		$date_list_str = print_array_js($date_list);
		$week_blog_nums = print_array_js(self::week_blog_nums($date_list, $redis));
		$week_show_times = print_array_js(self::week_show_times($date_list, $redis));
		$week_rate = print_array_js(self::week_rate($date_list, $redis));
		require_once get_include_path().PublicConstants::$JIAN_PATH;
	}
	
	public function detail(){
		$blog_id = "/p/".$_GET["id"];
		$view_str = query_views_by_url($blog_id);
		if(empty($view_str) || $view_str=="null"){
			require_once get_include_path().PublicConstants::$DETAIL_PATH;
			return;
		}
		$views_array = json_to_array($view_str);
		$time = print_array_js(array_keys($views_array));
		$views = print_array_js(array_values($views_array));
		require_once get_include_path().PublicConstants::$DETAIL_PATH;
	}
	
	private function week_blog_nums($date_list, $redis){
		$week_blog_nums = Array();
		foreach ($date_list as $date){
			array_push($week_blog_nums, self::query_date_blogs_nums_cache($date, $redis));
		}
		return $week_blog_nums;
	}
	
	private function week_rate($date_list, $redis){
		$week_rate = Array();
		foreach ($date_list as $date){
			array_push($week_rate, intval(self::query_read_rate_cache($date, $redis)[1]));
		}
		return $week_rate;
	}
	
	private function week_show_times($date_list, $redis){
		$week_show_times = Array();
		foreach ($date_list as $date){
			$redis_key = "php:show_time:avg:".$date;
			$show_time = $redis->get($redis_key);
			if(empty($show_time)){
				$show_time = query_show_time($date)[1];
				$redis->set($redis_key, $show_time);
				$redis->setTimeout($redis_key, 25*60*60);
			}
			array_push($week_show_times, intval($show_time/60));
		}
		return $week_show_times;
	}
	
	private function query_read_rate_cache($date, $redis){
		$redis_key_before = "php:read_rate:before:".$date;
		$redis_key_after = "php:read_rate:after:".$date;
		$read_rate_before = $redis->get($redis_key_before);
		if (empty($read_rate_before)){
			$read_rate= query_read_rate($date);
			$redis->set($redis_key_before, $read_rate[0]);
			$redis->set($redis_key_after, $read_rate[1]);
			$redis->setTimeout($redis_key_before, 25*60*60);
			$redis->setTimeout($redis_key_after, 25*60*60);
		}else {
			$read_rate = [$read_rate_before, $redis->get($redis_key_after)];
		}
		return $read_rate;
	}
	
	private function get_date_list($date, $num){
		$date_list = Array();
		for($i=0; $i<$num; $i++){
			array_push($date_list, "20".date_substract_date(Constants::$TIME_FORMART_Y_M_D, $date, $i));
		}
		return array_reverse($date_list);
	}
	
	private function query_show_time_cache($date, $redis){
		$redis_key = "php:show_time:".$date;
		$show_time = $redis->lRange($redis_key, 0, -1);
		if (empty($show_time)){
			$show_time = query_show_time($date);
			$redis->lPush($redis_key, $show_time[2]);
			$redis->lPush($redis_key, $show_time[1]);
			$redis->lPush($redis_key, $show_time[0]);
			$redis->set("php:show_time:avg:".$date, $show_time[1]);
			$redis->setTimeout($redis_key, 25*60*60);
		}
		return $show_time;
	}
	
	private function query_date_author_nums_cache($date, $redis){
		$redis_key = "php:author_nums:".$date;
		$author_nums = $redis->get($redis_key);
		if (empty($author_nums)){
			$author_nums = query_date_author_nums($date);
			$redis->set($redis_key, $author_nums);
			$redis->setTimeout($redis_key, 25*60*60);
		}
		return $author_nums;
	}
	
	private function query_blogs_nums_date_cache($key, $start, $end, $redis){
		$redis_key = "php:".$key.":".$start;
		$nums = $redis->get($redis_key);
		if (empty($nums)){
			$nums = query_blogs_nums_date($start, $end);
			$redis->set($redis_key, $nums);
			$redis->setTimeout($redis_key, 25*60*60);
		}
		return $nums;
	}
	
	
	private function query_date_blogs_nums_cache($date, $redis){
		$redis_key = "php:blog_nums:".$date;
		$blogs_nums = $redis->get($redis_key);
		if (empty($blogs_nums)){
			$blogs_nums = query_date_blogs_nums($date);
			$redis->set($redis_key, $blogs_nums);
			$redis->setTimeout($redis_key, 25*60*60);
		}
		return $blogs_nums;
	}
	
}


?>