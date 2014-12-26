<?php

namespace service;
require_once '/52weiss/src/dao/ArticleQueryDao.php';
use \dao\ArticleQueryDao;

class ArticleQueryService {
	
	/*
	 * 查询目录下前5条文章
	 */
	function getHotBlogByCatId($catId){
		$dao = new ArticleQueryDao();
		return $dao->getBlogByCatId($catId, 0, 6);
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
	
	function queryCategory($level){
		$dao = new ArticleQueryDao();
		return $dao->queryCategory($level);
	}
	
	function updateBlogViewByid($id, $view_num){
		$dao = new ArticleQueryDao();
		return $dao->updateBlogViewByid($id, $view_num);
	}
}

?>