<?php

require_once get_include_path().'/52weis/src/dao/JobDao.php';


function query_jobs_by_dates($start, $end){
	return query_jobs_by_date($start, $end, null);
}

function query_jobs_nums_by_dates($start, $end){
	return query_jobs_nums_by_date($start, $end, null);
}

function query_jobs_nums_by_date_names($start, $end, $name,$source){
	return query_jobs_nums_by_date_name($start, $end, $name,$source);
}

function query_jobs_by_date_names($start, $end, $name){
	return query_jobs_by_date_name($start, $end, $name);
}



?>