<?php

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

function update(&$str, $args){
	if (!array_key_exists("update", $args))
		error_log("Query expected key `update`");
	$str .= " UPDATE ".$args['update'];
}

function set(&$str, $args){
	if (!array_key_exists("set", $args))
		error_log("Query expected key `set`");
	$str .= " SET ".$args['set'];
}

function insert(&$str, $args){
	if (!array_key_exists("insert", $args))
		error_log("Query expected key `insert`");
	$str .= "INSERT ".($args['insert']['into']);
	$str .=('('.implode(", ", $args['insert']['cols']).')');
	$str .=(" VALUES ");
	$str .=("('".implode("', '", $args['insert']['vals'])."')");
}

function delete(&$str, $args){
	if (!array_key_exists("delete", $args))
		error_log("Query expected key `delete`");
	$str .= "DELETE FROM ".($args['delete']['from']);
}

$CON = mysqli_connect("localhost", "root", "password", "r00");
if (mysqli_connect_errno())
	die("Failed to connect to the database: ".mysqli_connect_error());

function build_query($query_array){
	$str = "";
	foreach($query_array as $k=>$v)
	{

		$k($str, $query_array);
	}
	return $str;
}

function send_query_arr($q_arr){
	$qs = build_query($q_arr);
	return send_query($qs);
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