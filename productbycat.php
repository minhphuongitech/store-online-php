<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php 
	$prod = new product();
	$fm = new Format();
	$cat = new category();
	if(isset($_GET['catid']) && $_GET['catid'] != NULL) {
		$catId = $_GET['catid'];
		$prodList = $prod->getProductsByCategory($catId);
		$catName = $cat->getCatById($catId);
		
	} else {
		echo "<script>window.location = '404.php'</script>";
	}
?>
<link rel="stylesheet" type="text/css" href="template_pvs/css_pvs/products_list_pvs.css">
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3><?php 
    			if($catName) {
    				$catLang = $_SESSION['lang'];
                                            switch ($catLang) {
                                                case 'japanese':
                                                    echo $catName->fetch_assoc()['catNameJp'];
                                                    break;
                                                case 'english':
                                                    echo $catName->fetch_assoc()['catName'];
                                                    break;
                                                case 'vietnamese':
                                                    echo $catName->fetch_assoc()['catNameVn'];
                                                    break;
                                                default:
                                                    case 'japanese':
                                                    echo $catName->fetch_assoc()['catNameJp'];
                                                    break;
                                            }
    			}
    		?></h3>
    		</div>
    		<div class="clear">
    			
    			<div class="slider-box-row">
	    	<?php 
	      		if($prodList) {
	      			while ($result = $prodList->fetch_assoc()) {
	      	?>
	    	<div class="slider-box-column">
					<!-- <p class="time">New</p> -->
					<div class="img-box">
						<img src="admin/uploads/<?php echo $result['image'] ?>" alt="no image">
					</div>
					<p class="detail"><?php echo $result['productName'] ?>
						<a href="#" class="price"><?php echo Format::formatNumberAsCurrency($result['price']);
					  ?> Yen</a>
					</p>
					<div class="cart">
						<a href="details.php?productid=<?php echo $result['productId'] ?>">Details</a>
					</div>
				</div>
			<?php 
						}
	      		} else {
	      			echo "<br><span style='font-size:20px; color:red;'>All products sold out.</span>";
	      		}
				?>
			</div>
    		</div>

    		</div>
    	</div>
    	<?php
	include 'inc/footer.php';
?>
    </div>

 </div>

 

