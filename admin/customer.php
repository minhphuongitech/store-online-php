<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php 
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
        echo "<script>window.location = 'index.php'</script>";
    } else {
        $id = $_GET['customerid'];
    }
    $cs = new customer();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin khách hàng</h2>
               <div class="block copyblock">
                <?php 
                    $getCustomerInfo = $cs->getCustomerById($id);
                    if($getCustomerInfo) {
                        while ($result = $getCustomerInfo->fetch_assoc()) {
                ?>
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['name'] ?>" />
                            </td>
                        </tr>
                        <tr>
                             <td>Phone</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['phone'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['city'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['country'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['address'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['zipcode'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input readonly="true" type="text" name="name" class="medium" value="<?php echo $result['email'] ?>" />
                            </td>
                        </tr>
						
                    </table>
                    <?php 
                         }
                            }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>