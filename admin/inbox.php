<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
?>
<?php 
	$ct = new cart();
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$updateOrder = $ct->update_order($_POST);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                	if (isset($updateOrder)) {
                		echo $updateOrder;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$ct = new cart();
							$allOrder = $ct->getAllOrder();
							$i = 0;
							if ($allOrder) {
								while ($result = $allOrder->fetch_assoc()) {
									$i++;
						?>
						
						<tr class="odd gradeX">
							<form id="myForm" name="myForm" method="POST">
							<td><?php echo $i ?></td>
							<td><?php echo $result['orderDate']; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['totalPrice']; ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customerId']; ?>">View</a> </td>
							<td><?php 
								$status = $result['status'];
							 ?>
								<select id="status_id" name="status" onchange="changeStatus()">
								  <option <?php if($status == 0) echo "selected";?> value="0">Pending</option>
								  <option <?php if($status == 1) echo "selected";?> value="1">Processing</option>
								  <option <?php if($status == 2) echo "selected";?> value="2">Delivering</option>
								  <option <?php if($status == 3) echo "selected";?> value="3">Delivered</option>
								  <option <?php if($status == 4) echo "selected";?> value="4">Cancel</option>
								  <option <?php if($status == 5) echo "selected";?> value="5">N/A</option>
								</select>
								<input type="submit" id="submit" name="submit" value="Update"/>
								<input hidden="true" type="text" name="orderid" value="<?php echo $result['id']; ?>" />
							 </td>
							<td><a href="">Edit</a> || <a href="">Delete</a></td>
							</form>
						</tr>
						
						<?php 
							}
						}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });

    function changeStatus() {
    	document.forms['myForm'].submit();
    	// document.getElementById("submit").submit();
    }
</script>
<?php include 'inc/footer.php';?>
