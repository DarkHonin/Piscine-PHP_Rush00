<?php

require( "../init.php");

	function is_human(){
		check_args('captcha');

		$data = [
			"secret" => "6LcYd3MUAAAAAM8wdVbimXbs9D_RmWMWy7KmGxFC",
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
		if ($result === FALSE){
			echo("failed to comunicate to reCaptcha server server");
			header("Location: ".$_POST["REDIRECT"]);
		}
	}

	function check_args($for){
		$expected = [
			"captcha" =>	[	"g-recaptcha-response",
								"QUERY"],
			"register" =>	[	"UID",
								"EMAIL",
								"PASS2",
								"PASS"]
		];
		foreach($expected[$for] as $e)
			if (!isset($_POST[$e]) || empty($_POST[$e])){
				echo("An error occurd prosessing the request. Missing $e");
				//header("Location: /");
			}
	}

	function register(){
		check_args('register');
		$unames = send_query_arr(["select"=>"*", "from"=>"users", "where"=>"Username='".$_POST["UID"]."'"]);
		if ($_POST["PASS"] != $_POST["PASS2"])
			die("Passwords do not match");
		if(!empty($unames))
			die("Username already in use");
		send_query_arr(["insert"=>[
											"into"=>"users", 
											"cols"=>["Username", "SessionToken", "md5", "email"], 
											"vals"=>[$_POST["UID"], md5("password"), md5($_POST["PASS"]), $_POST["EMAIL"]]
											]]);
		header("Location: /");
	}

function login(){
		$unames = send_query_arr(["select"=>"*", "from"=>"users", "where"=>"Username='".$_POST["UID"]."'"]);
		if(empty($unames))
			die("Login invalid");
		$pss = md5($_POST["PASS"]);
		print_r([$pss, $unames[0]["md5"]]);
		if ($pss == $unames[0]["md5"])
		{
			$_SESSION["UNAME"] = $_POST["UNAME"];
			$_SESSION["TOKEN"] = md5(time());
			header("Location: /");
		}else
			die("Login invalid");
	}


header("Content-type: text/plain");

is_human();
echo "Captcha OK\n";
$q = $_POST["QUERY"];
$q();

?>