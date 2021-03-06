<?php
namespace control;
require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
require_once get_include_path().'/52weis/src/service/JobService.php';
require_once get_include_path().'/52weis/src/common/DateUtils.php';
require_once get_include_path().'/52weis/data/myblog/MyBlog.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
require_once get_include_path().'/52weis/src/common/Constants.php';
require_once get_include_path().'/52weis/src/common/commonUtil.php';
use \common\PublicConstants;
use \Exception;
use \common\Constants;

class JobControlle {
 
	 
	
	public function main(){
		$start_date = $_GET["start"];
		$end_date = $_GET["end"];
		$key_word = $_GET["key"];
		if(empty($end_date)){
			$end_date = current_date(Constants::$TIME_FORMART_Y_M_D);
		}
		if(empty($start_date)){
			$start_date = date_substract_date(Constants::$TIME_FORMART_Y_M_D, $end_date, 10);
		}
		$days = two_day_split(Constants::$TIME_FORMART_M_D,$start_date,$end_date);
		$zl_job_nums = query_jobs_nums_by_date_names('2016-'.end($days), $end_date, $key_word, 'zl');
		$zl_datas = self::get_datas($zl_job_nums,$days);
		$fo_job_nums = query_jobs_nums_by_date_names('2016-'.end($days), $end_date, $key_word, '51');
		$fo_datas = self::get_datas($fo_job_nums,$days);
		$days = array_reverse($days);
		$days = array_splice($days,1);
		$days = print_array_js($days);
		
		require_once get_include_path().PublicConstants::$JOB_PATH;
	}
	
	public function get_datas($job_nums,$days){
		$datas = self::fill_data($job_nums,$days);
		array_pop($datas);
		$datas = print_array_js($datas);
		return $datas;
	}
	
	function fill_data($job_nums, $days){
		$datas = array();
		foreach ($days as $d){
			array_push($datas, 0);
		}
		foreach ($job_nums as $job_num){
			$day = $job_num[1];
			$datas[diff_between_two_days($day, '2016-'.end($days))-1] = $job_num[0];
		}
		return $datas;
	}
	
	
	private function sum_jobs($days, $jobs){
		$datas = array();
		foreach ($days as $day){
			$sum = 0;
			foreach ($jobs as $job){
				if($job->publish_date == "2016-".$day){
					$sum+=1;
				}	
			}
			array_push($datas, $sum);
		}
		return $datas;
	}
	
   
	
	private function isEmpty($obj){
		if(empty($obj)){
			throw new Exception("资源未找到");
		}
	}
}

?>
