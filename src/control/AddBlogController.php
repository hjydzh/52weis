<?php
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once '/52weiss/data/myblog/MyBlog.php';
use \myblog\MyBlog;
$title = $_POST["title"];
$author = $_POST["author"];
$content = $_POST["content"];
$category_id = $_POST["category_id"];
$blog = new MyBlog();
$blog->title = $title;
$blog->author = $author;
$blog->content = $content;
$blog->category_id = $category_id;
$service = new ArticleQueryService();
$service->insertBlog($blog);
?>