<?php

namespace dao;

require_once get_include_path().'/52weis/data/myblog/MyBlog.php';
require_once get_include_path().'/52weis/data/myblog/Category.php';
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
require_once get_include_path().'/52weis/src/common/SqlConstants.php';
require_once get_include_path().'/52weis/src/common/DbFactory.php';
use \common\DbFactory;
use \common\PublicConstants;
use \myblog\MyBlog;
use \myblog\Category;
use \common\SqlConstants;

class ArticleQueryDao {
	
	/**
	 * 根据目录id获取一定数量的文章
	 */
	function getBlogByCatId($catId, $start_num, $end_num) {
		$query = SqlConstants::$GET_BLOG_BY_CAT_ID;
		$pars = array (
				$catId,
				$start_num,
				$end_num 
		);
		$blogList = $this->getBlogsByPars ( "ddd", $pars, $query );
		return $blogList;
	}
	
	/**
	 * 根据目录id查询所有文章数量
	 */
	function getBlogByCatIdCount($catId) {
		$query = SqlConstants::$GET_BLOG_BY_CAT_ID_COUNT;
		$link =  DbFactory::getInstance();
		$num = 0;
		if ($stmt = mysqli_prepare ($link, $query)) {
			mysqli_stmt_bind_param ( $stmt, "d", $catId);
			mysqli_stmt_execute ($stmt);
			mysqli_stmt_bind_result($stmt, $num);
			mysqli_stmt_fetch ( $stmt );
			mysqli_stmt_close ( $stmt );
		}
		
		return $num;
	}
	
	/**
	 * 查询最新文章 
	 */
	function getNewBlogs($num){
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$QUERY_NEW_BLOGS;
		$pars = array (
				$num
		);
		$blogList = $this->getBlogsByPars ( "d", $pars, $query );
		return $blogList;
	}
	
	
	/**
	 * 查询一定范围内的文章
	 */
	function queryBlog($start_num, $end_num) {
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$QUERY_BLOG;
		$pars = array (
				$start_num,
				$end_num 
		);
		$blogList = $this->getBlogsByPars ( "dd", $pars, $query );
		return $blogList;
	}
	
	/**
	 * 查询浏览量最高的前多少篇文章
	 */
	function queryHotBlogs($num){
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$QUERY_HOT_BLOGS;
		$pars = array (
				$num
		);
		$blogList = $this->getBlogsByPars ( "d", $pars, $query );
		return $blogList;
	}
	
	/**
	 * 查询一级目录下的一定数量的文章
	 */
	function queryBlogOfFirstCate($cat_id, $start_num, $end_num){
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$QUERY_BLOG_OF_FIRST_CATE;
		$pars = array (
				$cat_id,
				$start_num,
				$end_num
		);
		$blogList = $this->getBlogsByPars ( "ddd", $pars, $query );
		return $blogList;
	}
	
	/**
	 * 查询一级目录下的文章数量
	 */
	function queryBlogOfFirstCateCount($cat_id){
		$query = SqlConstants::$QUERY_BLOG_OF_FIRST_CATE_COUNT;
		$link =  DbFactory::getInstance();
		$num = 0;
		if ($stmt = mysqli_prepare ($link, $query)) {
			mysqli_stmt_bind_param ( $stmt, "d", $cat_id);
			mysqli_stmt_execute ($stmt);
			mysqli_stmt_bind_result($stmt, $num);
			mysqli_stmt_fetch ( $stmt );
			mysqli_stmt_close ( $stmt );
		}
		
		return $num;
	}
	
