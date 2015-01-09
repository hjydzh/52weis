<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>52weis</title>
<link href="/52weis/public/script/css/body/home.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/52weis/public/script/js/pictureAutoMove.js"></script>
 
</head>

<body>

<div style="position:fixed; right:-50px; bottom:100px;color:#C4B296;font-size:12px;z-index:999">
	<div style="border:1px solid #EB8E88; width:170px; min-height:40px; padding:5px;float:left; border-radius:5px;z-index:200; background-color:#FFFFF0;opacity:0.7;">
		<span id="words_show" style="line-height:20px;color:black"></span>
		<div style="text-align:right;cursor: pointer;" onclick="menu()">|menu|</div>
		<div id="xiaoWeiWords" style="display:none;" >欢迎来到我的小站<br>我是小薇薇，很高兴认识你哟，不懂的可以问我的呢</div>
	</div>
	<img src="/52weis/public/script/img/weiwei.gif" style="position:relative;left:-40px; z-index:-1"/>
</div>

<?php 
require_once get_include_path().'/52weis/public/head/head.php';
require_once get_include_path().'/52weis/src/common/HtmlTemplate.php';
use \common\HtmlTemplate;

/**
 * 大图区右侧博客
 */
function rightAreaBlog($blogs, $template){
	foreach ($blogs as $blog){
		$href = getUrl($blog);
		$pars = array($href, $blog->title, $blog->create_time);
		HtmlTemplate::echoTemlate($pars, $template);
	}
}

/**
 * 生成博客文章链接
 */
function getUrl($blog){
	$href = $href = '/articles.html?id='.$blog->blog_id.'_'.$blog->category_id;
	return $href;
}

/**
 * 推荐区博客
 */
function recommendBlogs($blogs, $template){
	$count = 0;
	foreach ($blogs as $blog){
		$href = getUrl($blog);
		$content = HtmlTemplate::getShotBlog($blog->content);
		$pars = array($href,  $blog->title, $blog->author, $blog->create_time, $content, $href);
		HtmlTemplate::echoTemlate($pars, $template);
	}
}

/**
 * 最近更新区
 */
function newBlogs($blogs, $template){
	foreach ($blogs as $blog){
		$href = getUrl($blog);
		$pars = array($href, $blog->title);
		HtmlTemplate::echoTemlate($pars, $template);
	}
}

/**
 * 最热文章
 */
function hotBlogs($blogs, $template){
	newBlogs($blogs, $template);
}

?>
<div id="root">
	<div></div>
	<div id="freshMessage">
		<MARQUEE behavior="alternate" scrollAmount=1 direction=right  height=30><FONT face=微软雅黑 size=2>
			Hi，我的小站全球内测正式开始了，不管你是中国人还是外国人，地球还是火星人，发现bug有奖(这你也信，哇哈哈)
		</MARQUEE>
	</div>
    
    <div id="photosShow">
    	<div id="pic_move" style="width: 650px; height:350px; float:left;">
		</div>
    	
        <ul id="news">
           <?php 
$template = '
			<li>
				<a href="%s">
				<h3>
					%s
				</h3>
				<span class="news_time" style="float:left;clear:both">
					%s
				</span>
				</a>
			</li>
		';
rightAreaBlog($rightBlogs, $template);
           ?>
        </ul>
        <br style="clear:both"/>
     </div>
    <div id="wrapper">
    	<div id="main"> 
    		<div style="border-bottom:1px solid #CCF5C1; font-size:16px; ;padding:20px; text-align:left; margin-left:300px;margin-bottom:0;background-color:white;">文章推荐</div>
                <?php 
$template = '
			<div class="article">
            	<h2 class="title">
                	<a href="%s">
						%s
                    </a>
                </h2>
				<div class="info">%s&nbsp;&nbsp;%s&nbsp;&nbsp;</div>
                <div class="content">
                 	%s ...	
                	<a class="readMore" href="/articles.html?id=%s">&nbsp;&nbsp;阅读全文</a>
                </div> 
			</div> '
		;    
