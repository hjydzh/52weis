<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $blog->title; ?></title>
<link href="/52weis/public/script/css/body/article.css" rel="stylesheet"
	type="text/css" />
</head>

<body>
<?php
require_once get_include_path().'/52weis/public/head/head.php';
?>
	<div id="body">
		<ul id="nav">
			<li class="nav-item"><a href="/portal.html">首页</a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a href="<?php echo $first_category->url.'?id='.$first_category->id."_".$first_category->level?>"><?php echo $first_category->name?></a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a href="<?php echo $second_category->url.'?id='.$second_category->id."_".$second_category->level?>"><?php echo $second_category->name?></a></li>
			<br class="clear:both" />
		</ul>
		<div id="main">
			<div id="box" class="white border">

				<dl class="article white">
					<dt>
						<h2>
						关于本站							
						</h2>
					
					</dt>
					<dd class="article-content">关于本站的是。。。。。。。</dd>

				</dl>
				<div class="next-chapter"></div>
				<div class="next-chapter"></div>
			</div>
		</div>
		<div id="right">
			<dl class="white">
				关于我。。。
			</dl>
		</div>
		<br style="clear:both"/>
	</div>
<div id="footer">
<?php 
require_once get_include_path().'/52weis/public/head/footer.php';
?>
</div>
</body>
</html>
