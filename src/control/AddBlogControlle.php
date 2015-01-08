<?php

namespace control;
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once '/52weiss/data/myblog/MyBlog.php';
use \myblog\MyBlog;
class AddBlogControlle {
	
	public function main(){
		session_start();
		if($_SESSION["isLogin"] != 1){
			header('Location:/denglu.html');
		}
		$title = $_POST["title"];
		$author = $_POST["author"];
		$url= $_POST["url"];
		$area = $_POST['portal_area'];
		if(empty($url)){
			$url = "/portal.html";
		}
		$content = $_POST["content"];
		$category_id = $_POST["category_id"];
		$blog = new MyBlog();
		$blog->title = $title;
		$blog->author = $author;
		$blog->content = $content;
		$blog->url = $url;
		$blog->category_id = $category_id;
		if(empty($title)||empty($content)||empty($category_id)){
			echo '标题，内容，目录均不能为空';
			require_once '/52weiss/public/login/admin/AddBlog.php';
			return;
		}
		$service = new ArticleQueryService();
		$id = $service->insertBlog($blog);
		if(1 == $area || 2 == $area){
			$service->updatePortalBlogs($id, $area);
		}
		echo '新增成功';
		unset($_POST['content']);
		require_once '/52weiss/public/login/admin/AddBlog.php';
		return;
	}
}

?>