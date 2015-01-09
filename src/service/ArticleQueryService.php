<?php

namespace service;
require_once get_include_path().'/52weis/src/dao/ArticleQueryDao.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \dao\ArticleQueryDao;
use \common\PublicConstants;

class ArticleQueryService {
	
	/**
	 * 查询目录下一定范围的文章
	 */
	function getBlogsByCatId($catId, $start, $end){
		$dao = new ArticleQueryDao();
		return $dao->getBlogByCatId($catId, $start, $end);
	}
	
	/**
	 * 根据目录id查询所有文章数量
	 */
	function getBlogsByCatIdCount($catId){
		$dao = new ArticleQueryDao();
		return $dao->getBlogByCatIdCount($catId);
	}
	
	/**
	 * 查询一级目录下的所有文章
	 */
	function queryBlogOfFirstCate($catId, $startNum, $endNum){
		$dao = new ArticleQueryDao();
		return $dao->queryBlogOfFirstCate($catId, $startNum, $endNum);
	}
	
	/**
	 * 查询所有文章中最近更新的文章
	 */
	function getNewBlogs($num){
		$dao = new ArticleQueryDao();
		return $dao->getNewBlogs($num);
	}
	
	/**
	 * 查询一级目录下的文章数量
	 */
	function queryBlogOfFirstCateCount($catId){
		$dao = new ArticleQueryDao();
		return $dao->queryBlogOfFirstCateCount($catId);
	}
	
	/**
	 * 查询浏览量最高的前多少篇文章
	 */
	function queryHotBlogs($num){
		$dao = new ArticleQueryDao();
		return $dao->queryHotBlogs($num);
	}
	
	function getBlogByid($id){
		$dao = new ArticleQueryDao();
		return $dao->getBlogByid($id);
	}
	
	function insertBlog($blog){
		$dao = new ArticleQueryDao();
		return $dao->insertBlog($blog);
	}
	
	function queryBlog($start_num, $end_num){
		$dao = new ArticleQueryDao();
		return $dao->queryBlog($start_num, $end_num);
	}
	
	/**
	 * 查询几级目录
	 */
	function queryCategory($level){
		$dao = new ArticleQueryDao();
		return $dao->queryCategory($level);
	}
	
	function updateBlogViewByid($id, $view_num){
		$dao = new ArticleQueryDao();
		return $dao->updateBlogViewByid($id, $view_num);
	}
	
	/**
	 * 查询所有目录
	 */
	function getAllCategory(){
		$dao = new ArticleQueryDao();
		return $dao->getAllCategory();
	}
	
	/**
	 * 查询首页大图区右侧文章
	 */
	function getRightAreaBlogs($num){
		$dao = new ArticleQueryDao();
		return $dao->queryPortalBlogs(PublicConstants::$PORTAL_RIGHT, $num);
	}
	
	/**
	 * 查询首页推荐文章区文章
	 */
	function getRecomBlogs($num){
		$dao = new ArticleQueryDao();
		return $dao->queryPortalBlogs(PublicConstants::$RECOMMENT_AREA, $num);
	}
	
	/**
	 * 更新首页展示文章
	 */
	function updatePortalBlogs($id, $area_id){
		$dao = new ArticleQueryDao();
		return $dao->updatePortalBlogs($id, $area_id);
	}
}

?>