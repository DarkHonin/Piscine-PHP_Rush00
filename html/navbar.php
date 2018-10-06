<nav class='nav-horisontal'>
	<a class="nav-item" href="/">
		<img id="logo" src="https://pbs.twimg.com/profile_images/1002259962075238400/7hlbCkfp_400x400.jpg" width="150px" height="150px"/>
	</a>
	<div  class="nav-item nav-dropdown">
		<a href="cart.php" class="nav-dropdown-title">Cart</a>
		<div class="nav-dropdown-content">
			<?php
				/** 
				 * 		The cart will be stored in session in the following way:
				 * 				[ ItemID => Amount, ...]
				 **/

				if (!isset($_SESSION['CART']) || empty($_SESSION['CART']))
					echo "<span class='cart-empty'>Your cart appears to be empty</span>";
				else{
					foreach($_SESSION['CART'] as $id=>$amount){
						$item = send_query_arr(["select"=>"*", "from"=>"products", "where"=>"id=$id"])[0];
			?>
					<div class="cart-item">
						<label class="cart-item-name"><span class='cart-item-amount'><?php echo $amount?>x</span><?php echo $item['name']?></label>
					</div>
			<?php 		}
					}?>
		</div>
	</div>
<?php

if (isset($_SESSION['UNAME'])){
	?>
		<div class="nav-item">
			<a href="/user.php">Welcome back _<?php echo $_SESSION['UNAME'] ?></a>
		</div>
		<div class="nav-item">
			<a href="/logout.php">Logout</a>
		</div>
	<?php
}else{
	?>
		<div class="nav-item">
			<a href="/login.php">Login</a>
		</div>
		<div class="nav-item">
			<a href="/register.php">Resgister</a>
		</div>
	<?php
}

?>
</nav>