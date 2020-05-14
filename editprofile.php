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

    a.register_button {
        text-decoration: none;
        color: white;
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
	    			<h3><?= _PROFILE?></h3>
	    		</div>
    		<div class="clear"></div>
    		<?php 
    				if($customerInfo){
    					while ($result = $customerInfo->fetch_assoc()) {
    			?>
    		<table class="tblone">
               <!--  <tr>
    				<td><?= _NAME?></td>
    				<td>:</td>
    				<td><input type="text" name="name" value="<?php echo $result['name']?>" /></td>
    			</tr>
    			<tr>
    				<td><?= _CITY?></td>
    				<td>:</td>
    				<td><input type="text" name="city" value="<?php echo $result['city']?>" /></td>
    			</tr> -->
    			<tr>
    				<td><?= _ADDRESS?></td>
    				<td>:</td>
    				<td><input type="text" name="address" value="<?php echo $result['address']?>" /></td>
    			</tr>
    			<tr>
    				<td><?= _PHONE?></td>
    				<td>:</td>
    				<td><input type="tel" name="phone" value="<?php echo $result['phone']?>" /></td>
    			</tr>
                <tr>
                    <td><?= _BIRTHDAY?></td>
                    <td>:</td>
                    <td><input type="date" name="birthday" value="<?php echo $result['birthday']?>" /></td>
                </tr>
    			<!-- <tr>
    				<td><?= _ZIPCODE?></td>
    				<td>:</td>
    				<td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>" /></td>
    			</tr>
                <tr>
                    <td><?= _EMAIL?></td>
                    <td>:</td>
                    <td><?php echo $result['email']?></td>
                </tr> -->
    		</table>
    		<br>
            <div align="right" class="inputs">
                <?php 
                        if(isset($updateCustomer)) {
                            echo $updateCustomer;
                        }
                    ?>&nbsp;&nbsp;&nbsp;<input class="register_button" type="submit" name="save_profile" value="<?= _SAVE?>"></div>
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

