<?php
	include "head.php";
?>
	<form align="center" class="auth_form" method="post" action="admin/auth.php" id="auth">
			<input type='hidden' name="QUERY" value="register">
			<p style="font-family: Verdana"><u>CREATE AN ACCOUNT</u></p>
			<input  name="EMAIL" type="text" placeholder="Email address" required /><br><br>
			<input  name="UID" type="text" placeholder="User name" required /><br><br>
			<input  name="PASS" type="password" placeholder="password" required /><br><br>
			<input  name="PASS2" type="password" placeholder="confirm password" required /><br><br>
			<button
				class="g-recaptcha"
				data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
				data-callback="on_submit">
				Register
			</button>
		</form>
		<hr style="color:aliceblue">
</body>
</html>