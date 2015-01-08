<?php

namespace myblog;

/**
 *
 * @author junyu
 *        
 */
class MyBlog {
	
	/*
	 * 主键
	 */
	private $blog_id;
	
	/*
	 * 文章标题
	 */
	private $title;
	
	/*
	 * 作者
	 */
	private $author;
	
	/*
	 * 正文
	 */
	private $content;
	
	/*
	 * 发表时间
	 */
	private $create_time;
	
	/*
	 * 浏览量
	 */
	private $view_num;
	
	/*
	 * 权重
	 */
	private $weight;
	
	/*
	 * 地址
	 */
	private $url;
	
	/*
	 * 目录id
	 */
	private $category_id;
	
	public function __get($property_name) {
		if (isset ( $this->$property_name )) {
			return ($this->$property_name);
		} else {
			return null;
		}
	}
	public function __set($property_name, $value) {
		$this->$property_name = $value;
	}
}

?>