<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>新增博客</title>
<script charset="utf-8" src="/52weiss/public/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/52weiss/public/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="/52weiss/public/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/52weiss/public/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/52weiss/public/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/52weiss/public/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="/52weiss/public/kindeditor/plugins/code/prettify.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });

        var options = {
        		allowFlashUpload : false,
        };
        var editor = K.create('textarea[name="content"]', options);

        KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '../plugins/code/prettify.css',
				uploadJson : '../php/upload_json.php',
				fileManagerJson : '../php/file_manager_json.php',
				allowFileManager : true,
			});
		});
</script>
</head>
<body>
	<form name="example" method="post" action="/addBlog.html">
<select name="category_id">

<?php 
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
$service = new ArticleQueryService();
$list = $service->queryCategory(2);
echo '<option selected="selected" value="'.$list[0]->id.'">请选择目录</option>';
foreach($list as $it){
	echo '<option  value="'.$it->id.'">'.$it->name.'</option>';
}
?>

		</select>
		<select name="portal_area">
			<option value="0">是否发布到首页</option>
			<option value="1">首页大图右侧展示区</option>
			<option value="2">首页推荐文章区</option>
			<option value="0">不需要</option>
		</select>
		标题：<input type="text" id="title" name="title" ></input>
		作者：<input type="text" name="author"/>
		文章地址(转载请填上)：<input type="text" name="url"/>
		<textarea id="editor_id" name="content" style="width:700px;height:300px;">
</textarea>
<input type="submit"  value="提交"/>
	</form>

</body>

<script>
		
</script>


</html>