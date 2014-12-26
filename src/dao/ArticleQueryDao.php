<?php

namespace dao;
require_once '/52weiss/data/myblog/MyBlog.php';
require_once '/52weiss/data/myblog/Category.php';
require_once '/52weiss/src/common/PublicConstants.php';
require_once '/52weiss/src/common/SqlConstants.php';
use \common\PublicConstants;
use \myblog\MyBlog;
use \myblog\Category;
use \common\SqlConstants;
class ArticleQueryDao {
	
	/*
	 * 根据目录id获取一定范围的文章
	*/
	function getBlogByCatId($catId, $start_num, $end_num){
		$query = SqlConstants::$GET_BLOG_BY_CAT_ID;
		$pars = array($catId, $start_num, $end_num);
		$blogList = $this->getBlogsByPars("ddd", $pars, $query);
		return $blogList;
	}
	
	/*
	 * 查询一定范围内的文章
	 */
	function queryBlog($start_num, $end_num){
		$query = SqlConstants::$QUERY_BLOG;
		$pars = array($start_num, $end_num);
		$blogList = $this->getBlogsByPars("dd", $pars, $query);
		return $blogList;
	}
	
	/*
	 * 
	 */
	private function getBlogsByPars($type, $par, $query){
		$blogList = array();
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		/* create a prepared statement */
		if ($stmt = mysqli_prepare($link, $query)) {
	
			/* bind parameters for markers */
			switch (count($par)){
				case 1:
					mysqli_stmt_bind_param($stmt, $type, $par[0]);
					break;
				case 2:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1]);
					break;
				case 3:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2]);
					break;
				case 4:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3]);
					break;
				case 5:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4]);
					break;
				case 6:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5]);
					break;
				case 7:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5], $par[6]);
					break;
				default:
					mysqli_stmt_close($stmt);
					mysqli_close($link);
					return ;
			}
			
	
			/* execute query */
			mysqli_stmt_execute($stmt);
	
			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $id, $title, $author, $content, $create_time, $view_num, $weight, $url, $category_id);
	
			/* fetch value */
	
			while(mysqli_stmt_fetch($stmt)){
				$blog = new MyBlog();
				$blog->blog_id = $id;
				$blog->title = $title;
				$blog->author = $author;
				$blog->content = $content;
				$blog->create_time = $create_time;
				$blog->view_num = $view_num;
				$blog->weight = $weight;
				$blog->url = $url;
				$blog->category_id = $category_id;
				array_push($blogList, $blog);
			}
			/* close statement */
			mysqli_stmt_close($stmt);
		}
		/* close connection */
		mysqli_close($link);
		return $blogList;
	}
	
	function getBlogByid($id){
		$query = SqlConstants::$GET_BLOG_BY_ID;
		$pars = array($id);
		$blogList = $this->getBlogsByPars("d", $pars, $query);
		if(count($blogList)>0){
			return $blogList[0];
		}else{
			return null;
		}
	}
	
	/*
	 * 插入文章
	*/
	function insertBlog($blog){
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$query = SqlConstants::$INSERT_BLOG;
		if ($stmt = mysqli_prepare($link, $query)){
			/* bind parameters for markers */
			$num=0;
			$weight=1;
			mysqli_stmt_bind_param($stmt, "sssddd", $blog->title, $blog->author, $blog->content, $num, $weight, $blog->category_id);
			
			/* execute query */
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
		}
		mysqli_close($link);
	}
	
	
	
	/*
	 * 查询几级目录
	 */
	function queryCategory($level){
		$query = SqlConstants::$QUERY_CATEGORY;
		$categoryList = $this->getCategoryByPar("d", $level, $query);
		return $categoryList;
	}
	
	private function getCategoryPar($type, $par, $query){
		$categoryList = array();
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		/* create a prepared statement */
		if ($stmt = mysqli_prepare($link, $query)) {
	
			/* bind parameters for markers */
		switch (count($par)){
				case 1:
					mysqli_stmt_bind_param($stmt, $type, $par[0]);
					break;
				case 2:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1]);
					break;
				case 3:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2]);
					break;
				case 4:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3]);
					break;
				case 5:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4]);
					break;
				case 6:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5]);
					break;
				case 7:
					mysqli_stmt_bind_param($stmt, $type, $par[0], $par[1], $par[2], $par[3], $par[4], $par[5], $par[6]);
					break;
				default:
					mysqli_stmt_close($stmt);
					mysqli_close($link);
					return ;
			}
	
			/* execute query */
			mysqli_stmt_execute($stmt);
	
			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $id, $name, $parent_id, $weight, $url, $level);
	
			/* fetch value */
	
			while(mysqli_stmt_fetch($stmt)){
				$category = new Category();
				$category->id = $id;
				$category->name = $name;
				$category->parent_id = $parent_id;
				$category->weight = $weight;
				$category->url = $url;
				$category->level = $level;
				array_push($categoryList, $category);
			}
			/* close statement */
			mysqli_stmt_close($stmt);
		}
		/* close connection */
		mysqli_close($link);
		return $categoryList;
	}
	
	/*
	 * 更新阅读量
	 */
	function updateBlogViewByid($id, $view_num){
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$query = SqlConstants::$UPDATE_BLOG_VIEW_BY_ID;
		if ($stmt = mysqli_prepare($link, $query)){
			/* bind parameters for markers */
			mysqli_stmt_bind_param($stmt, "dd", $view_num, $id);
				
			/* execute query */
			mysqli_stmt_execute($stmt);
				
			mysqli_stmt_close($stmt);
		}
		mysqli_close($link);
	}
	
}
?>