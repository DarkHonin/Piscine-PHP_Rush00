<?php

$expected = [
	"UID",
	"QUERY",
	"g-recaptcha-response"
];

$captcha_key = "6LcYd3MUAAAAAM8wdVbimXbs9D_RmWMWy7KmGxFC";

foreach($expected as $e)
	if (!isset($_POST[$e]) || empty($_POST[$e]))
		die("An error occurd prosessing the request. Missing $e");

$data = [
	"secret" => $captcha_key,
	"response"=> $_POST['g-recaptcha-response']
];
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents("https://www.google.com/recaptcha/api/siteverify", false, $context);
if ($result === FALSE)
	die("failed to comunicate to reCaptcha server server");

if ($_POST["QUERY"] == "register")
	include "admin/register.php";

?>