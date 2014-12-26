<?php
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
$id = $_GET['id'];
$cat_id = 6;
$service = new ArticleQueryService();
$blog = $service->getBlogByid($id);
$service->updateBlogViewByid($blog->blog_id, $blog->view_num + 1);
$hotBlogs = $service->getHotBlogByCatId($cat_id);

//print_r($blog);
?>