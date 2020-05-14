<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php 
	$cat = new category();
	if(isset($_GET['delid'])) {
		$catId = $_GET['delid'];
		$delCategory = $cat->delete_category($catId);
	}	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 
                	if(isset($delCategory)){
                		echo $delCategory;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>English Name</th>
							<th>Japanese Name</th>
							<th>Vietnamese Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_cate = $cat->show_category();
							if($show_cate) {
								$i = 0;
								while ($result = $show_cate->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
										<td><?php echo $i ?></td>
										<td><?php echo $result['catName']?></td>
										<td><?php echo $result['catNameJp']?></td>
										<td><?php echo $result['catNameVn']?></td>
										<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Edit</a> || <a onclick="return confirm('Do you really want to delete?')" href="?delid=<?php echo $result['catId'] ?>">Delete</a></td>
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

