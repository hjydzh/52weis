<link href="/52weis/public/script/css/head/head.css" rel="stylesheet" type="text/css"/>
<script  src="/52weis/public/script/js/jquery-1.9.1.js"></script>
<link rel="shortcut icon" href="/52weis/public/script/img/favicon.ico" type="image/x-icon">
<script type="text/javascript">
function hide(obj){
	var li = $(obj);
	var ul = li.find("ul");
	ul.hide();
}
function show(obj){
	var li = $(obj);
	var ul = li.find("ul");
	ul.show();
}

//页面滚至顶部
function topHtml(){
	$('body,html').animate({scrollTop:0}, 700);
}

</script>
<div id="navigation">	
	<ul id="nav-list">
		<li onmouseover="show(this)" onmouseout="hide(this)">
			<a href="/about.html" >关于我</a>
		</li>
<?php 
session_start();

require_once get_include_path().'/52weis/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
require_once get_include_path().'/52weis/src/common/PublicConstants.php';
use \common\PublicConstants;
if(isset($_SESSION['categorys'])){
	$categorys = unserialize($_SESSION['categorys']);
}else{
	$categorys = getFirstCategorys();
	$saveCat = serialize($categorys );
	$_SESSION['categorys']=$saveCat;
 }
 
 foreach ($categorys as $first){
 	liCreate($first);
 }
 
/*
 * 得到所有一级目录，并把二级目录放到父目录下
 */
function getFirstCategorys(){
	$service = new ArticleQueryService();
	$categorys = $service->getAllCategory();
	$firsts = array();
	$seconds = array();
	foreach ($categorys as $cate){
		$level = $cate->level;
		$id = $cate->id;
		$parent_id = $cate->parent_id;
		if(1 == $level){
			array_push($firsts, $cate);
		}else{
			if(empty($seconds[$parent_id])){
				$seconds[$parent_id] = array($cate);
				//array_push($seconds[$parent_id], $cate);
				$a = $seconds[$parent_id];
			}else{
				array_push($seconds[$parent_id], $cate);
				$a = $seconds[$parent_id];
			}
		}
	}
	foreach ($firsts as $cate){
		$id = $cate->id;
		$cate->children = $seconds[$id];
	}
	return $firsts;
}


function liCreate($firstCategory){
	echo '<li onmouseover="show(this)" onmouseout="hide(this)">';
	echo '<a href="'.$firstCategory->url.'?id='.$firstCategory->id.'_'.$firstCategory->level.'">';
	echo $firstCategory->name;
	echo "</a>";
	echo '<ul class="head-nav-item">';
	li($firstCategory->children);
	echo "</ul>";
	echo "</li>";
}

function li($secCategory){
	if(empty($secCategory)){
		return ;
	}
	foreach ($secCategory as $cate){
		echo '<li>';
		echo '<a href="'.$cate->url.'?id='.$cate->id.'_'.$cate->level.'">';
		echo $cate->name;
		echo '</a>';
		echo '</li>';
	}
}
	?>	
		<li onmouseover="show(this)" onmouseout="hide(this)">
			<a href="/portal.html" >首页</a>
		</li>
		<br style="clear: both"/>
    </ul>
</div>
<img id="htmlTop" src="/52weis/public/script/img/top.jpg" onclick="topHtml()";/>
<br style="clear: both"/>
