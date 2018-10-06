<?php
include "core/database_utils.php";

$connection = new r00\DB("localhost", "root", "password", "R00");
$unames = $connection->send_query_arr(["select"=>"*", "from"=>"users", "where"=>"Username='".$_POST["UID"]."'"]);
if(!empty($unames))
	die("Username already in use");
$connection->send_query_arr(["insert"=>[
											"into"=>"users", 
											"cols"=>["Username", "BasketID", "md5"], 
											"vals"=>[$_POST["UID"], "Null", md5($_POST["PWD"])]
											]]);

?>