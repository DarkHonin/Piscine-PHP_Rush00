<?php
include "head.php";
?>
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