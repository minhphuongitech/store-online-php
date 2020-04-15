<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php 
	if(Session::get('customer_id') == NULL) {
		echo "<script>window.location = 'login.php'</script>";
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
	    			<h3>Your details ordered</h3>

	    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
		    			<div class="cartpage">
			    	<h2 style="font-size: 22px;">Details</h2>
						<table class="tblone">
							<tr>
								<th style="font-size: 16px" width="5%">No.</th>
								<th style="font-size: 16px" width="25%">Product Name</th>
								<th style="font-size: 16px" width="10%">Image</th>
								<th style="font-size: 16px" width="15%">Price</th>
								<th style="font-size: 16px" width="5%">Quantity</th>
								<th style="font-size: 16px" width="20%">Total Price</th>
								<th style="font-size: 16px" width="10%">Date</th>
								<th style="font-size: 16px" width="10%">Status</th>
							</tr>
							<?php 
								$prodOrder = $ct->getOrder();
								if($prodOrder) {
									$totalPrice = 0;
									$i = 0;
									while ($result = $prodOrder->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['totalPrice']; ?></td>
								<td><?php echo $result['quantity'] ?>
								</td>
								<td><?php echo $result['totalPrice']*$result['quantity'] ?></td>
								<td><?php 
									echo $fm->formatDate($result['orderDate']);
									 ?></td>
								<td><?php 
								$status = $result['status'];
								switch ($status) {
									case '0':
										echo "Pending";
										break;
									case '1':
										echo "Processing";
										break;
									case '2':
										echo "Delivering";
										break;	
									case '3':
										echo "Delivered";
										break;
									case '4':
										echo "Cancel";
										break;
									case '4':
										echo "N/A";
										break;
									
									default:
										echo "N/A";
										break;
								}
								?></td>
							</tr>
							<?php 
									}
								}
							?>
						</table>
					</div>
		    		</div>
 		</div>
	</div>	
 	</div>
 </form>
 	<?php
	include 'inc/footer.php';
?>

