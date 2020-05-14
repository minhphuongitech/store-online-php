<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php 
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        //back to catlist when no have cart id passed
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $id = $_GET['catid'];
    }
    $cat = new category();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $catNameJp = $_POST['catNameJp'];
        $catNameVn = $_POST['catNameVn'];
        $updateCat = $cat->update_category($id, $catName, $catNameJp, $catNameVn);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateCat)) {
                        //show message after insert data
                        echo $updateCat;
                    }
                ?>
                <?php 
                    $get_cate_name = $cat->getCatById($id);
                    if($get_cate_name) {
                        while ($result = $get_cate_name->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="English Name" class="medium" value="<?php echo $result['catName'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catNameJp" placeholder="Japanese Name" class="medium" value="<?php echo $result['catNameJp'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catNameVn" placeholder="Vietnamese Name" class="medium" value="<?php echo $result['catNameVn'] ?>" />
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