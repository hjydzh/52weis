<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="../script/img/52.ico" type="image/x-icon" />
<meta charset="utf-8">
<title>文章分类浏览</title>
<link href="/52weis/public/script/css/body/blogList.css" rel="stylesheet" type="text/css"/>
<script  src="/52weis/public/script/js/jquery-1.9.1.js"></script>
</head>
<?php 

/**
 * 生成上下页标签
 */
function nextPage($cate_id, $level, $index, $last_page){
	$href = '/list.html?id='.$cate_id.'_'.$level.'&index=';
	if($index  > 0){
		tagLi($href.($index - 1), "上一页");
	}
	if(!$last_page){
		tagLi($href.($index + 1), "下一页");
	}
	
}

function tagLi($href, $name){
	echo "<li><a target='_blank' href=\"$href\">$name</a></li>";
}
?>
<body>
<?php 
require_once get_include_path().'/52weis/public/head/head.php';
?>
    <div id="wrapper">
    	<div id="main"> 
                <?php 
$length = count($blogs);
$edge = 3;
$count = 0;
foreach($blogs as $blog){
	$count += 1;
	$html = '<div class="article" name="%s" style="display:%s">
                	<h2 class="title">
                    	<a target="_blank" href="/articles.html?id=%d_%d">
							%s
                        </a>
                    </h2>
					<div class="info">%s&nbsp;&nbsp;%s&nbsp;&nbsp;</div>
                    <div class="content">
                    %s ...	
                    	<a target="_blank" class="readMore" href="/articles.html?id=%d_%d">&nbsp;&nbsp;阅读全文</a>
                    </div> 
				</div> ';
	$pure_content = strip_tags($blog->content);
	$content = mb_substr($pure_content, 0, 200);
	$display = "show";
	if($count > $edge){
		$display = "none";
	}
	if($count < 2 * $edge + 1&& $count > $edge){
		$name = "segment_1";
		$display = "none";
	}else if($count > 2 * $edge){
		$name = "segment_2";
		$display = "none";
	}else{
		$name = "";
	}
	$txt = vsprintf($html, array($name, $display, $blog->blog_id, $blog->category_id, $blog->title, $blog->author, $blog->create_time,$content, $blog->blog_id, $blog->category_id));
	echo $txt;
}
                ?> 
        	<div id="more">
        		<a onclick="readMore(this)" href="####">
        			加载更多
        		</a>
        		<input type="hidden" id="read_click" value="0"/>
        	</div> 
        	<div id="pageWrapper" style="display:none">
        		<ul>
        			<?php nextPage($cate_id, $level, $index, $last_page);?>
        			<br style="clear: both"/>
        		</ul>
        	</div>
        	
        </div>
        
        <div id="rightBox" >
        	<div class="right_area">
            这个板块主要是结介绍啥啥的你懂的
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

function readMore(obj){
	var read_click = parseInt($("#read_click").val());
	//点击一次展示一二部分文章，二次展示二部分文章，第三次点击则显示上下页
	if(0 == read_click){
		var articles = $("div[name='segment_1']");
		hiddenArticle = $(".article:hidden");
		articles.show();
	}else if(1 == read_click){
		var articles = $("div[name='segment_2']");
		articles.show();
		$("#more").hide();
		$("#pageWrapper").show();
	}
	$("#read_click").val(read_click + 1);
}

                
</script>
</html>

