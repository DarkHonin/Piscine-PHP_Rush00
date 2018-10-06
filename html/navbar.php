<nav class='nav-horisontal'>
	<a href="/">
		<img id="logo" src="https://pbs.twimg.com/profile_images/1002259962075238400/7hlbCkfp_400x400.jpg" width="150px" height="150px"/>
	</a>
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
</nav>