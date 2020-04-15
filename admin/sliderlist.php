<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php 
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['sliderid']) && $_GET['sliderid'] != NULL){
		$delResult = $pd->delete_slider($_GET['sliderid']);
	} 

	if($_SERVER['REQUEST_METHOD'] == 'POST'
		 && $_POST['status'] != NULL
		 && $_POST['slider_id'] != NULL){
		$updateResult = $pd->update_slider_status($_POST['slider_id'], $_POST['status']);
	} 
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
        	<?php if(isset($updateResult)) echo $updateResult; ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Slider Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sliderList = $pd->show_slider();
					if($sliderList) {
						$i = 0;
						while ($result = $sliderList->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['sliderName']?></td>
					<td><img alt="no img" src="uploads/<?php echo $result['sliderImage']?>" height="100px" width="200px"/></td>				
					<td>
						<form action="" method="POST">
							<select name="status">
								<option <?php if($result['status'] == 0) echo "selected"; ?> value="0">Deactive</option>
								<option <?php if($result['status'] == 1) echo "selected"; ?> value="1">Active</option>
							</select>
							<input hidden="true" type="text" name="slider_id" value="<?php echo $result['sliderId']?>"/>
							<input type="submit" name="submit_status" value="Update"/>
						</form>
					</td>
				<td>
					<a href="slideredit.php?sliderid=<?php echo $result['sliderId'] ?>">Edit</a> || 
					<a onclick="return confirm('Are you sure to Delete!');" href="?sliderid=<?php echo $result['sliderId']?>">Delete</a> 
				</td>
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
