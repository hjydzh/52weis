<?php

namespace myblog;

class Category {
	
	/*
	 * 主键
	 */
	private $id;
	
	/*
	 * 目录名
	 */
	private $name;
	
	/*
	 * 父目录id
	 */
	private $parent_id;
	
	/*
	 * 权重
	 */
	private $weight;
	
	/*
	 * URL
	 */
	private $url;
	
	/*
	 * 孩子目录
	 */
	private $children;
	
	/*
	 * 层级，首目录层级为1
	 */
	private $level;
	
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