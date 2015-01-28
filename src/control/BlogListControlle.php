<?php

namespace control;
require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
use \Exception;
require_once get_include_path().'/52weis/data/myblog/MyBlog.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \common\PublicConstants;
class BlogListControlle {
	
	/**
	 * 每次展示的文章数
	 */
	private static $PAGE_NUM = 6;
	
	public function main(){
		error_reporting(0);
		$id = $_GET["id"];
		if(empty($id)){
			header('Location:/portal.html');
		}
		$cate_id = explode("_", $id)[0];
		$level = explode("_", $id)[1];
		if(empty($cate_id) || empty($level)){
			header('Location:/portal.html');
		}
		$last_page = false;
		if(!isset($_GET["index"])){
			$index = 0;
		}else{
			$index = (int)$_GET["index"];
		}
		if($index < 0){
			header('Location:/error.html');
		}
		$start = self::getStartIndex($index);
		$end = self::getEndIndex($index);
		$service = new ArticleQueryService();
		if(2 == $level){
			$blogs = self::getSecendCate($service, $cate_id, $start, $end);
		//	$count = self::getSecendCateCount($service, $cate_id);
		}else if(1 == $level){
			$blogs = self::getFirstCate($service, $cate_id, $start, $end);
			//$count = self::getFirstCateCount($service, $cate_id);
		}else{
			header('Location:/portal.html');
		}
		if(count($blogs) < self::$PAGE_NUM){
			//当返回的数量小于一页的数量，说明已经是最后一页了，置为true，说明最后一页
			$last_page = true;
		}
		require_once get_include_path().PublicConstants::$BLOG_LIST_PATH;
	}
	
	private function getEndIndex($page_index){
		return self::getStartIndex($page_index) + self::$PAGE_NUM;
	}
	
	private function getStartIndex($page_index){
		return self::$PAGE_NUM * $page_index;
	}
	
	/**
	 * 查询二级目录的文章
	 */
	private function getSecendCate($service, $cate_id, $start, $end){
		$blogs = $service->getBlogsByCatId($cate_id, $start, $end);
		self::isEmpty($blogs);
		return $blogs;
	}
	
	/**
	 * 查询一级目录下的所有文章
	 */
	private function getFirstCate($service, $cate_id, $start, $end){
		$blogs = $service->queryBlogOfFirstCate($cate_id, $start, $end);
		self::isEmpty($blogs);
		return $blogs;
	}
	
	/**
	 * 
	 * 查询二级目录下所有文章数目
	 */
	private function getSecendCateCount($service, $cate_id){
		$count = $service->getBlogsByCatIdCount($cate_id);
		return $count;
	}
	
	/**
	 *
	 * 查询一级目录下所有文章数目
	 */
	private function getFirstCateCount($service, $cate_id){
		$blogs =  $service->queryBlogOfFirstCateCount($cate_id);
		self::isEmpty($blogs);
		return $blogs;
	}
	
	
	private function isEmpty($obj){
		if(empty($obj)){
			throw new Exception("资源未找到");
		}
	}
	
}

?>