<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(Session::get('customer_id')) {
		$customerInfo = $cs->get_customer_info();
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
                <tr>
                    <td><?= _LASTNAME?></td>
                    <td>:</td>
                    <td><?php echo $result['lastname']?></td>
                </tr>
                <tr>
                    <td><?= _FIRSTNAME?></td>
                    <td>:</td>
                    <td><?php echo $result['firstname']?></td>
                </tr>
                <!-- <tr>
                    <td><?= _NAME?></td>
                    <td>:</td>
                    <td><?php echo $result['name']?></td>
                </tr> -->
    			<tr>
    				<td><?= _EMAIL?></td>
    				<td>:</td>
    				<td><?php echo $result['email']?></td>
    			</tr>
    			<tr>
    				<td><?= _ADDRESS?></td>
    				<td>:</td>
    				<td><?php echo $result['address']?></td>
    			</tr>
    			<tr>
    				<td><?= _PHONE?></td>
    				<td>:</td>
    				<td><?php echo $result['phone']?></td>
    			</tr>
    			<!-- <tr>
    				<td><?= _ZIPCODE?></td>
    				<td>:</td>
    				<td><?php echo $result['zipcode']?></td>
    			</tr> -->
    			<tr>
                    <td><?= _GENDER?></td>
                    <td>:</td>
                    <td><?php 
                        switch ($result['gender']) {
                            case '0':
                                echo _MALE;
                                break;
                            case '1':
                                echo _FEMALE;
                                break;
                            case '2':
                                echo _OTHER;
                                break;
                            default:
                                echo _OTHER;
                                break;
                        }
                       ?></td>
                </tr>
                <tr>
    				<td><?= _BIRTHDAY?></td>
    				<td>:</td>
    				<td><?php echo $result['birthday']?></td>
    			</tr>
    		</table>
    		<br>
    		<div align="right" class="atag"><a class="register_button" href="editprofile.php" ><?= _UPDATE?></a></div>
    		<br>
    		<?php 
    				}
    			} else {
    				echo "<script>window.location = 'index.php'</script>";
    			}
    			?>
    	</div>
 		</div>
	</div>
 	<?php
	include 'inc/footer.php';
?>

