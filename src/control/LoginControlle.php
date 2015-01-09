<?php

namespace control;

class LoginControlle {
	
	public function main(){
		session_start();
		if(isset($_SESSION["count"])){
			$count = $_SESSION["count"];
		}else{
			$count = 0;
			$_SESSION["count"] = $count;
		}
		$username = $_POST["username"];
		$password = $_POST["password"];
		if($username == 'addblogs' && $password == 'addblogs'){
			$count += 1;
			$_SESSION["count"] = $count;
			if($count > 1){
				$_SESSION["isLogin"] = true;
				require_once get_include_path().'/52weis/public/login/admin/AddBlog.php';
				return;
			}
		}
		if($count > 0){
			$error = '用户名或者密码错误';
		}
		require_once get_include_path().'/52weis/public/login/admin/login.php';
		
	}
}

?>