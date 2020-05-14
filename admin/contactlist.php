<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php'; ?>
<?php 
	$cs = new customer();
	if(isset($_GET['delid'])) {
		$contactId = $_GET['delid'];
		$delContact = $cs->delete_contact($contactId);
	}	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Email List</h2>
                <?php 
                	if(isset($delContact)){
                		echo $delContact;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Subject</th>
							<th>Content</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_contact_list = $cs->get_all_contact_us_list();
							if($show_contact_list) {
								$i = 0;
								while ($result = $show_contact_list->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
										<td><?php echo $i ?></td>
										<td><?php echo $result['name']?></td>
										<td><?php echo $result['email']?></td>
										<td><?php echo $result['mobile']?></td>
										<td><?php echo $result['subject']?></td>
										<td><?php echo $result['content']?></td>
										<td><a href="contactedit.php?contactid=<?php echo $result['contactId'] ?>">Edit</a> || <a onclick="return confirm('Do you really want to delete?')" href="?delid=<?php echo $result['contactId'] ?>">Delete</a></td>
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

