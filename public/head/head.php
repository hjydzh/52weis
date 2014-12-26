<link href="/52weiss/public/script/css/head/head.css" rel="stylesheet" type="text/css"/>
<div id="navigation">	
	<ul id="nav-list">
<?php 
require_once '/52weiss/src/service/ArticleQueryService.php';
use \service\ArticleQueryService;
$service = new ArticleQueryService();
$categorys = $service->queryCategory(1);
foreach ($categorys as $c){
	liCreate($c->name, $c->url);
}
function liCreate($name, $url){
	echo "<li>";
	echo '<a href="'.$url.'">';
	echo $name;
	echo "</a>";
	echo "</li>";
}
	?>
		<br style="clear: both"/>
    </ul>
</div>
<br style="clear: both"/>
