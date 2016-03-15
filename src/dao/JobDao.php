<?php

require_once get_include_path().'/52weis/data/job/Job.php';
require_once get_include_path().'/52weis/src/common/JobSql.php';
require_once get_include_path().'/52weis/src/common/DbFactory.php';
use \common\DbFactory;
use \common\JobSql;
use \job\Job;

function query_jobs_by_date_name($start, $end, $name){
	$query = JobSql::$JOB_LIST.JobSql::$QUERY_JOBS_BY_DATE_NAME.'\'%'.$name.'%\'';
	$pars = array (
			$start,
			$end
	);
	return getJobsByPars("ss", $pars, $query);
	
}

function query_jobs_nums_by_date_name($start, $end, $name,$source){
	$query = JobSql::$QUERY_JOBS_NUMS__BY_DATE_NAME.'\'%'.$name.'%\' group by PUBLISH_DATE';
	$pars = array (
			$start,
			$end,
			$source
	);
	return getJobsNumsByPars("sss", $pars, $query);

}

function query_jobs_nums_by_date($start, $end){
	$query =JobSql::$QUERY_JOBS_NUMS_BY_DATE;
	$pars = array (
			$start,
			$end
	);
	return getJobsNumsByPars("ss", $pars, $query);

}

function query_jobs_by_date($start, $end){
	$query = JobSql::$JOB_LIST.JobSql::$QUERY_JOBS_BY_DATE;
	$pars = array (
			$start,
			$end
	);
	return getJobsByPars("ss", $pars, $query);

}

function getJobsByPars($type, $par, $query) {
	$jobList = array ();
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
		mysqli_stmt_bind_result ( $stmt, $id, $job_detail, $company_name, $publish_date, $area);
			
		/* fetch value */
			
		while ( mysqli_stmt_fetch ( $stmt ) ) {
			$job = new Job ();
			$job->id = $id;
			$job->job_detail = $job_detail;
			$job->company_name = $company_name;
			$job->publish_date = $publish_date;
			$job->area = $area;
			array_push ( $jobList, $job );
		}
		/* close statement */
		mysqli_stmt_close ( $stmt );
	}
	/* close connection */
	return $jobList;
}

function getJobsNumsByPars($type, $par, $query) {
	$jobList = array ();
	$link =  DbFactory::getInstance();
	/* create a prepared statement */
	if ($stmt = mysqli_prepare ($link, $query )) {
		/* bind parameters for markers */
		mysqli_stmt_bind_param ( $stmt, $type, $par [0], $par [1],$par [2]);
		mysqli_stmt_execute ( $stmt );
		mysqli_stmt_bind_result ( $stmt, $nums, $date);
		while ( mysqli_stmt_fetch ( $stmt ) ) {
			array_push ( $jobList, [$nums, $date]);
		}
		mysqli_stmt_close ( $stmt );
	}
	return $jobList;
}


?>