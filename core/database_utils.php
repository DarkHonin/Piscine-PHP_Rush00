<?php

namespace r00;

function select(&$str, $args){
	if (!array_key_exists("select", $args))
		error_log("Query expected key `select`");
	$str .= "SELECT ".$args['select'];
}

function from(&$str, $args){
	if (!array_key_exists("from", $args))
		error_log("Query expected key `from`");
	$str .= " FROM ".$args['from'];
}

function where(&$str, $args){
	if (!array_key_exists("where", $args))
		error_log("Query expected key `where`");
	$str .= " WHERE ".$args['where'];
}

function insert(&$str, $args){
	if (!array_key_exists("insert", $args))
		error_log("Query expected key `insert`");
	$str .= "INSERT ".($args['insert']['into']);
	$str .=('('.implode(", ", $args['insert']['cols']).')');
	$str .=(" VALUES ");
	$str .=("('".implode("', '", $args['insert']['vals'])."')");
}

$CON = mysqli_connect($host, $uname, $pass, $db);
if (mysqli_connect_errno())
	die("Failed to connect to the database: ".mysqli_connect_error());


function build_query($query_array){
	$str = "";
	foreach($query_array as $k=>$v)
	{
		$q = "r00\\$k";
		$q($str, $query_array);
	}
	return $str;
}

function send_query_arr($q_arr){
	$qs = $this->build_query($q_arr);
	return $this->send_query($qs);
}

function send_query($str){
	global $CON;
	$token = mysqli_query($CON, $str);
	if($err = mysqli_error($CON))
		die($err." >>> ".$str);
	$ret = [];
	if (gettype($token) == "boolean")
		return ($token);
	while($data = mysqli_fetch_assoc($token)){
		array_push($ret, $data);
	}
	return $ret;
}



?>