<?php

$templates = [
	"main" => "html/main.php",
	"navbar" => "html/navbar.php"
];

function get_part($alias){
	global $templates;
	return $templates[$alias];
}

function render_part($part, $data){
	$path = get_part($part);
	ob_start();
	$ENV = $data;
	include $path;
	$result = ob_get_contents();
	ob_end_clean();
	return $result;
}


?>