<?php
include "head.php";

if (!isset($_SESSION['UNAME']) || empty($_SESSION['UNAME'])
	header("Location: /login.php?redirect=".$_SERVER['REQUEST_URI']);

$data = send_query_arr(["select"=>"*", "from"=>"users", "where"=>"Username='".$_SESSION['UNAME']."'"])[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include "admin/auth.php";
	if ($data["md5"] != md5($_POST["PASS"]) || (isset($_POST["NPASS"]) && ($_POST["NPASS"] != $_POST["NPASS2"]))){
	?>
		<div class="form error">
			<?php	if ($_POST["NPASS"] != $_POST["NPASS2"])
						echo "<p>Passwords do not match</p>";
					if ($data["md5"] != md5($_POST["PASS"]))
						echo "<p>Invalid current password submitted</p>";
			?>
		</div>
	<?php
	}else{
		if(isset($_POST['EMAIL']) && !empty($_POST['EMAIL']))
		{
			send_query_arr(["update"=>"users", "set"=>"email='".$_POST['EMAIL']."'", "where"=>"username='".$_SESSION['UNAME']."'"]);
			$data["email"] = $_POST['EMAIL'];
			unset($_POST['EMAIL']);
		}
		if (!empty($_POST["NPASS"])){
			send_query_arr(["update"=>"users", "set"=>"md5='".md5($_POST['NPASS'])."'", "where"=>"username='".$_SESSION['UNAME']."'"]);
		}
		if (isset($_POST["DELETE"])){
			send_query_arr(["delete"=>["from"=>"useres"], "where"=>"username='".$_SESSION['UNAME']."'"]);
			header("Location: /logout.php");
		}
	}
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

<form class="form userdata" method="post" id="auth">
	<div>
		<label for="EMAIL">Change Email</label>
		<input type="email" name="EMAIL" placeholder="Enter new email" <?php echo(isset($_POST['EMAIL']) ? "value='".$_POST['EMAIL']."'": "")?>>
	</div>
	<div>
		<label for="PASS">Change Password</label>
		<input type="password" name="NPASS" placeholder="Enter new password">
		<input type="password" name="NPASS2" placeholder="Re-enter new password">
	</div>
	<div>
		<label for="PASS">Current Password</label>
		<input type="password" name="PASS" placeholder="Enter your current password">
	</div>
	<div>
		<label for="DELETE" style="color: red;">Delete my account</label>
		<input type="checkbox" name="DELETE">
	</div>
	<button
		class="g-recaptcha"
		data-sitekey="6LcYd3MUAAAAAEXNkgBpwbjKHDf33VE9eS2NICbn"
		data-callback="on_submit">
		Save
	</button>
</form>