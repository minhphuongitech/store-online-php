<?php
	include 'inc/header.php';
?>

 <style type="text/css">

 	.content_top {
 		height: 200px;
 	}

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
	    			<h3><?=_PAYMENT_STATUS ?></h3>
	    		</div>

    		<div class="clear">
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
 		<br>
 		<span class="success"><?=_YOUR_PAYMENT_WAS_COMPLETED?></span><br>
 		<br>
 		<span>❖　<?=_THE_TOTAL_PRICE_YOU_HAVE_BOUGHT?> <?php if(isset($grandTotalPrice)) echo $grandTotalPrice; else echo '0';?></span><br>
 		<span>❖　<a href="orderdetails.php"><?=_CLICK_HERE?></a> <?=_TO_VIEW_MORE_DETAILS?></span>
    		</div>
 		</div>
 		<br>
 		

	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>