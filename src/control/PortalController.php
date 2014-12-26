<?php
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once '/52weiss/data/myblog/MyBlog.php';


$service = new ArticleQueryService();
$blogs = $service->queryBlog(0, 4);
$categorys = $service->queryCategory(1);



?>