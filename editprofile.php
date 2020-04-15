<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save_profile']) {
        $updateCustomer = $cs->update_customer($_POST);
    }

    if(Session::get('customer_id')) {
        $customerInfo = $cs->get_customer_info(Session::get('customer_id'));
    } else {
        echo "<script>window.location = 'login.php'</script>";
    }
?>

<style type="text/css">
	.inputs input,.search input.grey{
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

	 input.grey,.search input.grey{
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
	 input.grey:hover,.search input.grey:hover{
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
</style>
 <div class="main">
    <div class="content">
        <form action="" method="POST">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    			<h3>Update Profile</h3>
	    		</div>
    		<div class="clear"></div>
    		<?php 
    				if($customerInfo){
    					while ($result = $customerInfo->fetch_assoc()) {
    			?>
    		<table class="tblone">
                
    				<td>Name</td>
    				<td>:</td>
    				<td><input type="text" name="name" value="<?php echo $result['name']?>" /></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
    				<td><input type="text" name="city" value="<?php echo $result['city']?>" /></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td>:</td>
    				<td><input type="text" name="address" value="<?php echo $result['address']?>" /></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
    				<td><input type="text" name="phone" value="<?php echo $result['phone']?>" /></td>
    			</tr>
    			<tr>
    				<td>Zip code</td>
    				<td>:</td>
    				<td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>" /></td>
    			</tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']?></td>
                </tr>
    		</table>
    		<br>
            <div align="right" class="inputs">
                <?php 
                        if(isset($updateCustomer)) {
                            echo $updateCustomer;
                        }
                    ?>&nbsp;&nbsp;&nbsp;<input class="grey" type="submit" name="save_profile" value="Save"></div>
            <br>
    		<?php 
    				}
    			} else {
                    echo "<script>window.location = 'index.php'</script>";
                }
    			?>
    	</div>
        </form>
 		</div>
	</div>
 	<?php
	include 'inc/footer.php';
?>
