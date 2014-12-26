<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="../script/img/52.ico" type="image/x-icon" />
<meta charset="utf-8">
<title>52weis</title>
<link href="/52weiss/public/script/css/body/home.css" rel="stylesheet" type="text/css"/>
<script  src="/52weiss/public/script/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/52weiss/public/script/js/pictureAutoMove.js"></script>
 
</head>

<body>
<?php 
require_once '/52weiss/public/head/head.php';
require_once '/52weiss/src/control/PortalController.php';
?>
<div id="root">
	<div></div>
	<div id="freshMessage">
		<MARQUEE behavior="alternate" scrollAmount=1 direction=right  height=30><FONT face=微软雅黑 size=2>
			Hi，我在#百度网盘#淘到了“王思聪用的1980x1080高清壁纸.jpg”文件，快来看看吧
		</MARQUEE>
	</div>
    
    <div id="photosShow">
    	<div id="pic_move" style="width: 650px; height:350px; float:left;">
		</div>
    	
        <ul id="news">
            <li>
                <a href="http://www.tmtpost.com/176253.html">
                	<h3>90后们的心声：“那些老家伙根本不知道我在想什么”</h3>
                 
                    <span class="news_time" style="float:left;clear:both">今天23：05</span>
                
                </a>
            </li>
            <li>
                <a href="">
                	<h3>火影15年终结史：日漫时代的逝去与忧伤</h3>
                	<span class="news_time" style="float:left;clear:both">今天23：05</span>
                </a>
            </li>
            <li>
                <a href="">
                	<h3>除了流量“卖水”之外，中国移动将向何处去？</h3>
                	<span class="news_time" style="float:left;clear:both">今天23：05</span>
                </a>
            </li>
        </ul>
        <br style="clear:both"/>
     </div>
    <div id="wrapper">
    	<div id="main"> 
        		<div id="recommend">
                	<div style="border-bottom:1px solid #CCF5C1; padding-bottom:10px">文章推荐</div>
                    <dl>
                    	<dt>凤梨是什么时候进入中国的？</dt>
                        <dt>“终于有一场不大吵大闹的转基因辩论了”</dt>
                        <dt>你有多想做，你的自制力就有多强！</dt>
                        <dt>猿声今何在：长臂猿守护者的故事</dt>
                    </dl>
                </div>  
                <?php 
foreach($blogs as $blog){
	$html = '<div class="article">
                	<h2 class="title">
                    	<a href="/52weiss/public/portal/article.php?id=%d">
							%s
                        </a>
                    </h2>
					<div class="info">%s&nbsp;&nbsp;%s&nbsp;&nbsp;</div>
                    <div class="content">
                    %s ...	
                    	<a class="readMore" href="/52weiss/public/portal/article.php?id=%d">&nbsp;&nbsp;阅读全文</a>
                    </div> 
				</div> ';
	$pure_content = strip_tags($blog->content);
	$content = mb_substr($pure_content, 0, 200);
	$txt = vsprintf($html, array($blog->blog_id, $blog->title, $blog->author, $blog->create_time,$content, $blog->blog_id));
	echo $txt;
}
                ?>     	 
        </div>
        
        <div id="rightBox">
        	<div class="right_area">
            过襄阳汉江大桥时、我贴着窗户看着汉江桥边、我们一群人曾在这里合照过。凌晨3点从襄阳火车站出来、我骄傲
            </div>
            <div class="right_area">
            过襄阳汉江大桥时、我贴着窗户看着汉江桥边、我们一群人曾在这里合照过。凌晨3点从襄阳火车站出来、我骄傲
            </div>
            <div class="right_area">
            过襄阳汉江大桥时、我贴着窗户看着汉江桥边、我们一群人曾在这里合照过。凌晨3点从襄阳火车站出来、我骄傲
            </div>
        </div>
    </div>
</div>
<div id="footer">
我是页脚
</div>

</body>
<script language="javascript">
var pam_interval=self.setInterval("pam_move()", 2500);
var imgs = new Array();
var img1 = {};
var img2 = {};
var img3 = {};
var img4 = {};
var img5 = {};
img1["src"] = ("/52weiss/public/script/img/1.jpg");
img1["href"] = ("1111");

img2["src"] = ("/52weiss/public/script/img/2.jpg");
img2["href"] = ("2222");

img3["src"] = ("/52weiss/public/script/img/3.jpg");
img3["href"] = ("3333");

img4["src"] = ("/52weiss/public/script/img/4.jpg");
img4["href"] = ("4444");

img5["src"] = ("/52weiss/public/script/img/5.jpg");
img5["href"] = ("3333");

imgs[0] = img1;
imgs[1] = img2;
imgs[2] = img3;
imgs[3] = img4;
imgs[4] = img5;
pam_init($("#pic_move"), imgs);
</script>
</html>

