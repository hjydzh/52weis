<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="keywords" content="程序员">
<meta name="description" content="<?php echo $blog->title; ?>">
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
			<li class="nav-item"><a href="/">首页</a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a target="_blank" href="<?php echo $first_category->url.'?id='.$first_category->id."_".$first_category->level?>"><?php echo $first_category->name?></a></li>
			<li class="nav-item">></li>
			<li class="nav-item"><a target="_blank" href="<?php echo $second_category->url.'?id='.$second_category->id."_".$second_category->level?>"><?php echo $second_category->name?></a></li>
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
							<li><a target="_blank" href="<?php echo $blog->url;?>"><?php echo $blog->author; ?></a></li>
							<li>发布时间：<?php echo $blog->create_time; ?></li>
							<li>阅读（<?php echo $blog->view_num; ?>）</li>
							<li></li>
							<br style="clear: both" />
						</ul>
					</dd>
					<dd class="article-content"><?php echo $blog->content; ?></dd>
					<dd>
							<div style="float:right"  class="bdsharebuttonbox"><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"2298038314"},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
						<div style="float:right; padding:5px;" >
							分享到：
						</div>
					</dd>
					<dd>
						<div style="float:left;">
							<img style="width:100px" alt="微信扫一扫" src="/52weis/public/script/img/qrcode_for_gh_265ecfa7d174_430.jpg">
						</div>
						<div style="float:left;padding:10px;width:480px; text-align:left; line-height:25px;">
						想第一时间获得最新文章，请在微信公众账号中搜索[<font color="#8B0000">52weis</font>]或者搜索微信号[<font color="#8B0000">ILoveWeis</font>]
						或用手机扫描左方二维码，即可获得每日精华内容推送和最优搜索体验
						</div>
						<br/ style="clear: both">
					</dd>


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
	echo "<a target='_blank' href=\"/articles?id=$blog->blog_id".'_'."$blog->category_id\">";
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
	echo '<a target="_blank" href="/articles.html?id='.$blog->blog_id.'_'.$blog->category_id.'">';
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
