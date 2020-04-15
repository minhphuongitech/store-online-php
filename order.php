<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php 
	if(!Session::get('customer_login')) {
		header('Location: login.php');
	}
?>
<style type="text/css">
	.order_page h3{
		font-size: 20px;
		font-weight: 10px;
	}
</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<div class="order_page">
			    	<h3>Order page.</h3>
    			</div> 	   	
    		</div>  	
    	</div>
       <div class="clear"></div>
    </div>
 </div>

  <?php
	include 'inc/footer.php';
?>

