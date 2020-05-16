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
 	a.register_button {
        text-decoration: none;
        color: white;
    }
 	.content_top {
 		height: 430px
 	}
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
	    			<h3><?=_OFFLINE_PAYMENT_METHOD?></h3>

	    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
		    			<div class="cartpage">
			    	<h2 style="font-size: 22px;"><?= _CART?></h2>
						<table class="tblone">
							<tr>
								<th style="font-size: 16px" width="5%"><?= _NO?></th>
								<th style="font-size: 16px" width="35%"><?= _PRODUCT_NAME?></th>
								<!-- <th style="font-size: 16px" width="10%"><?= _IMAGE?></th> -->
								<th style="font-size: 16px" width="20%"><?= _PRICE?></th>
								<th style="font-size: 16px" width="5%"><?= _QUANTITY?></th>
								<th style="font-size: 16px" width="25%"><?= _TOTAL_PRICE?></th>
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
								<!-- <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td> -->
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
		    				<td><?= _NAME?></td>
		    				<td>:</td>
		    				<td><?php echo $result['name']?></td>
		    			</tr>
		    			<!-- <tr>
		    				<td><?= _CITY?></td>
		    				<td>:</td>
		    				<td><?php echo $result['city']?></td>
		    			</tr> -->
		    			<tr>
		    				<td><?= _ADDRESS?></td>
		    				<td>:</td>
		    				<td><?php echo $result['address']?></td>
		    			</tr>
		    			<tr>
		    				<td><?= _PHONE?></td>
		    				<td>:</td>
		    				<td><?php echo $result['phone']?></td>
		    			</tr>
		    			<!-- <tr>
		    				<td><?= _ZIPCODE?></td>
		    				<td>:</td>
		    				<td><?php echo $result['zipcode']?></td>
		    			</tr> -->
		    			<tr>
		    				<td><?= _EMAIL?></td>
		    				<td>:</td>
		    				<td><?php echo $result['email']?></td>
		    			</tr>
		    		</table>
		    		<br>
		    		<div align="right" class="atag" style="margin-right: 10px;"><a class="register_button" href="editprofile.php"><?= _UPDATE?></a></div>
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
 			<input class="submit_order" type="submit" name="submit" value="<?=_ORDER_NOW?>" />
 		<div>
	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>

