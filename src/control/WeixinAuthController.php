<?php

namespace control;

class WeixinAuthController{
	
	public function main(){
		$username = $_GET["username"];
		if ($username=='root'){
			echo 'pass';
		}else {
			echo 'faile';
		}
		
	}
}


?>