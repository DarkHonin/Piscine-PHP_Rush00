<nav class='nav-horisontal'>
<?php
function ren($ENV){
	foreach($ENV as $k=>$e){
		
		if (is_array($e))
		{
			echo "<div class='nav-dropdown'><h4>$k</h4>";
			ren($e);
			echo "</div>";
		}
		else
			echo "<a class='nav-item' href='$e'>$k</a>";
	}
}
ren($ENV);
?>
<form class="nav-item" method="post" action="auth.php" id="auth">
    <input type='hidden' name="QUERY" value="login">
    <input type="text" name="UID" required="true">
    <input type="password" name="PWD" required="true">
    <button
    	class="g-recaptcha"
    	data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
    	data-callback="on_submit">
    	login
	</button>
</nav>