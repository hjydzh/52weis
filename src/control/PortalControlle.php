<?php
namespace control;
require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once get_include_path().'/52weis/data/myblog/MyBlog.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \common\PublicConstants;
use \Exception;
class PortalControlle {
	
	/**
	 * 热门文章展示数量
	 * @var unknown
	 */
	private static $HOT_BLOG_NUM = 5;
	
	/**
	 * 最新文章展示数量
	 * @var unknown
	 */
	private static $NEW_BLOG_NUM = 5;
	
	/**
	 * 大图右侧区展示文章数量
	 */
	private static $RIGHT_BLOG_NUM = 4;
	
	/**
	 * 推荐区文章数量
	 */
	private static $RECOMMEND_BLOG_NUM = 18;
	
	public function main(){
		$service = new ArticleQueryService();
		$hotBlogs = self::queryHotBlogs($service, self::$HOT_BLOG_NUM);
		$newBlogs = self::getNewBlogs($service, self::$NEW_BLOG_NUM);
		$rightBlogs = self::rightBlogs($service, self::$RIGHT_BLOG_NUM);
		$recomBlogs = self::queryRecomBlog($service, self::$RECOMMEND_BLOG_NUM);
		require_once get_include_path().PublicConstants::$PORTAL_PATH;
	}
	
	/**
	 * 查询推荐区的博客内容
	 * @param unknown $service
	 */
	public function queryRecomBlog($service, $num){
		$recomBlog = $service->getRecomBlogs($num);
		self::isEmpty($recomBlog);
		return $recomBlog;
	}
	
	/**
	 * 查询最新的文章
	 */
	private function getNewBlogs($service, $num){
		$newBlogs = $service->getNewBlogs($num);
		self::isEmpty($newBlogs);
		return $newBlogs;
	}
	
	/**
	 * 查询所有文章中浏览最多的博客
	 */
	private function queryHotBlogs($service, $num){
		$hotBlogs = $service->queryHotBlogs($num);
		self::isEmpty($hotBlogs);
		return $hotBlogs;
	}
	
	/**
	 * 查询首页大图区右侧文章
	 */
	private function rightBlogs($service, $num){
		$hotBlogs = $service->getRightAreaBlogs($num);
		self::isEmpty($hotBlogs);
		return $hotBlogs;
	}
	
	private function isEmpty($obj){
		if(empty($obj)){
			throw new Exception("资源未找到");
		}
	}
}

?>