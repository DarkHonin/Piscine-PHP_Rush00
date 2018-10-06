<?php

namespace r00;

class DB{    
	private $CON;
	public static $instance;

	function __construct($host, $uname, $pass, $db){
		$this->CON = mysqli_connect($host, $uname, $pass, $db);
		if (mysqli_connect_errno())
			die("Failed to connect to the database: ".mysqli_connect_error());
		DB::$instance = $this;
	}
	
	function __destruct(){
		mysqli_close($this->CON);
	}

	function build_query($query_array){
		$str = "";
		foreach($query_array as $k=>$v)
		{
			$class = query_provider($k);
			if (empty($str))
				$obj = new $class();
			else
				$obj = new $class($str);
			$obj->a($query_array);
			$str = $obj->get_query_string();
		}
		return $str;
	}

	function send_query_arr($q_arr){
		$qs = $this->build_query($q_arr);
		return $this->send_query($qs);
	}

	function send_query($str){
		$token = mysqli_query($this->CON, $str);
		if($err = mysqli_error($this->CON))
			die($err." >>> ".$str);
		$ret = [];
		if (gettype($token) == "boolean")
			return ($token);
		while($data = mysqli_fetch_assoc($token)){
			array_push($ret, $data);
		}
		return $ret;
	}
}

function query_provider($str){
	static $query_objs = [
		"select"    => \r00\Query_Select::class,
		"from"      => \r00\Query_From::class,
		"where"		=> \r00\Query_Where::class,
		"insert"	=> \r00\Query_Insert::class
	];
	return $query_objs[$str];
}

function select($str, $args){
	if (!array_key_exists("select", $args))
		error_log("Query expected key `select`");
	$str .= "SELECT ".$args['select'];
}

function from($str, $args){
	if (!array_key_exists("from", $args))
		error_log("Query expected key `from`");
	$str .= " FROM ".$args['from'];
}

function where($str, $args){
	if (!array_key_exists("where", $args))
		error_log("Query expected key `where`");
	$str .= " WHERE ".$args['where'];
}

function insert($str, $args){
	if (!array_key_exists("insert", $args))
		error_log("Query expected key `insert`");
	$str .= "INSERT ".($args['insert']['into']);
	$str .=('('.implode(", ", $args['insert']['cols']).')');
	$str .=(" VALUES ");
	$str .=("('".implode("', '", $args['insert']['vals'])."')");
}


?>