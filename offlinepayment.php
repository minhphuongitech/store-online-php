<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	//Cannot access to this page if user does not login
	if(Session::get('customer_id')) {
		$productCart = $ct->get_product_cart();
		if($productCart) {
			$customerInfo = $cs->get_customer_info();
		} else {
			echo "<script>window.location = 'cart.php'</script>";
		}
	} else {
		echo "<script>window.location = 'login.php'</script>";
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$insertOrder = $ct->insertOrder();
	}
?>

 <style type="text/css">
 	.box_left {
 		border: 1px solid;
    	width: 50%;
    	float: left;
 	}
 	.box_right {
 		border: 1px solid;
    	width: 48%;
    	float: right;
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
	    			<h3>Offline payment method</h3>

	    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
		    			<div class="cartpage">
			    	<h2 style="font-size: 22px;">Your Cart</h2>
						<table class="tblone">
							<tr>
								<th style="font-size: 16px" width="5%">No.</th>
								<th style="font-size: 16px" width="35%">Product Name</th>
								<th style="font-size: 16px" width="10%">Image</th>
								<th style="font-size: 16px" width="20%">Price</th>
								<th style="font-size: 16px" width="5%">Quantity</th>
								<th style="font-size: 16px" width="25%">Total Price</th>
							</tr>
							<?php 
								$ct = new cart();
								$cartList = $ct->get_product_cart();
								if($cartList) {
									$totalPrice = 0;
									$i = 0;
									while ($result = $cartList->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price']; $totalPrice+=$result['price'] ?></td>
								<td><?php echo $result['quantity'] ?>
								</td>
								<td><?php echo $result['price']*$result['quantity'] ?></td>
							</tr>
							<?php 
									}
								}
							?>
						</table>
						<?php 
							$check_cart = $ct->check_cart();
							if ($check_cart) {
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php 
									if(isset($totalPrice)) { 
										echo $totalPrice; 
										Session::set('sub_total', $totalPrice);
									}
									?></td>
							</tr>
							<tr>
								<th>VAT(8%) : </th>
								<td><?php
									if(isset($totalPrice)) {
										$vat = $totalPrice*0.08;
										echo $vat ;
									}?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php 
									if(isset($totalPrice)) {
										echo $totalPrice+$vat;
									}
									 ?> </td>
							</tr>
					   </table>
					   <?php 
					   	} else {
					   		echo "<span>Your cart is empty.</span>";
					   	}
					   ?>
					</div>
		    		</div>
		    		<div class="box_right">
		    			<?php 
    				if($customerInfo){
    					while ($result = $customerInfo->fetch_assoc()) {
    				?>
		    		<table class="tblone">
		    			<tr>
		    				<td>Name</td>
		    				<td>:</td>
		    				<td><?php echo $result['name']?></td>
		    			</tr>
		    			<tr>
		    				<td>City</td>
		    				<td>:</td>
		    				<td><?php echo $result['city']?></td>
		    			</tr>
		    			<tr>
		    				<td>Address</td>
		    				<td>:</td>
		    				<td><?php echo $result['address']?></td>
		    			</tr>
		    			<tr>
		    				<td>Phone</td>
		    				<td>:</td>
		    				<td><?php echo $result['phone']?></td>
		    			</tr>
		    			<tr>
		    				<td>Zip code</td>
		    				<td>:</td>
		    				<td><?php echo $result['zipcode']?></td>
		    			</tr>
		    			<tr>
		    				<td>Email</td>
		    				<td>:</td>
		    				<td><?php echo $result['email']?></td>
		    			</tr>
		    		</table>
		    		<br>
		    		<div align="right" class="atag" style="margin-right: 10px;"><a class="grey" href="editprofile.php">Update</a></div>
		    		<br>
		    		<?php 
		    				}
		    			} else {
		    				echo "<script>window.location = 'index.php'</script>";
		    			}
		    			?>
		    		</div>
        	</div>
 		</div>
 		<br><br>
 		<div align="center">
 			<input class="submit_order" type="submit" name="submit" value="ORDER NOW" />
 		<div>
	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>

