<html>
<head>
<meta charset="UTF-8" />
<title>登陆</title>
</head>
<link  rel="stylesheet" type="text/css" href="/52weis/public/script/css/body/login.css"/>
<body>
<div class="left">
	<img src="/52weis/public/script/img/login.jpg"/>
</div>
<form class="right" method="post" action="/login.html">
	<div>登陆啦</div>
    <div>
    	<input type="text" name="username" value="用户名" />
    </div>
    <div style="padding:0;color:red;font-size:14px;font-weight:400"><?php echo $error; ?></div>
    <div>
    	<input type="password" name="password" value="密码"/>
    </div>
    <div class="submit">
    	<input type="submit" value="登陆"/>
    </div>
</form>
</body>
</html>
