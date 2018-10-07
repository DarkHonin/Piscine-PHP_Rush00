<?php
include "init.php";

function is_product($id){
	$p = send_query_arr(["select"=>"*", "from"=>"products", "where"=>"id='$id'"]);
	return (!empty($q));
}

function	add_item(){
	if (is_product($_GET["item"]))
		return ;
	if (!is_array($_SESSION['CART']))
		$_SESSION['CART'] = [];
	if (array_key_exists($_GET["item"], $_SESSION['CART']))
		$_SESSION['CART'][$_GET["item"]]++;
	else
		$_SESSION['CART'][$_GET["item"]] = 1;
}

function	del_item(){
	if (is_product($_GET["item"]))
		return ;
	if (!is_array($_SESSION['CART']))
		return;
	if (array_key_exists($_GET["item"], $_SESSION['CART']))
		$_SESSION['CART'][$_GET["item"]]--;
	if ($_SESSION['CART'][$_GET["item"]] <= 0)
		unset($_SESSION['CART'][$_GET["item"]]);
}

if (isset($_GET['action']) && !empty($_GET['action'])){
	if ($_GET['action'] == "add")
		add_item();
	if ($_GET['action'] == "del")
		del_item();
	if ($_GET['action'] == "check"){
		header("Location: /login.php?action=checkout");
		exit();
	}
	print_r($_SESSION);
	if($_GET['redirect'])
		header("Location: ".$_GET['redirect']);
	else
		header("Location: /");
	exit();
}
include "head.php";
?>
<div class="product-list">

<?php
	if (!isset($_SESSION['CART']) || empty($_SESSION['CART'])){
	?>
		<div class="product" id="p<?php echo $p["id"] ?>">
			<div class="product-info">
				<h2>Empty?</h2>
				<div class="product-description">Your cart seems to be empty.</div>
			</div>
		</div>
	<?php
	}else{
		$total = 0;
		$count = 0;
		foreach($_SESSION['CART'] as $id=>$amount){
			if (!is_product($id)){
				$p = send_query_arr(["select"=>"*", "from"=>"products", "where"=>"id='$id'"])[0];
				$total += $amount * $p["price"];
				$count += $amount;
		?>
		<div class="product" id="p<?php echo $p["id"] ?>">
			<div class="product-image">
				<img src="img/<?php echo $p["image"] ?>">
			</div>
			<div class="product-info">
				<h2><?php echo $amount ?>x <?php echo $p["Name"] ?>
				<label class="catagory <?php echo $p["Catagory"] ?>"><?php echo $p["Catagory"] ?></label>
				</h2>
				<div class="product-description"><?php echo $p["Description"] ?></div>
				<p class="product-controll cart">
				<span class="price">R<?php echo $p["price"] ?></span>
				<a class="cart-add" href="<?php echo  add_redirect("/cart.php?action=add&item=".$p["id"]) ?>">Add more</a>
				<a href="<?php echo add_redirect("/cart.php?action=del&item=".$p['id'])?>" class="cart-remove">X</a></label>
			</p>
			</div>
		</div>
		<?php
			}
		}
	}
	if (isset($_SESSION['CART']) || !empty($_SESSION['CART'])){
?>

</div>
<div class="basket_info">
<h2>Summary</h2>
<hr>
<ul>
	<li>Items: <span><?php echo $count ?></span></li>
	<li>Total: <span>R<?php echo number_format($total, 2) ?></span></li>
	<li><a href="<?php echo add_redirect("/cart.php?action=check")?>">Checkout</a>
</ul>
</div>
	<?php } ?>