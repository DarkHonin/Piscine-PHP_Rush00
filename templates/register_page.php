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
	<form align="center" style="background-color: light-blue" method="post" action="admin/auth.php" id="auth">
			<input type='hidden' name="QUERY" value="register">
			<p style="font-family: Verdana"><u>CREATE AN ACCOUNT</u></p>
			<input id="user_name" name="EMAIL" type="text" placeholder="Email address" required /><br><br>
			<input id="user_name" name="UID" type="text" placeholder="User name" required /><br><br>
			<input id="password" name="PASS" type="password" placeholder="password" required /><br><br>
			<input id="password" name="PASS2" type="password" placeholder="confirm password" required /><br><br>
			<button
				class="g-recaptcha"
				data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
				data-callback="on_submit">
				Register
			</button>
		</form>
		<hr style="color:aliceblue">
	<footer>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About us</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</footer>
</body>
</html>