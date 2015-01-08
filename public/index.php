<?php 
require_once '/52weiss/src/common/Dispatcher.php';
use \common\Dispatcher;

$url =  $_SERVER['REQUEST_URI'];
$parseList = parse_url($url);
$path = $parseList['path'];
//获得路径.html,.php等前部分
$pathArray = explode(".", $path);
if(empty($pathArray)){
	header('Location:/52weiss/error.html');
}
$pagePath = $pathArray[0];

if("/denglu" == $pagePath){
	require_once '/52weiss/public/login/admin/login.php';
	return;
}

if("/about" == $pagePath){
	require_once '/52weiss/public/portal/about.php';
	return;
}

Dispatcher::doService($pagePath);


?>