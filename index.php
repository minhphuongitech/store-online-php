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

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
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
					  ?> đ</span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $featuredProdResult['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php 
						}
		      		}
			?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
	      		$newProd = $product->show_new_product();
	      		if($newProd) {
	      			while ($newProdResult = $newProd->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $newProdResult['productId'] ?>"><img width="150px" height="130px" src="admin/uploads/<?php echo $newProdResult['image'] ?>" alt="no image" /></a>
					 <h2><?php echo $newProdResult['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($newProdResult['product_desc'],100)  ?></p>
					 <p><span class="price"><?php echo Format::formatNumberAsCurrency($newProdResult['price']) ?> đ</span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $newProdResult['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php 
					}
	      		}
			?>
			</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3>All Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
	      		$productPaging = $product->show_product_paging($page);
	      		if($productPaging) {
	      			while ($prodPagingResult = $productPaging->fetch_assoc()) {
	      	?>
				<div id="paging_section" class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $prodPagingResult['productId'] ?>"><img width="150px" height="130px" src="admin/uploads/<?php echo $prodPagingResult['image'] ?>" alt="no image" /></a>
					 <h2><?php echo $prodPagingResult['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($prodPagingResult['product_desc'],100)  ?></p>
					 <p><span class="price"><?php echo Format::formatNumberAsCurrency($prodPagingResult['price']) ?> đ</span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $prodPagingResult['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php 
					}
	      		}
			?>
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
 </div>

 <?php
	include 'inc/footer.php';
?>
 
