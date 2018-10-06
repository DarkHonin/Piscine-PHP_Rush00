<html>
<head>
	<title>Brasket</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
		function on_submit(token) {
    		document.getElementById("auth").submit();
		}
	</script>
</head>
<?php
require_once("./templates/template_build.php");
echo \Template\render_part("navbar", [
	"Home" 			=> "/",
	"Catagories"	=> "/catagories",
	"Dropdown"		=>	[
		"Opt 1"	=> "Some url"
	],
	"login" => false
]);

?>
<h1>Register</h1>
<form class="nav-item" method="post" action="admin/auth.php" id="auth">
    <input type='hidden' name="QUERY" value="register">
	<input type='hidden' name="REDIRECT" value="http://<?php echo (isset($_POST["REDIRECT"]) ? $_POST["REDIRECT"] : "/") ?>">
    <input type="text" name="UID" required="true">
    <input type="password" name="PASS" required="true">
    <button
    	class="g-recaptcha"
    	data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
    	data-callback="on_submit">
    	login
	</button>
</nav>
</html>