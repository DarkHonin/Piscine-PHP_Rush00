<?php

include "init.php";
if (!isset($_SESSION['UNAME']) || empty($_SESSION['UNAME']))
	header("Location: /login.php?redirect=".$_SERVER['REQUEST_URI']);
$_SESSION["CART"] = [];
?>
<div class="product" id="p<?php echo $p["id"] ?>">
	<div class="product-info">
		<h2>Empty?</h2>
		<div class="product-description">Thank you for your purchace.</div>
		<a class="cart-add" href="/">Back to home</a>
	</div>
</div>