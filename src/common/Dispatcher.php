<?php

namespace common;

class Dispatcher {
	
	/**
	 * url和方法的分隔符
	 */
	private static $DELIMITER = '!';
	
	private static $CLASS_NAME = "className";
	
	private static $CLASS_PATH = 'classPath';
	
	private static $METHOD_NAME = 'methodName';
	
	private static $CONTROL_PATH = '\\control\\';
	
	/**
	 * 默认的主方法
	 */
	private static $MAIN_METHOD = 'main';
	
	
	public static function doService($url) {
		$paths = self::pathMap();
		$realPath = $paths[$url];
		if(empty($realPath)){
			// 错误页面啥的
			return;
		}
		$urlInfo = self::urlParse ($realPath);
		self::invoke ($urlInfo);
	}
	private static function invoke($urlInfo) {
		$classPath = $urlInfo[self::$CLASS_PATH];
		$className = self::$CONTROL_PATH.$urlInfo[self::$CLASS_NAME];
		$methodName = $urlInfo[self::$METHOD_NAME];
		require_once $classPath;
		$class = new \ReflectionClass ($className); // 建立 Person这个类的反射类
		$instance = $class->newInstanceArgs (); // 相当于实例化Person 类
		$ec = $class->getmethod ( $methodName ); // 获取Person 类中的getName方法
		try{
		$ec->invoke ( $instance );
		}catch(\Exception $e){
			//print $e->getMessage();
			header('Location:/error.html');
		}
	}
	private static function pathMap() {
		$paths = array ();
		$paths ["/error"] = "/52weiss/public/head/error.php";
		$paths ["/list"] = "/52weiss/src/control/BlogListControlle.php";
		$paths ["/articles"] = "/52weiss/src/control/ArticleControlle.php";
		$paths ["/addBlog"] = "/52weiss/src/control/AddBlogControlle.php";
		$paths ["/portal"] = "/52weiss/src/control/PortalControlle.php!main";
		$paths ["/login"] = "/52weiss/src/control/LoginControlle.php";
		return $paths;
	}
	private static function urlParse($url) {
		$urlInfo = array();
		$result = explode ( self::$DELIMITER, $url );
		$urlInfo[self::$CLASS_PATH] = $result[0];
		if(empty($result[1])){
			$result[1] = self::$MAIN_METHOD;
		}
		$urlInfo[self::$METHOD_NAME] = $result[1];
		$result = array();
		$regex = "/[\s\S]*\/([\S]+)\.\S*$/";
		$matches = array();
		if(preg_match($regex, $urlInfo[self::$CLASS_PATH], $matches)){
			$urlInfo[self::$CLASS_NAME] = $matches[1];
		}else{
			//报错
		}
		return $urlInfo;
	}
	
}

?>