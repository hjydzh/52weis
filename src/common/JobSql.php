<?php

namespace common;

class JobSql {
	
	public static $JOB_LIST = "SELECT J.ID, J.JOB, J.COMPANY_NAME, J.PUBLISH_DATE, J.AREA FROM JOBS AS J";
	
	public static $QUERY_JOBS_BY_DATE= " WHERE PUBLISH_DATE > ? AND PUBLISH_DATE <=?";
	
	public static $QUERY_JOBS_BY_DATE_NAME= " WHERE PUBLISH_DATE > ? AND PUBLISH_DATE <=? AND COMPANY_NAME LIKE";
	
	public static $QUERY_JOBS_NUMS_BY_DATE = 
	"select count(1),PUBLISH_DATE
from jobs
WHERE PUBLISH_DATE > ? AND PUBLISH_DATE <=?
group by PUBLISH_DATE";

	
	public static $QUERY_JOBS_NUMS__BY_DATE_NAME= "select count(1),PUBLISH_DATE
from jobs
WHERE PUBLISH_DATE > ? AND PUBLISH_DATE <=? AND SOURCE=? AND COMPANY_NAME LIKE";
	
};
?>