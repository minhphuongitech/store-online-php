<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<?php 
	$page = 1;
	if(isset($_GET['page']) && $_GET['page'] != NULL) {
		$page = $_GET['page'];
	}
?>
<style type="text/css">
	.paging a{
		color: #602D8D;
		font-size: 16px;
		font-weight: bold;
	}
</style>
<link rel="stylesheet" type="text/css" href="template_pvs/css_pvs/products_list_pvs.css">

 <div class="main">
    <div class="content" >
    	<div class="content_top" >
    		<div class="heading" >
    		<h3><?= _FEATURE_PRODUCTS?></h3>
    		</div>
    		<div class="clear">
    			<div class="slider-box-row">
	    	<?php 
	      		$featuredProd = $product->show_featured_product();
	      		if($featuredProd) {
	      			while ($featuredProdResult = $featuredProd->fetch_assoc()) {
	      	?>
	    	<div class="slider-box-column">
					<!-- <p class="time">New</p> -->
					<div class="img-box">
						<img src="admin/uploads/<?php echo $featuredProdResult['image'] ?>" alt="no image">
					</div>
					<p class="detail"><?php echo $featuredProdResult['productName'] ?>
						<a href="#" class="price"><?php echo Format::formatNumberAsCurrency($featuredProdResult['price']);
					  ?> Yen</a>
					</p>
					<div class="cart">
						<a href="details.php?productid=<?php echo $featuredProdResult['productId'] ?>"><?= _DETAILS?></a>
					</div>
				</div>
			<?php 
						}
		      		}
				?>
			</div>
    		</div>
    	</div>
	      <!-- <div class="section group">
	      	<?php 
	      		$featuredProd = $product->show_featured_product();
	      		if($featuredProd) {
	      			while ($featuredProdResult = $featuredProd->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $featuredProdResult['productId'] ?>"><img width="150px" height="130px" src="admin/uploads/<?php echo $featuredProdResult['image'] ?>" alt="no image" /></a>
					 <h2><?php echo $featuredProdResult['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($featuredProdResult['product_desc'],100)  ?></p>
					 <p><span class="price"><?php echo Format::formatNumberAsCurrency($featuredProdResult['price']);
					  ?> Yen</span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $featuredProdResult['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php 
						}
		      		}
			?>
			</div> -->
			<div class="content_bottom">
    		<div class="heading">
    		<h3><?= _NEW_PRODUCTS?></h3>
    		</div>
    		<div class="clear">
    			<div class="slider-box-row">
	    	<?php 
		      		$newProd = $product->show_new_product();
		      		if($newProd) {
		      			while ($newProdResult = $newProd->fetch_assoc()) {
		      	?>
	    	<div class="slider-box-column">
					<p class="time">New</p>
					<div class="img-box">
						<img src="admin/uploads/<?php echo $newProdResult['image'] ?>" alt="no image">
					</div>
					<p class="detail"><?php echo $newProdResult['productName'] ?>
						<a href="#" class="price"><?php echo Format::formatNumberAsCurrency($newProdResult['price']) ?> Yen</a>
					</p>
					<div class="cart">
						<a href="details.php?productid=<?php echo $newProdResult['productId'] ?>"><?= _DETAILS?></a>
					</div>
				</div>
			<?php 
						}
		      		}
				?>
			</div>
    		</div>
    	</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3><?= _ALL_PRODUCTS?></h3>
    		</div>
    		<div class="clear">
    			<div class="slider-box-row">
	    	<?php 
	      		$productPaging = $product->show_product_paging($page);
	      		if($productPaging) {
	      			while ($prodPagingResult = $productPaging->fetch_assoc()) {
	      	?>
	    	<div class="slider-box-column">
					<!-- <p class="time">New</p> -->
					<div class="img-box">
						<img src="admin/uploads/<?php echo $prodPagingResult['image'] ?>" alt="no image">
					</div>
					<p class="detail"><?php echo $prodPagingResult['productName'] ?>
						<a href="#" class="price"><?php echo Format::formatNumberAsCurrency($prodPagingResult['price']) ?> Yen</a>
					</p>
					<div class="cart">
						<a href="details.php?productid=<?php echo $prodPagingResult['productId'] ?>"><?= _DETAILS?></a>
					</div>
				</div>
			<?php 
						}
		      		}
				?>
			</div>	
    			

    		</div>
    	</div>
			<div class="paging" style="text-align: center;">
				<?php 
					$allProd = $product->show_all_product();
					$numOfRecords = mysqli_num_rows($allProd);
					$itemsPerPage = ConstantPVS::ITEMS_PER_PAGE;
					$numOfPages = ceil($numOfRecords / $itemsPerPage);
					if ($numOfPages > 1)
						for ($i=1; $i <= $numOfPages; $i++) { 
				?>
				<a href="?page=<?php echo $i?>"> <?php echo $i?></a> <?php if($i != $numOfPages) echo ' | ';?>
				<?php	
					}
				?>
			</div>
    </div>
 <?php
	include 'inc/footer.php';
?>
 </div>

 
 

