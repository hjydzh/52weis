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
					<dd class="article-content">
					<p>
					这是一个严肃的网站，小微君设计它的目的就是致力于为广大网友，特别是程序员们提供一个接触更新鲜，更有趣，更实用的人和事。它只希望它的读者，不要只沉静在自己职业所在的世界里，而忽略那些有趣
					，对人生很有意义的事。它始终相信，人的生活，是应该更丰富多彩些的。
					</p>
					<p>
					在这里，很遗憾，你只能看到少许的有关互联网的一些新闻和技术咨询，但是，它有时会告诉你一个小贴士，比如如何和你的同事交流，或者会给你一个有关如何谈恋爱、哄女生开心的小技巧，亦或会和你分享下一个温馨或者文艺的小故事。
					偶尔也会有些理财方面的知识吧。反正，它觉得有趣的，能帮助你生活更充实，更精彩的事情，它都会和你分享。
					</p>
					<p>
					请记住，这可不是个学东西的地方哟。
					</p>
					<p>
					每天看到这么多人，天天沉浸在自己的工作，整个世界就只有工作，不会和人交流，不会管钱，不会哭，不懂笑，俨然就是一个工作机器。所以，小微君准备以自己微薄之力，帮助那些，特别是程序员们，成为有血有肉，精神丰富，而且生活幸福的“人”。
					</p>
					<p>
					带给程序员一个更精彩的世界，是小微君一直奋斗的目标，也是这个网站所承担的重任，它将矢志不渝的努力实现这个目标。
					</p>
					<p>
					小微君这个小站的名字"52weis"，谐音就是“我爱微”，加个s是指无数的微小的事。之所以这样叫是因为，小微君的小站还很“微”小，但小微君坚信，要实现“带给程序员一个更精彩的世界”这个伟大的梦想，必须是由很多“微”小的事积累而成的。对待每件“微”小的事，小微君
					都将异常认真，小事做成了，才能成大事，不是么。就像小微君一样，也是如尘埃般“微”小的人，但不也是在用一件又一件“微”小的事去筑成伟大的梦么？
					</p>
					</dd>

				</dl>
				<div class="next-chapter"></div>
				<div class="next-chapter"></div>
			</div>
		</div>
		<div id="right">
			<dl class="white">
				大家好，小微君要做稍微做下自我介绍啦。看得出来吧，一个小小程序员啦，但喜欢丰富精彩的活动，对于安逸平静普通的生活，简直是
				要了小微君的老命唉。
				<br/>
				<br/>
				不善言谈，程序员的老毛病呢，小微君也有的唉。喜欢文学，爱好旅行，正在用双脚丈量中国大地哟，也蛮喜欢金融的，正在努力学习营销知识。
				不过，终极梦想是和各路英雄好汉一起实现人工智能这个牛逼闪闪的梦，现在致力于机器学习、自然语言领域的学习。
				<br/>
				<br/>
				如果你也想，或者正在为改善人民生活，提高人们生活质量方面努力的话，联系我哟，和小微君一起加入到为人民服务的伟大事业来吧。反正小微君是认为，既然我们掌握了计算机技术这么牛逼的东东，
				那就得让它发挥更伟大的作用，你说呢？
				<br/>
				<br/>
				QQ:452034476
				<br/>
				<br/>
				在微信公众账号中搜索[52weis]或者搜索微信号[ILoveWeis]
				<br/>
				<br/>
				官方微博： http://weibo.com/52weis
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
