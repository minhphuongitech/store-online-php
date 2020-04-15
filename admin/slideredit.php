<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php 
    $prod = new product();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_slider'])) {
        $sliderInsert = $prod->update_slider($_POST, $_FILES, $_GET['sliderid']);
    }

    if(isset($_GET['sliderid']) && $_GET['sliderid'] != NULL) {
        $showSlider = $prod->show_slider_by_id($_GET['sliderid']);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Slider</h2>
    <div class="block">               
         <form action="" method="POST" enctype="multipart/form-data">
            <?php if(isset($sliderInsert)) echo $sliderInsert;?>
            <?php 
                if($showSlider) {
                    while ($result = $showSlider->fetch_assoc()) {
            ?>
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $result['sliderName'] ?>" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width="200px" height="100px" src="uploads/<?php echo $result['sliderImage'] ?>"/>
                        <input type="file" name="image"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Status</label>
                    </td>
                    <td>
                        <select name="status">
                            <option <?php if($result['status'] == 0) echo "selected" ?> value="0">Deactive</option>
                            <option <?php if($result['status'] == 1) echo "selected" ?> value="1">Active</option>
                        </select>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit_slider" Value="Save" />
                    </td>
                </tr>
            </table>
            <?php     
                    }
                }
            ?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>