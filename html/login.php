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
	"login" => true
]);

?>
</html>