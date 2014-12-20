<?php
namespace dao\intf;

interface ArticleQueryIntf extends BaseIntf{
	
	/*
	 * 根据目录id获取所有目录
	 */
	function getBlogByCatId($catId);
}

?>