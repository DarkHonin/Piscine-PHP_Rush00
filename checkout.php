<?php

include_once("init.php");
if (!isset($_SESSION['UNAME']) || empty($_SESSION['UNAME']))
	header("Location: /login.php?redirect=".$_SERVER['REQUEST_URI']);
include "head.php";
$_SESSION["CART"] = [];
?>
<div class="basket_info" id="p<?php echo $p["id"] ?>">
	<div class="product-info">
		<h2>Sucsess!</h2>
		<div class="product-description">Thank you for your purchace.</div>
		<a class="cart-add" href="/">Back to home</a>
	</div>
</div>