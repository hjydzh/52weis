<?php

namespace dao\impl;

require_once '/src/dao/intf/ArticleQueryIntf.php';
require_once '/data/myblog/MyBlog.php';

use \dao\intf\ArticleQueryIntf;
use \myblog\MyBlog;

class ArticleQueryImpl extends BaseImpl implements ArticleQueryIntf{
	
	/*
	 * 根据目录id获取所有目录
	 */
	function getBlogByCatId($catId){
		$blogList = array();
		$blog = new MyBlog();
		$blog->author = "jack";
		return $blog->author;
	}
}
?>