<?php

function current_date($style){
	return date($style,time());
}

function add_date($style, $days){
	return date($style,strtotime($days." day"));
}

//在某一时刻加上多少天
function date_add_date($style, $day, $day_num){
 
	return date($style,strtotime($day_num." day", strtotime($day)));
}

function date_substract_date($style, $day, $day_num){
	return date_add_date($style, $day, 0 - $day_num);
}

function substract_date($style, $days){
	return add_date($style, 0 - $days);
}

function tomorrow($style){
	return add_date($style, 1);
}

function yestday($style){
	return substract_date($style, 1);
}

function diff_between_two_days ($day1, $day2)
{
	$second1 = strtotime($day1);
	$second2 = strtotime($day2);

	if ($second1 < $second2) {
		$tmp = $second2;
		$second2 = $second1;
		$second1 = $tmp;
	}
	return ($second1 - $second2) / 86400;
}


function two_day_split($style,$day1, $day2){
	$days = array ();
	$day1 = date($style,strtotime($day1));
	$i = 0;
	while(true){
		$substracted_date = date_substract_date($style,$day2,$i);
		array_push($days,$substracted_date);
		if($day1==$substracted_date){
			break;
		}
		$i +=1;
	}
	return $days;
}

 
?>