recommendBlogs($recomBlogs, $template)
                ?>  
        	<div id="more">
        		<a onclick="readMore(this)" href="####">
        			加载更多
        		</a>
        		<input type="hidden" id="read_click" value="0"/>
        	</div>    	 
        </div>
        
        <div id="rightBox">
        		<dl class="white">
        		<dt>写在开始</dt>
        		<dd>我们总是深陷我们工作的领域不能自拔，其实，工作不是生活的全部，外面的世界更精彩</dd>
        		</dl>
        		<dl class="white">
				<dt>最热文章</dt>
<?php 
$template = '
				<dd>
					<a href="%s">%s</a>
				</dd>	
		';
hotBlogs($hotBlogs, $template);
?>
			</dl>
			<dl class="white">
				<dt>最近更新</dt>
<?php 
$template = '
				<dd>
					<a href="%s">%s</a>
				</dd>	
		';
newBlogs($newBlogs, $template);
?>				
			</dl>
			<dl class="white" style="display:none;">
				<dt>猜你喜欢</dt>
				<dd>百元哥被打</dd>
				<dd>唐山最牛婚礼</dd>
				<dd>隔壁小伙伴</dd>
			</dl>
		</div>
        </div>
    </div>
</div>
<div id="footer">
<?php 
require_once get_include_path().'/52weis/public/head/footer.php';
?>
</div>

</body>
<script language="javascript">

//每次显示推荐区的文章数
var show_num = 4;

var pam_interval=self.setInterval("pam_move()", 2500);
init();

function init(){
	bigPicInit();
	showBlogs();
}

//轮播图片初始化
function bigPicInit()
{
	var imgs = new Array();
	var img1 = {};
	var img2 = {};
	var img3 = {};
	var img4 = {};
	img1["src"] = ("/52weis/public/script/img/1.jpg");
	img1["href"] = ("/articles?id=4_12");

	img2["src"] = ("/52weis/public/script/img/2.jpg");
	img2["href"] = ("/articles.html?id=5_13");

	img3["src"] = ("/52weis/public/script/img/3.jpg");
	img3["href"] = ("/articles?id=1_13");

	img4["src"] = ("/52weis/public/script/img/4.jpg");
	img4["href"] = ("/articles.html?id=12_13");

	imgs[0] = img1;
	imgs[1] = img2;
	imgs[2] = img3;
	imgs[3] = img4;
	pam_init($("#pic_move"), imgs);
}

//点击加载更多
function readMore(obj){
	showBlogs();
	var hideArticles = $(".article:hidden");
	if(0 == hideArticles.length){
		$(obj).hide();
	}
}

//显示隐藏的博客
function showBlogs(){
	var articles = $(".article:hidden");
	var showArticles = articles.slice(0,show_num);
	showArticles.show();
}

/////weiwei////
xiaoWeiSay();
function menu(){
	var words = '菜单还没有准备好呢<br>嘻嘻';
	preSay(words);
}

var wordsList = new Array(
"很无聊呢，需要做些什么吗",
"我喜欢看《火影忍者》，你呢？<br>推荐你去看看哟",
"我的网站是不是很简朴啊<br>呜呜~~~~(>_<)~~~~<br>技术不行呢,纯手工打造的呢,千万不能嫌弃啊",
"有什么能帮到你的吗<br>告诉我好么",
"今天我心情很好哟，开心思密达，嘻嘻"
)


var words_index = 0;

var wordListInterval = setInterval("loopSay()", 10*1000);


function loopSay(){
	if(words_index == wordsList.length){
		words_index = 0;
	}
	preSay(wordsList[words_index])
	words_index++
}

var xiaoWeiInterval;

function xiaoWeiSay(){

	xiaoWeiInterval =  setInterval("xiaoWeiShow()",100);
	
}

function preSay(words){
		$("#words_show").html("");
		$("#xiaoWeiWords").html(words);
		xiaoWeiSay();
}

function xiaoWeiShow(){
	var text = $("#xiaoWeiWords").html();
	var words = $("#words_show").html();
	var length = words.length;
	var position = length;	
	if(position > text.length - 1){
		clearInterval(xiaoWeiInterval);
	}
	var char = text[position];
	if("<" == char){
		var index = text.substring(position).indexOf(">");
		position = index+ position;
	}
	var screen = $("#words_show");
	screen.html(text.substring(0, position+1));
}

</script>
</html>

