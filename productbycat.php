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
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from <?php 
    			if($catName) {
    				echo $catName->fetch_assoc()['catName'];
    			}
    		?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      		if($prodList) {
	      			while ($result = $prodList->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result['image']?>" alt="no img" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'])?></p>
					 <p><span class="price"><?php echo $result['price']?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
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

 <?php
	include 'inc/footer.php';
?>

