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

function json_to_array($json_str) {  
	$array = Array();
	$json_array = json_decode($json_str);
    foreach($json_array as $key=>$value) {
    	$temp_array = (array)$json_array[$key];
    	foreach ($temp_array as $key=>$value){
    		$array[$key] = $value;
    	}
     }  
     return $array;  
}

function jsonobject_array($array){
	if(is_object($array)){
		$array = (array)$array;
	}
	if(is_array($array)){
		foreach($array as $key=>$value){
			$array[$key] = jsonobject_array($value);
		}
	}
	return $array;
}

?>