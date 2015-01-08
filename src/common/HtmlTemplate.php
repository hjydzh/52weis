<?php

namespace common;

class HtmlTemplate {
	
	/**
	 * 截取字数
	 */
	private static $CUT_NUM = 200;
	
	/**
	 * blog对象的路径，用于反射
	 */
	private static $BLOG_PATH = '\myblog\MyBlog';
	
	/**
	 * 截取文章内容
	 */
	public static function getShotBlog($content){
		$shortContent = strip_tags($content);
		return mb_substr($shortContent, 0, self::$CUT_NUM);
		
	}
	
	/**
	 * 占位符格式输出
	 */
	private static function preHtml($preContents, $pars){
		return  vsprintf($preContents, $pars);
	}
	
	
	/**
	 * 输出给点模版的html
	 */
	public static function echoTemlate($pars, $template){
		echo self::preHtml($template, $pars);
	}
	
}

?>