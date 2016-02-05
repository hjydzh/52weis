<?php
namespace control;
require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once get_include_path().'/52weis/data/myblog/MyBlog.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \common\PublicConstants;
use \Exception;
class IndexControlle {
	
	/**
	 * 热门文章展示数量
	 * @var unknown
	 */
	private static $BLOG_NUM = 20;
	
	
	
	public function main(){
		error_reporting(0);
		$service = new ArticleQueryService();
		$blogs = self::getNewBlogs($service, self::$BLOG_NUM);
		require_once get_include_path().PublicConstants::$INDEX_PATH;
	}
	
 
	/**
	 * 查询最新的文章
	 */
	private function getNewBlogs($service, $num){
		$newBlogs = $service->getNewBlogs($num);
		self::isEmpty($newBlogs);
		return $newBlogs;
	}
	 
	
	private function isEmpty($obj){
		if(empty($obj)){
			throw new Exception("资源未找到");
		}
	}
}

?>