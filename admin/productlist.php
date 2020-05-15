<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php 
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid']) && $_GET['productid'] != NULL){
		$delResult = $pd->delete_product($_GET['productid']);
	} 
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php 
        	if(isset($delResult))
        		echo $delResult;
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$productList = $pd->show_product();
					if($productList) {
						while ($result = $productList->fetch_assoc()) {
				?>
				<tr class="odd gradeX">
					<td><?php echo $result['productId']?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['price']?></td>
					<td>
						<!-- <img alt="no img" width="50px" height="60px" src="uploads/<?php echo $result['image']?>"> -->
						<?php $myImage = base64_encode($result['convertedImage']);?>
						<img alt="no img" width="50px" height="60px" src="data:image/jpeg;base64,<?php echo $myImage?>" />
					</td>
					<td><?php echo $result['catName']?></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php 
						echo $fm->textshorten($result['product_desc'], 100);?></td>
					<td class="center"><?php echo $result['type']?></td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Do you really want to delete?')" href="?productid=<?php echo $result['productId']?>">Delete</a></td>
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
</script>
<?php include 'inc/footer.php';?>
