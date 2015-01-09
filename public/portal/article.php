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
						<?php echo $blog->title; ?>
							
							</h1>
					
					</dt>
					<dd>
						<ul class="article-info">
							<li><a href="<?php echo $blog->url;?>"><?php echo $blog->author; ?></a></li>
							<li>发布时间：<?php echo $blog->create_time; ?></li>
							<li>阅读（<?php echo $blog->view_num; ?>）</li>
							<li></li>
							<br style="clear: both" />
						</ul>
					</dd>
					<dd class="article-content"><?php echo $blog->content; ?></dd>

				</dl>
				<div class="next-chapter"></div>
				<div class="next-chapter"></div>
			</div>
		</div>
		<div id="right">
			<dl class="white">
				<dt>最热文章</dt>
<?php 
foreach ($hotBlogs as $blog){
	echo "<dd>";
	//echo '<a href="'.$blog->url.'">';
	echo "<a href=\"/articles?id=$blog->blog_id".'_'."$blog->category_id\">";
	echo $blog->title;
	echo "</a>";
	echo "</dd>";
}
?>
			</dl>
			<dl class="white">
				<dt>栏目最新</dt>
<?php 
foreach($newBlogs as $blog){
	echo "<dd>";
	echo '<a href="/articles.html?id='.$blog->blog_id.'_'.$blog->category_id.'">';
	echo $blog->title;
	echo "</a>";
	echo "</dd>";

}

?>				
			</dl>
			<dl style="display: none" class="white">
				<dt>猜你喜欢</dt>
				<dd>百元哥被打</dd>
				<dd>唐山最牛婚礼</dd>
				<dd>隔壁小伙伴</dd>
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
