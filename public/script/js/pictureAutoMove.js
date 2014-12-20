/*
html格式
<div id="pic_move" style="width: 650px; height:350px;"> 
</div>
其中id必须为pic_move, 长宽可以自己定

js代码如下：
var pam_interval=self.setInterval("pam_move()", 4500);
只有4500可以改，此参数定义图片滚动时间间隔
var imgs = new Array();
var img1 = {};
var img2 = {};
var img3 = {};
var img4 = {};

img1["src"] = ("1.jpg");
img1["href"] = ("1111");

img2["src"] = ("2.jpg");
img2["href"] = ("2222");

img3["src"] = ("3.jpg");
img3["href"] = ("3333");

img4["src"] = ("4.jpg");
img4["href"] = ("4444");


imgs[0] = img1;
imgs[1] = img2;
imgs[2] = img3;
imgs[3] = img4;
图片添加如上，设置src和a标签href如上

pam_init($("#pic_move"), imgs);
此方法不能更改
以上js需全局
*/




//初始化图片
function pam_init(parent, pics)
{
	var pWidth = parent.width();
	var pHeight = parent.height();
	parent.css("overflow", "hidden");			//防止图片溢出
	parent.attr("id", "pam_parent");			//设置父节点id
	parent.css("position", "relative");
	var imgs = new Array();
	for(var key in pics){
		//初始化孩子节点
		var a = $("<a href=''></a>");
		a.attr("href", pics[key].href);
		var img = $("<img/>");
		a.append(img);
		img.attr("src", pics[key].src);
		img.mouseover(function(){self.clearInterval(pam_interval);});
		img.mouseout(function(){pam_interval=self.setInterval("pam_move()", 4500);});
		img.width(pWidth);
		img.height(pHeight);
		img.css("position", "absolute");
		img.css("left", pWidth);				//把所有img节点都放在父节点外侧
		img.attr("name", "pam_null");		//不要移动的节点都设置为null
		imgs.push(img);
		parent.append(a);
	}
	//设置第一张图片，并置于父div中，用current标记为需要移动的图片
	var firstImg = imgs[0];
	firstImg.css("left", 0);
	firstImg.attr("name", "pam_current");	
	
//	var nextImg = imgs[1];
	//nextImg.attr("name", "pam_next");
}

//移动主方法
function pam_move()
{
	var parent = $("#pam_parent");
	//1000为图片移动速度
	pam_putCurrentAndMove(parent, 1500);	//移动当前需要移动的图片
	pam_putNextAndMove(parent, 1500);			//移动下一张图片（因为是两种图片一起移动的）
}

//移动当前图片
function pam_putCurrentAndMove(parent, speed)
{
	var pWidth = parent.position().left;
	var obj = $("img[name='pam_current']");
	var objLeft = obj.position().left;
	obj.animate({left: 0- parent.width()}, speed);
}

//移动下一张图片
function pam_putNextAndMove(parent, speed)
{

	var pWidth = $("#pam_parent").width();
	var pHeight = $("#pam_parent").height();
	//用于判断下一个兄弟节点是否为空，为空则设置第一个孩子节点
	var currentNode = $("img[name='pam_current']");
	var currentP = currentNode.parent();	//得到父节点，即a标签;
	var nextA = currentP.next();					//得到下一个a标签
	if ( nextA.html() == null)
	{
		nextA = $("#pam_parent a:first")		//下一个a标签为空，设置nextA为第一个a标签
	}
	var nextAOfImg = nextA.find("img");		//a标签的img
	obj = nextAOfImg;
	//设置next节点的移动前的初始位置，即在父div右侧，准备移入父div
	var objLeft = obj.position().left;
	var objTop = obj.position().top;
	obj.css("left", pWidth);
	obj.animate({left: 0}, speed);
	
	//obj.css("left", 0);
	obj.attr("name", "pam_current");			//设置obj为current，当前显示的图片
	//在两图片移动完成后，设置当前图片为pam_null_move，即已经移动完成，位置为父div右侧
	currentNode.attr("name", "pam_null_move");
	
}








