
	<?php
	include "head.php";	
	?>
	<div class="product-list">
	<?php
	if(isset($_GET['filter']))
		$products = send_query_arr(["select"=>"*", "from"=>"products", "where"=>"Catagory='".$_GET['filter']."'"]);
	else
		$products = send_query_arr(["select"=>"*", "from"=>"products"]);
	foreach($products as $p){
		?>
		<div class="product" id="p<?php echo $p["id"] ?>">
			<div class="product-image">
				<img src="img/<?php echo $p["image"] ?>">
			</div>
			<div class="product-info">
				<h2><?php echo $p["Name"] ?>
				<a class="catagory <?php echo $p["Catagory"] ?>" href="/?filter=<?php echo $p["Catagory"] ?>"><?php echo $p["Catagory"] ?></a>
				</h2>
				<div class="product-description"><?php echo $p["Description"] ?></div>
				<p class="product-controll">
				<span class="price">R<?php echo $p["price"] ?></span>
				<a class="cart-add" href="/cart.php?action=add&item=<?php echo $p["id"] ?>">Add to cart</a>
			</p>
			</div>
		</div>
		<?php
	}
	?>
	</div>
</body>
</html>

