<?php 
$url =  $_SERVER['REQUEST_URI'];
//print_r(parse_url($url));
$parseList = parse_url($url);
$path = $parseList['path'];
require_once $path;
?>