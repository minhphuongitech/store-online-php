<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'; ?>
<?php 
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        //back to brandlist when no have cart id passed
        echo "<script>window.location = 'brandlist.php'</script>";
    } else {
        $id = $_GET['brandid'];
    }
    $brand = new brand();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->update_brand($id, $brandName);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateBrand)) {
                        //show message after insert data
                        echo $updateBrand;
                    }
                ?>
                <?php 
                    $get_brand_name = $brand->getBrandById($id);
                    if($get_brand_name) {
                        while ($result = $get_brand_name->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Sửa thương hiệu..." class="medium" value="<?php echo $result['brandName'] ?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php 
                         }
                            }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>