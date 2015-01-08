<?php

namespace common;

require_once '/52weiss/src/common/PublicConstants.php';
use \common\PublicConstants;

class DbFactory {
	
	private static $link;
	
	private function __construct() {
		 self::$link = mysqli_connect(PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME);
		 if (mysqli_connect_errno ()) {
		 	return null;
		 }
		 return  self::$link;
	}
	
	public static function getInstance() {
		if((self::$link == null)){
			self::$link == new self();
		}
		return self::$link;
	}
	
}

?>