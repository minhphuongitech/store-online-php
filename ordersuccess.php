<?php
	include 'inc/header.php';
?>

 <style type="text/css">

	span.error {
		color: red;
	}

	span.success {
		color: green;
		font-size: 20px;
	}

 </style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    			<h3>Payment status</h3>
	    		</div>

    		<div class="clear"></div>
 		</div>
 		<br>
 		<?php 
 			$prodOrder = $ct->getOrder();
 			if($prodOrder) {
 				$grandTotalPrice = 0;
 				while ($result = $prodOrder->fetch_assoc()) {
 					$grandTotalPrice += $result['totalPrice'];
 				}
 				$grandTotalPrice += $grandTotalPrice * 0.08; // VAT 8%
 			}
 		?>
 		<span class="success">Your payment was completed.</span><br>
 		<br>
 		<span>Total price you've bought : <?php if(isset($grandTotalPrice)) echo $grandTotalPrice; else echo '0';?></span><br>
 		<span><a href="orderdetails.php">We'll contact you soon. Click here</a> to view order details.</span>

	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>