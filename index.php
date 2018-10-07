
	<?php
	include "head.php";	
	?>
	<div class="filter">
		<h2>Filter</h2>
		<hr>
		<form class="filer_items">
			<div>
				<label for="catagory">Catagoty</label>
				<select class="filt" name="Catagory">
					<option value="4">All</option>
					<option value="0">Mundane</option>
					<option value="1">Special</option>
					<option value="2">Exceptional</option>
					<option value="3">Elderich</option>
				</select>
			</div>
			<div>
				<label for="min-price">Starting Price</label>
				<input class="filt" type="number" name="min-price">
			</div>
			<div>
				<label for="max-price">Maximum Price</label>
				<input class="filt" type="number" name="max-price">
			</div>
			<input class="filt" type="submit" value="Filter">
		</form>
	</div>
	<div class="product-list">
	<?php


	$catagories = [
		"Mundane",
		"Special",
		"Exceptional",
		"Elderich"
	];

	$Keys = [
		"Catagory",
		"min-price",
		"max-price"
	];

	$Query = [];

	foreach($Keys as $v){
		if (isset($_GET[$v])&& is_numeric($_GET[$v])){
			if ($v=="min-price")
				array_push($Query, "Price>='$_GET[$v]'");
			if ($v=="max-price")
				array_push($Query, "Price<='$_GET[$v]'");
			if ($v=="Catagory" && $_GET[$v] <= 3)
				array_push($Query, "Catagory='".$catagories[$_GET[$v]]."'");
		}
	}
	$Query = implode(" AND ", $Query);
	if (!empty($Query))
		$products = send_query_arr(["select"=>"*", "from"=>"products", "where"=>$Query]);
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

