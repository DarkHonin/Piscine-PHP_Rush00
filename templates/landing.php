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
			$arr = [];
			if (isset($_SESSION['UNAME']))
			{
				$arr["Welcome ".$_SESSION['UNAME']] = "/user.php";
				$arr["Logout"] = "/logout.php";
			}else
			{
				$arr["Login"] = "/login.php";
				$arr["Register"] = "/register.php";
			}
			echo render_part("navbar", $arr);
		?>
	</header>
	<?php
	
	$products = send_query_arr(["select"=>"*", "from"=>"products"]);
	foreach($products as $p){
		?>
		<div class="product" id="p<?php echo $p["id"] ?>">
			<h2><?php echo $p["Name"] ?></h2>
			<img src="<?php echo $p["image"] ?>">
			<div><?php echo $p["Description"] ?></div>
			<p><span class="price">R<?php echo $p["Price"] ?></span>
				<a href="/cart.php?action=add&item=<?php echo $p["id"] ?>">Add to cart</a>
			</p>
		</div>
		<?php
	}
	?>
</body>
</html>