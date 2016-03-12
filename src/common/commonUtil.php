<?php

function print_array_js($array){
	$s = '';
	$s = $s.'[';
	foreach($array as $d){
		$s = $s.'"'.$d.'",';
	}
	$s = $s.']';
	return $s;
}

?>