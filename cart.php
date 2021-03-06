<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<style type="text/css">
	.success {
		color: green;
	}
	.error {
		color: red;
	}
</style>
<?php 
	$ct = new cart();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		if(isset($_POST['cartId']) && $_POST['cartId'] != null 
			&& isset($_POST['quantity']) && $_POST['quantity'] != null) {
			$cartId = $_POST['cartId'];
			$quantity = $_POST['quantity'];
			$updatedResult = $ct->update_cart($cartId, $quantity);
		} else {
			echo "<script>window.location = '404.php'</script>";
		}
	}

	if(isset($_GET['delid']) && $_GET['delid'] != null) {
		$delId = $_GET['delid'];
		$delResult = $ct->delete_cart($delId);
	}
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2><?= _YOUR_CART?></h2>
			    	<?php 
			    		if(isset($updatedResult)) {
			    			echo $updatedResult;
			    		}
			    		if(isset($delResult)) {
			    			echo $delResult;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="20%"><?= _PRODUCT_NAME?></th>
								<!-- <th width="10%"><?= _IMAGE?></th> -->
								<th width="15%"><?= _PRICE?></th>
								<th width="25%"><?= _QUANTITY?></th>
								<th width="20%"><?= _TOTAL_PRICE?></th>
								<th width="10%"><?= _ACTION?></th>
							</tr>
							<?php 
								$ct = new cart();
								$cartList = $ct->get_product_cart();
								if($cartList) {
									$totalPrice = 0;
									$grandTotalPrice = 0;
									while ($result = $cartList->fetch_assoc()) {
							?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<!-- <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td> -->
								<td><?php echo Format::formatNumberAsCurrency($result['price']).' Yen'; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
										<input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="1"/>
										<input type="submit" name="submit" value="<?= _UPDATE?>"/>
									</form>
								</td>
								<td><?php 
									$quantityPrice = $result['price']*$result['quantity'];
									$grandTotalPrice+=$quantityPrice;
									echo Format::formatNumberAsCurrency($quantityPrice).' Yen' ?></td>
								<td><a onclick="return confirm('Do you really want to remove?')" href="?delid=<?php echo $result['cartId'] ?>"><?= _REMOVE?></a> || <a href="details.php?productid=<?php echo $result['productId'] ?>"> <?=_VIEW?> </a></td>
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
								<th><?= _SUB_TOTAL?> : </th>
								<td><?php 
									if(isset($grandTotalPrice)) { 
										echo Format::formatNumberAsCurrency($grandTotalPrice).' Yen'; 
										Session::set('sub_total', $grandTotalPrice);
									}
									?></td>
							</tr>
							<tr>
								<th>VAT(8%) : </th>
								<td><?php
									if(isset($grandTotalPrice)) {
										$vat = $grandTotalPrice*0.08;
										echo Format::formatNumberAsCurrency($vat).' Yen' ;
									}?></td>
							</tr>
							<tr>
								<th><?= _GRAND_TOTAL?> :</th>
								<td><?php 
									if(isset($totalPrice)) {
										echo Format::formatNumberAsCurrency($grandTotalPrice+$vat).' Yen';
									}
									 ?> </td>
							</tr>
					   </table>
					   <?php 
					   	} else {
					   		echo "<span class='error'>Your cart is empty.</span>";
					   	}
					   ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
      <?php
			include 'inc/footer.php';
		?>
 </div>



