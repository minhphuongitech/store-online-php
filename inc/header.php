<?php 
    include 'lib/session.php';
    Session::init();
?>

<?php 

	include_once 'lib/database.php';
	// include_once 'helpers/constant.php';
	include_once 'helpers/format.php';
	include_once 'helpers/constantPVS.php';

	spl_autoload_register(function($className){
		include_once  'classes/'.$className.'.php';
	});

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cat = new category();
	$product = new product();
	$cs = new customer();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
				    	<input type="text" name="keyword" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
										$check_cart = $ct->check_cart();
										if ($check_cart) {
											$subTotalSession = Session::get("sub_total");
											if($subTotalSession == NULL || $subTotalSession == 0) {
												$subTotal = 0;
												while ($result = $check_cart->fetch_assoc()) {
													$subTotal += $result['price'];
												}
												$subTotalSession = $subTotal;
											}
											echo $subTotalSession;
										} else {
											echo "(empty)";	
										}
									?>
								</span>
							</a>
						</div>
			      </div>
			      <div class='login'>
			      <?php 
			    	if(Session::get('customer_login')) {
			    		echo "<a href='?customer_id=".Session::get('customer_id')."'>Logout</a>";	
			    	}else {
			    		echo "<a href='login.php'>Login</a>";	
			    	}

			    	if(isset($_GET['customer_id']) && $_GET['customer_id'] != NULL) {
			    		$deleteResult = $ct->deleteAllCartBySessionId();
			    		Session::destroy();
			    	}
					?>

		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php 
	  	$checkOrdered = $ct->check_ordered();
		if($checkOrdered) {
			echo "<li><a href='orderdetails.php'>Ordered</a></li>";	
		}
		?>
	  <li><a href="cart.php">Cart</a></li>
	  <?php 
		if(Session::get('customer_login')) {
			echo "<li><a href='profile.php'>Profile</a></li>";	
		}
		?>
		<?php 
			if(Session::get('customer_login')) {
				echo "<li><a href='compare.php'>Compare</a> </li>";	
			}
			?>
		<?php 
			if(Session::get('customer_login')) {
				echo "<li><a href='wishlist.php'>Wishlist</a> </li>";	
			}
			?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>