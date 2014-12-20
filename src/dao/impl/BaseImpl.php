<?php

namespace dao\impl;

require_once '/src/common/PublicConstants';
use \common\PublicConstants;

require_once '/src/dao/intf/BaseIntf';
use dao\intf\BaseIntf;

class BaseImpl implements BaseIntf {
	function preQuery($query, $type, $pars) {
		
		$link = mysqli_connect ( PublicConstants::$IP, PublicConstants::$DATA_BASE_USER_NAME, PublicConstants::$DATA_BASE_PASSWD, PublicConstants::$DATA_BASE_NAME );
		
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		/* create a prepared statement */
		if ($stmt = mysqli_prepare($link, $type, $query)) {
		
			/* bind parameters for markers */
			mysqli_stmt_bind_param($stmt, $type, $query);
		
			/* execute query */
			mysqli_stmt_execute($stmt);
		
			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $district);
		
			/* fetch value */
			mysqli_stmt_fetch($stmt);
		
			printf("%s is in district %s\n", $city, $district);
		
			/* close statement */
			mysqli_stmt_close($stmt);
		}
		
		/* close connection */
		mysqli_close($link);
	}
}

?>