<?php

namespace r00;

class DB{    
	private $CON;

	function __construct($host, $uname, $pass, $db){
		$this->CON = mysqli_connect($host, $uname, $pass, $db);
		if (mysqli_connect_errno())
			die("Failed to connect to the database: ".mysqli_connect_error());
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

class Query{

	private $QUERY_STRING;

	function __construct($base_str){
		$this->QUERY_STRING = $base_str;
	}

	/* 
		The action returns a new query object configured for possible branches
	*/
	function a($args) : Query{

	}

	function push_var($str){
		$this->QUERY_STRING .= $str;
	}

	public function get_query_string(){
		return $this->QUERY_STRING;
	}
}

class Query_Select extends Query{
	function __construct(){
		parent::__construct("SELECT ");
	}

	function a($args) : Query{
		if (!array_key_exists("select", $args))
			error_log("Query expected key `select`");
		$this->push_var($args['select']);
		return new Query_From($this->get_query_string());
	}
}

class Query_From extends Query{
	function __construct($base_str){
		parent::__construct($base_str." FROM ");
	}

	function a($args) : Query{
		if (!array_key_exists("from", $args))
			error_log("Query expected key `from`");
		$this->push_var($args['from']);
		return $this;
	}
}

class Query_Where extends Query{
	function __construct($base_str){
		parent::__construct($base_str." WHERE ");
	}

	function a($args) : Query{
		if (!array_key_exists("where", $args))
			error_log("Query expected key `where`");
		$this->push_var($args['where']);
		return $this;
	}
}

class Query_Insert extends Query{
	function __construct(){
		parent::__construct("INSERT INTO ");
	}

	function a($args) : Query{
		if (!array_key_exists("insert", $args))
			error_log("Query expected key `insert`");
		$this->push_var($args['insert']['into']);
		$this->push_var('('.implode(", ", $args['insert']['cols']).')');
		$this->push_var(" VALUES ");
		$this->push_var("('".implode("', '", $args['insert']['vals'])."')");
		return $this;
	}
}

?>