	/*
	 *
	 */
	private function getBlogsByPars($type, $par, $query) {
		$blogList = array ();
		$link =  DbFactory::getInstance();
		/* create a prepared statement */
		if ($stmt = mysqli_prepare ($link, $query )) {
			/* bind parameters for markers */
			switch (count ( $par )) {
				case 1 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0] );
					break;
				case 2 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1] );
					break;
				case 3 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2] );
					break;
				case 4 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3] );
					break;
				case 5 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4] );
					break;
				case 6 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5] );
					break;
				case 7 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5], $par [6] );
					break;
				default :
					mysqli_stmt_close ( $stmt );
					mysqli_close ( $link );
					return;
			}
			
			/* execute query */
			mysqli_stmt_execute ( $stmt );
			
			/* bind result variables */
			mysqli_stmt_bind_result ( $stmt, $id, $title, $author, $content, $create_time, $view_num, $weight, $url, $category_id,$likes,$comments );
			
			/* fetch value */
			
			while ( mysqli_stmt_fetch ( $stmt ) ) {
				$blog = new MyBlog ();
				$blog->blog_id = $id;
				$blog->title = $title;
				$blog->author = $author;
				$blog->content = $content;
				$blog->create_time = $create_time;
				$blog->view_num = $view_num;
				$blog->weight = $weight;
				$blog->url = $url;
				$blog->likes = $likes;
				$blog->comments = $comments;
				array_push ( $blogList, $blog );
			}
			/* close statement */
			mysqli_stmt_close ( $stmt );
		}
		/* close connection */
		return $blogList;
	}
	
	/**
	 * 通过id获取文章
	 */
	function getBlogByid($id) {
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$GET_BLOG_BY_ID;
		$pars = array (
				$id 
		);
		$blogList = $this->getBlogsByPars ( "d", $pars, $query );
		if (count ( $blogList ) > 0) {
			return $blogList [0];
		} else {
			return null;
		}
	}
	
	/**
	 * 查询首页某个区域的文章
	 */
	function queryPortalBlogs($area_id, $num){
		$query = SqlConstants::$BLOG_SELECT.SqlConstants::$QUERY_PORTAL_BLOGS;
		$pars = array (
				$area_id,
				$num
		);
		$blogList = $this->getBlogsByPars ( "dd", $pars, $query );
		return $blogList;
	}
	
	/**
	 * 插入文章
	 */
	function insertBlog($blog) {
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno ()) {
			printf ( "Connect failed: %s\n", mysqli_connect_error () );
			exit ();
		}
		$query = SqlConstants::$INSERT_BLOG;
		if ($stmt = mysqli_prepare ( $link, $query )) {
			/* bind parameters for markers */
			$num = 0;
			$weight = 0;
			mysqli_stmt_bind_param ( $stmt, "sssddsd", $blog->title, $blog->author, $blog->content, $num, $weight, $blog->url, $blog->category_id );
			
			/* execute query */
			mysqli_stmt_execute ( $stmt );
			
			mysqli_stmt_close ( $stmt );
		}
		return $link->insert_id;
	}
	
	/**
	 * 查询几级目录
	 */
	function queryCategory($level) {
		$query = SqlConstants::$QUERY_CATEGORY;
		$par = array (
				$level 
		);
		$categoryList = $this->getCategoryPar( "d", $par, $query );
		return $categoryList;
	}
	
	private function getCategoryPar($type, $par, $query) {
		$categoryList = array ();
		$link =  DbFactory::getInstance();
		/* create a prepared statement */
		if ($stmt = mysqli_prepare ($link, $query )) {
			
			/* bind parameters for markers */
			switch (count ( $par )) {
				case 1 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0] );
					break;
				case 2 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1] );
					break;
				case 3 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2] );
					break;
				case 4 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3] );
					break;
				case 5 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4] );
					break;
				case 6 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5] );
					break;
				case 7 :
					mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5], $par [6] );
					break;
				default :
					mysqli_stmt_close ( $stmt );
					return;
			}
			
			/* execute query */
			mysqli_stmt_execute ( $stmt );
			
			/* bind result variables */
			mysqli_stmt_bind_result ( $stmt, $id, $name, $parent_id, $weight, $url, $level );
			
			/* fetch value */
			
			while ( mysqli_stmt_fetch ( $stmt ) ) {
				$category = new Category ();
				$category->id = $id;
				$category->name = $name;
				$category->parent_id = $parent_id;
				$category->weight = $weight;
				$category->url = $url;
				$category->level = $level;
				array_push ( $categoryList, $category );
			}
			/* close statement */
			mysqli_stmt_close ( $stmt );
		}
		/* close connection */
		return $categoryList;
	}
	
	/**
	 * 更新阅读量
	 */
	function updateBlogViewByid($id, $view_num) {
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno ()) {
			printf ( "Connect failed: %s\n", mysqli_connect_error () );
			exit ();
		}
		$query = SqlConstants::$UPDATE_BLOG_VIEW_BY_ID;
		if ($stmt = mysqli_prepare ( $link, $query )) {
			/* bind parameters for markers */
			mysqli_stmt_bind_param ( $stmt, "dd", $view_num, $id );
			
			/* execute query */
			mysqli_stmt_execute ( $stmt );
			
			mysqli_stmt_close ( $stmt );
		}
	}
	
	/**
	 * 查询所有目录
	 */
	function getAllCategory(){
		$query = SqlConstants::$GET_ALL_CATEGORY;
		$par = array (1);
		$categoryList = $this->getCategoryPar( "d", $par, $query );
		return $categoryList;
	}
	
	/**
	 * 更新首页展示文章
	 */
	function updatePortalBlogs($id, $area_id) {
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno ()) {
			printf ( "Connect failed: %s\n", mysqli_connect_error () );
			exit ();
		}
		$query = SqlConstants::$UPDATE_PORTAL_BLOGS;
		if ($stmt = mysqli_prepare ( $link, $query )) {
			/* bind parameters for markers */
			mysqli_stmt_bind_param ( $stmt, "dd", $id, $area_id );
			
			/* execute query */
			mysqli_stmt_execute ( $stmt );
			mysqli_stmt_close ( $stmt );
		}
	}
	
	
}
?>