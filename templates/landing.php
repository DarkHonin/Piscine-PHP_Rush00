<?php
require_once("init.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Brasket</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="sign_up.css" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
		function on_submit(token) {
    		document.getElementById("auth").submit();
		}
	</script>
</head>
<body>
	<header>
		<?php		
		
			echo \Template\render_part("navbar", [
			"Home" 			=> "/",
			"Catagories"	=> "/catagories",
			"Dropdown"		=>	[
				"Opt 1"	=> "Some url"
			],
			"login" => true
		]);
		
		?>
	</header>
		
	<footer>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About us</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</footer>
</body>
</html>