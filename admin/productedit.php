<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?> 
<?php include '../classes/product.php';?>
<?php 
    $pd = new product();

    if(!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $productId = $_GET['productid'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $pd->update_product($_POST,$_FILES,$productId);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">  
        <?php if(isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php 
                $productDetails = $pd->getProductById($productId);
                if($productDetails == true) {
                    while ($prodResult = $productDetails->fetch_assoc()) {
               ?>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input value="<?php echo $prodResult['productName'] ?>" type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>--Select Category--</option>
                            <?php 
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                
                            ?>
                            <option <?php if($prodResult['catId'] == $result['catId']) echo 'selected' ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                            <?php 

                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>--Select Brand--</option>
                            <?php 
                                $brand = new brand();
                                $brandList = $brand->show_brand();
                                if($brandList) {
                                    while ($result = $brandList->fetch_assoc()) {
                            ?>
                            <option <?php if($prodResult['brandId'] == $result['brandId']) echo 'selected' ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $prodResult['product_desc']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input value="<?php echo $prodResult['price']?>" type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width="60px" height="50px" src="uploads/<?php echo $prodResult['image']?>"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>--Select Type--</option>
                            <option <?php 
                                if($prodResult['type'] == 1) {
                                    echo "selected";
                                }
                            ?> value="1">Featured</option>
                            <option <?php 
                                if($prodResult['type'] == 2) {
                                    echo "selected";
                                }
                            ?> value="2">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
                <?php 

                    }
                }
                ?>
            </table>
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


