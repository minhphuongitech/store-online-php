<?php
	include 'inc/header.php';
?>
<?php 
    $cs = new customer();
    if($_SERVER['REQUEST_METHOD']  == 'POST'){
    	if(isset($_POST['submit_message'])){
    		$insertContactUsMsg = $cs->insert_contact_us_info($_POST);
    	} 
    }
?>
<style type="text/css">
	span.error {
		color: red;
	}

	span.success {
		color: green;
	}
</style>
<div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3><?= _LIVE_SUPPORT?></h3>
  				<p><span><?= _LIVE_SUPPORT_DESC?></span></p>
  				<?php $allContactUsInfo = $cs->get_all_contact_us_list_by_customer(); 
  						?>
  				<form style="display: <?php if (empty($allContactUsInfo)) {
  					echo "none;";
  				}?>" action="" method="POST">
  					<hr>
			    	<h2 style="font-size: 22px;"><?= _SENT_LIST?></h2>
						<table class="tblone">
							<tr>
								<th style="font-size: 16px" width="5%"><?= _NO?></th>
								<th style="font-size: 16px" width="20%"><?= _SUBJECT?></th>
								<th style="font-size: 16px" width="50%"><?= _CONTENT?></th>
								<th style="font-size: 16px" width="15%"><?= _SENT_DATE?></th>
								<th style="font-size: 16px" width="10%"><?= _STATUS?></th>
							</tr>
							<?php 
								
								if($allContactUsInfo) {
									$i = 0;
									while ($result = $allContactUsInfo->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['subject'] ?></td>
								<td><?php echo $result['content']; ?></td>
								<td><?php 
									echo $fm->formatDate($result['sentDate']);
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
 					</form>
  				<hr>
				  <div class="contact-form-pvs">
				  	
				  	<?php 
				  		if(isset($insertContactUsMsg) && !empty($insertContactUsMsg)){
				  			echo $insertContactUsMsg;
				  		}
				  	?>
					    <form method="POST" action="">
					    	<h2><?= _CONTACT_US?></h2><br>
					    	<div>
						    	<span><label><?= _NAME?></label></span>
						    	<span><input type="text" value="" name="name"></span>
						    </div>
						    <div>
						    	<span><label><?= _EMAIL?></label></span>
						    	<span><input type="text" value="" name="email"></span>
						    </div>
						    <div>
						     	<span><label><?= _PHONE?></label></span>
						    	<span><input type="text" value="" name="mobile"></span>
						    </div>
						    <div>
						    	<span><label><?= _SUBJECT?></label></span>
						    	<span><input type="text" value="" name="subject"></span>
						    </div>
						    <div>
						    	<span><label><?= _CONTENT?></label></span>
						    	<span><textarea name="content"> </textarea></span>
						    </div>
						    <br>
						    <div>
						    	<span><label></label></span>
						    	<span><input name="submit_message" class="register_button" style="width: 100px;" type="submit" value="<?= _SEND?>"></span>
						    </div>
					    </form>
				  </div>
				  <div class="company_address">
				  	<br>
					     	<h2>PvSoft co., Ltd</h2>
					     	<br>
							    	<p><?= _FULL_ADDRESS?></p>
					   		<p>❖ <?= _JAPAN?>:+81(0) 70 4511 1934</p>
					   		<p>❖ <?= _VIETNAM?>:+84(0) 93 868 7071</p>
					 	 	<p>❖ <?= _EMAIL?>: <span>pvsoft90@gmail.com</span></p>
					   		<p>❖ <?= _FOLLOW_US?>: <span>Facebook</span>, <span>Twitter</span></p>
				  </div>
  				</div>  	
    <div class="clear"></div>
    </div>
<?php
	include 'inc/footer.php';
?>
 </div>
