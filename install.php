<?php

include "init.php";
$lines = file("r00.sql");
$templine = "";
foreach ($lines as $line){
	$templine .= $line;
	if (substr(trim($line), -1, 1) == ';')
	{
		send_query($templine);
		$templine = '';
	}
}
header("Location: /");
?>