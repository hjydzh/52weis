<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>这里放文章题目</title>
<link href="/52weiss/public/script/css/body/article.css" rel="stylesheet"
	type="text/css" />
</head>

<body>
<?php
require_once '/52weiss/public/head/head.php';
require_once '/52weiss/src/control/ArticleController.php';
?>
	<div id="body">
		<ul id="nav">
			<li class="nav-item"><a href="">首页</a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a href="">阅读</a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a href="">娱乐</a></li>
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
				<div class="next-chapter">上一篇：使用CSS3制作文字、图片倒影</div>
				<div class="next-chapter">下一篇：有创意的鼠标悬停效果集锦</div>
			</div>
		</div>
		<div id="right">
			<dl class="white">
				<dt>最热文章</dt>
				<dd>使用CSS3制作文字、图片倒影</dd>
				<dd>【分享】css3标签切换卡样式</dd>
				<dd>有创意的鼠标悬停效果集锦</dd>
			</dl>
			<dl class="white">
				<dt>栏目最新</dt>
<?php 
foreach($hotBlogs as $blog){
	echo "<dd>";
	echo '<a href="/52weiss/public/portal/article.php?id='.$blog->blog_id.'">';
	echo $blog->title;
	echo "</a>";
	echo "</dd>";

}

?>				

				<dd>linux系统出现bash漏洞，请大家赶紧修复！</dd>
				<dd>捕捉楼上.gif + 超简单实现代码</dd>
				<dd></dd>
			</dl>
			<dl class="white">
				<dt>猜你喜欢</dt>
				<dd>百元哥被打</dd>
				<dd>唐山最牛婚礼</dd>
				<dd>隔壁小伙伴</dd>
			</dl>
		</div>
	</div>
</body>
</html>
