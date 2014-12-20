<?php

$wel = "hello world";

/*
 $link = mysqli_connect('localhost', 'root', 'a13870093884', 'test');
 if (!$link) {
 	die('Connect Error (' . mysqli_connect_errno() . ') '
 			. mysqli_connect_error());
 }
 
 echo 'Success... ' . mysqli_get_host_info($link) . "\n";
 $query = "select * from user";
 if($result=mysqli_query($link, $query)){
 	print("very large datas<br/>");
 	while($row = mysqli_fetch_assoc($result)){
 		printf("姓名:%s, 年龄:%s, 性别:%s, 兴趣:%s<br/>", $row['NAME'],$row['AGE'],$row['GENDER'],$row['HOBBIT']);
 	}
 	mysqli_free_result($result);
 }
 
 mysqli_close($link);*/
?>
<?php 
require_once '../head/head.php';
?>