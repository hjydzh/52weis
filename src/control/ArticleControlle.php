<?php

namespace control;
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
use \Exception;
require_once '/52weiss/src/common/PublicConstants.php';
use \common\PublicConstants;
class ArticleControlle {
	
	/**
	 * 热门博客展示的数量
	 */
	private static $HOT_BLOG_NUM = 6;
	
	/**
	 * 最新博客展示的数量
	 */
	private static $NEW_BLOG_NUM = 6;
	
	/**
	 *  二级目录
	 */
	private static $CATE_TWO = 2;
	
	public function main(){
		$id_cat = $_GET['id'];
		$id = explode("_", $id_cat)[0];
		$cat_id = explode("_", $id_cat)[1];
		$service = new ArticleQueryService();
		$blog = self::getBlog($service, $id);
		$newBlogs = self::getNewBlogsInCate($service, self::$NEW_BLOG_NUM, $cat_id);
		$categorys = self::getCategorys($service, $blog);
		$first_category = $categorys[0];	//一级目录
		$second_category = $categorys[1];	//二级目录
		$hotBlogs = self::queryHotBlogs($service, self::$HOT_BLOG_NUM);
		require_once PublicConstants::$ARTICLE_PATH;
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
	
	/**
	 * 查询出导航栏的一级和二级目录
	 */
	private function getCategorys($service, $blog){
		session_start();
		$firstCates = unserialize($_SESSION['categorys']);	//从sessiong中取出一级目录
		$secCates = $service->queryCategory(self::$CATE_TWO);	//查询所有二级目录
		self::isEmpty($secCates);
		$second_category = null;
		$first_category = null;
		$sec_blog_cate_id = $blog->category_id;
		//搜索博客所属的二级目录
		foreach ($secCates as $c){
			$c_id = $c->id;
			if($c_id == $sec_blog_cate_id){
				$second_category = $c;
				break;
			}
		}
		$fir_cate_id = $c->parent_id;
		foreach ($firstCates as $c){
			$c_id = $c->id;
			if($c_id == $fir_cate_id){
				$first_category = $c;
				break;
			}
		}
		return array($first_category, $second_category);
	}
	
	/**
	 * 查询当前目录下的最新的文章
	 */
	private function getNewBlogsInCate($service, $num, $cat_id){
		$newBlogs = $service->getBlogsByCatId($cat_id, 0, $num);
		self::isEmpty($newBlogs);
		return $newBlogs;
	}
	
	/**
	 * 查询所有文章中浏览最多的博客
	 */
	private function queryHotBlogs($service, $num){
		$hotBlogs = $service->queryHotBlogs(5);
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