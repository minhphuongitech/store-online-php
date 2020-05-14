<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php 
	$cusId = Session::get('customer_id');
	if(isset($_GET['delid']) && $_GET['delid'] != NULL) {
		$deleteWishlist = $product->deleteWishlist($_GET['delid'], $cusId);
	}

	if($cusId == NULL) {
		echo "<script>window.location = 'login.php'</script>";
	} else {
		$wishlist = $product->getWishlistByCustomer($cusId);
	}
?>

 <style type="text/css">
 	.box_left {
 		border: 1px solid;
    	width: 100%;
 	}
 	
 	.atag a,.search a.grey{
	    padding:10px 15px;
	    font-size:15px;
	    font-weight:bold;
	    color             : #fff;
	    -webkit-box-shadow: 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        -moz-box-shadow   : 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        box-shadow        : 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;  
        cursor:pointer;   
	}

	 a.grey,.search a.grey{
		 	border            : 1px solid #303030;
	        background        : #3f4040;
	        background        : -moz-linear-gradient(top,  #3f4040 0%, #303131 100%);
	        background        : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3f4040), color-stop(100%,#303131));
	        background        : -webkit-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : -o-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : -ms-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : linear-gradient(top,  #3f4040 0%,#303131 100%);
	        filter            : progid:DXImageTransform.Microsoft.gradient( startColorstr='#3f4040', endColorstr='#303131',GradientType=0 );
	        text-shadow       : 0 1px 0 rgba(0, 0, 0, 0.4);
	}
	 a.grey:hover,.search a.grey:hover{
		        border            : 1px solid #303030;
	        background        : #525252;
	        background        : -moz-linear-gradient(top,  #525252 0%, #454646 100%);
	        background        : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#525252), color-stop(100%,#454646));
	        background        : -webkit-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : -o-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : -ms-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : linear-gradient(top,  #525252 0%,#454646 100%);
	        filter            : progid:DXImageTransform.Microsoft.gradient( startColorstr='#525252', endColorstr='#454646',GradientType=0 );
	        text-shadow       : 0 1px 0 rgba(0, 0, 0, 0.4);  
	}

	span.error {
		color: red;
	}

	span.success {
		color: green;
	}

	.submit_order {
		background-color: rgb(245, 47, 7);
	    color: white;
	    padding: 15px;
	    font-weight: bold;
	    border-radius: 5px;
	    cursor: pointer;
	}

	.submit_order:hover {
		background-color: rgb(237, 75, 43);
		color: rgb(232, 232, 232);
	}

 </style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    			<h3><?= _YOUR_WISHLIST?></h3>
	    			<?php 
	    				if(isset($deleteWishlist)) {
	    					echo $deleteWishlist;
	    				}
	    			?>
	    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
		    			<div class="cartpage">
			    	<h2 style="font-size: 22px;"><?= _PRODUCTS_LIST?></h2>
						<table class="tblone">
							<tr>
								<th style="font-size: 16px" width="5%"><?= _NO?></th>
								<th style="font-size: 16px" width="30%"><?= _PRODUCT_NAME?></th>
								<th style="font-size: 16px" width="15%"><?= _IMAGE?></th>
								<th style="font-size: 16px" width="25%"><?= _PRICE?></th>
								<th style="font-size: 16px" width="25%"><?= _ACTION?></th>
							</tr>
							<?php 
								if($wishlist) {
									$i = 0;
									while ($result = $wishlist->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
								<td><a onclick="return confirm('Do you really want to delete?')" href="?delid=<?php echo $result['productId'] ?>"> <?=_REMOVE?> </a> || <a href="details.php?productid=<?php echo $result['productId'] ?>"> <?=_VIEW?> </a></td>
							</tr>
							<?php 
									}
								} else {
									$alert = "<span class='error'>Your products list is empty.</span>";
								}
							?>
						</table>
						<?php 
								if (isset($alert)) {
									echo $alert;
								}
							?>
					</div>
		    		</div>
 		</div>
	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>

