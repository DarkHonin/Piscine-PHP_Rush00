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
		
			echo render_part("navbar", [
			"Register" => "/register.php"
		]);
		
		?>
	</header>
		<form align="center" class="auth_form" method="post" action="admin/auth.php" id="auth">
			<input type='hidden' name="QUERY" value="login">
			<input name="UID" type="text" placeholder="Username" required /><br><br>
			<input name="PASS" type="password" placeholder="password" required /><br><br>
			<button
				class="g-recaptcha"
				data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
				data-callback="on_submit">
				Login
			</button>
			<p style="color: white">Forgot your password?<a href="#" style="color: white"> Click here</a></p>
		</form>
		<hr style="color:aliceblue">

</body>
</html>