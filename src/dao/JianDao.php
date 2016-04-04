<?php

require_once get_include_path().'/52weis/data/myblog/Jian.php';
require_once get_include_path().'/52weis/src/common/JianSql.php';
require_once get_include_path().'/52weis/src/common/DbFactory.php';
use \common\DbFactory;
use \common\JianSql;
use \myblog\Jian;


function query_hot_blogs($num, $date){
	$query = JianSql::$BLOG_SELECT.JianSql::$QUERY_HOT_BLOGS;
	$pars = array (
			$date,
			$num
	);
	return getBlogsByPars("ss", $pars, $query);
}

function query_show_time($date){
	$query = JianSql::$QUERY_SHOW_TIME;
	$link =  DbFactory::getInstance();
	if ($stmt = mysqli_prepare ($link, $query )) {
		/* bind parameters for markers */
		mysqli_stmt_bind_param ( $stmt, "s", $date);
		/* execute query */
		mysqli_stmt_execute ( $stmt );
		/* bind result variables */
		mysqli_stmt_bind_result ( $stmt, $min, $avg, $max);
		mysqli_stmt_fetch ( $stmt );
		/* close statement */
		mysqli_stmt_close ( $stmt );
	}
	return [$min, $avg, $max];
}

function query_read_rate($date){
	$query = JianSql::$QUERY_READ_RATE;
	$link =  DbFactory::getInstance();
	if ($stmt = mysqli_prepare ($link, $query )) {
		/* bind parameters for markers */
		mysqli_stmt_bind_param ( $stmt, "s", $date);
		/* execute query */
		mysqli_stmt_execute ( $stmt );
		/* bind result variables */
		mysqli_stmt_bind_result ( $stmt, $before, $after);
		mysqli_stmt_fetch ( $stmt );
		/* close statement */
		mysqli_stmt_close ( $stmt );
	}
	return [$before, $after];

}

function query_date_blogs_nums($date){
	$query = JianSql::$QUERY_BLOGS_NUMS;
	$link =  DbFactory::getInstance();
	$num = 0;
	if ($stmt = mysqli_prepare ($link, $query)) {
		mysqli_stmt_bind_param ( $stmt, "s", $date);
		mysqli_stmt_execute ($stmt);
		mysqli_stmt_bind_result($stmt, $num);
		mysqli_stmt_fetch ( $stmt );
		mysqli_stmt_close ( $stmt );
	}
	return $num;
}

function query_blogs_nums_date($start, $end){
	$query = JianSql::$QUERY_BLOGS_NUMS_DATE;
	$link =  DbFactory::getInstance();
	$num = 0;
	if ($stmt = mysqli_prepare ($link, $query)) {
		mysqli_stmt_bind_param ( $stmt, "ss", $start, $end);
		mysqli_stmt_execute ($stmt);
		mysqli_stmt_bind_result($stmt, $num);
		mysqli_stmt_fetch ( $stmt );
		mysqli_stmt_close ( $stmt );
	}
	return $num;
}

function query_date_author_nums($date){
	$query = 'select count(1) from ('.JianSql::$QUERY_BLOGS_NUMS." group by author_name".') as a';
	$link =  DbFactory::getInstance();
	$num = 0;
	if ($stmt = mysqli_prepare ($link, $query)) {
		mysqli_stmt_bind_param ( $stmt, "s", $date);
		mysqli_stmt_execute ($stmt);
		mysqli_stmt_bind_result($stmt, $num);
		mysqli_stmt_fetch ( $stmt );
		mysqli_stmt_close ( $stmt );
	}
	return $num;
}

function query_views_by_url($url){
	$query = JianSql::$QUERY_VIEWS_BY_URL;
	$link =  DbFactory::getInstance();
	$view = "";
	if ($stmt = mysqli_prepare ($link, $query)) {
		mysqli_stmt_bind_param ( $stmt, "s", $url);
		mysqli_stmt_execute ($stmt);
		mysqli_stmt_bind_result($stmt, $view);
		mysqli_stmt_fetch ( $stmt );
		mysqli_stmt_close ( $stmt );
	}
	return $view;
}


function getBlogsByPars($type, $par, $query) {
	$jianList = array ();
	$link =  DbFactory::getInstance();
	/* create a prepared statement */
	if ($stmt = mysqli_prepare ($link, $query )) {
		/* bind parameters for markers */
		switch (count ( $par )) {
			case 1 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0] );
				break;
			case 2 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1] );
				break;
			case 3 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2] );
				break;
			case 4 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3] );
				break;
			case 5 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4] );
				break;
			case 6 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5] );
				break;
			case 7 :
				mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1], $par [2], $par [3], $par [4], $par [5], $par [6] );
				break;
			default :
				mysqli_stmt_close ( $stmt );
				mysqli_close ( $link );
				return;
		}
			
		/* execute query */
		mysqli_stmt_execute ( $stmt );

			
		/* bind result variables */
		mysqli_stmt_bind_result ( $stmt, $url, $title, $author, $time, $selectedTime, $showTime, $viewNums, $lastViewNums);
			
		/* fetch value */
			
		while ( mysqli_stmt_fetch ( $stmt ) ) {
			$jian = new Jian();
			$jian->url = $url;
			$jian->title = $title;
			$jian->author = $author;
			$jian->time = $time;
			$jian->selectedTime = $selectedTime;
			$jian->showTime = $showTime;
			$jian->viewNums = $viewNums;
			$jian->lastViewNums = $lastViewNums;
			array_push ( $jianList, $jian );
		}
		/* close statement */
		mysqli_stmt_close ( $stmt );
	}
	/* close connection */
	return $jianList;
}
?>