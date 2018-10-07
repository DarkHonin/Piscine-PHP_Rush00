<?php
if(isset($_POST))
	foreach($_POST as $k=>$v)
		$_POST[$k] = htmlentities(trim($v));
if(isset($_GET))
	foreach($_GET as $k=>$v)
		$_GET[$k] = htmlentities(trim($v));

if(!session_status() == 0)
	session_start();
include "core/database_utils.php";

function add_redirect($url){
	if ($url == "/")
		return ($url."?redirect=".$_SERVER['REQUEST_URI']);
	else
		return ($url."&redirect=".$_SERVER['REQUEST_URI']);
}	

?>