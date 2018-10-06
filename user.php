<?php
include "head.php";

if (!isset($_SESSION['UNAME']))
	header("Location: /login.php");

$data = send_query_arr(["select"=>"*", "from"=>"users", "where"=>"Username='".$_SESSION['UNAME']."'"])[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include "admin/auth.php";
	if ($data["md5"] != md5($_POST["PASS"]) || $_POST["NPASS"] != $_POST["NPASS2"]){
	?>
		<div class="form error">
	<?php
}

?>

<div class="form user-info">
	<h2>User information</h2>
	<hr>
	<ul>
		<li>Username: <?php echo $data["username"] ?></li>
		<li>Email: <?php echo $data["email"] ?></li>
	</ul>
</div>

<form class="form" method="post">
	<div>
		<label for="EMAIL">Change Email</label>
		<input type="email" name="EMAIL" placeholder="Enter new email">
	</div>
	<div>
		<label for="PASS">Change Password</label>
		<input type="password" name="NPASS" placeholder="Enter new password">
		<input type="password" name="NPASS2" placeholder="Re-enter new password">
	</div>
	<div>
		<label for="PASS">Change Email</label>
		<input type="password" name="PASS" placeholder="Enter your current password">
	</div>
	<button
		class="g-recaptcha"
		data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
		data-callback="on_submit">
		Save
	</button>
</form>