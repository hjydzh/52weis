<?php

namespace control;
require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
use \Exception;
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \common\PublicConstants;
class BlogControlle {
	
	
	public function main(){
		error_reporting(0);
		$id = explode("/", $_SERVER['REQUEST_URI'])[2];
		$service = new ArticleQueryService();
		$blog = self::getBlog($service, $id);
		require_once get_include_path().PublicConstants::$BLOG_PATH;
	}
	
	/**
	 * 根据id查询文章
	 */
	private function getBlog($service, $id){
		$blog = $service->getBlogByid($id);
		self::isEmpty($blog);
		$service->updateBlogViewByid($blog->blog_id, $blog->view_num + 1);	//浏览量加1
		return $blog;
	}
	 
	
	private function isEmpty($obj){
		if(empty($obj)){
			throw new Exception("资源未找到");
		}
	}
}

?>