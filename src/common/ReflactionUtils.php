<?php

namespace common;

use \ReflectionClass;
class ReflactionUtils {
	
	/**
	 * 获取属性的值
	 */
	public static function getProperty($className, $propertyName, $instance){
		$class = new ReflectionClass($className);
		$property = $class->getProperty($propertyName);
		$property->setAccessible(true);
		$value = $property->getValue($instance);
		return $value;
	}
}



?>