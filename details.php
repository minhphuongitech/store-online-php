<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
 <?php 
 	$prod = new product();
 	$fm = new Format();
 	$cat = new category();
 	if(!isset($_GET['productid']) || $_GET['productid'] == NULL) {
 		echo "<script>window.location = '404.php'</script>";
 	} else {
 		$prodId = $_GET['productid'];
 	}

 	if($_SERVER['REQUEST_METHOD'] == 'POST') {
 		if(isset($_POST['submit'])) {
 			$quantity = $_POST['quantity'];
 			$addCart = $ct->add_cart($prodId, $quantity);
 		} else if(isset($_POST['submit_compare'])) {
 			$addProductCompare = $prod->addProductCompare($_GET['productid']); 
 		} else if(isset($_POST['submit_wishlist'])) {
 			$addWishlist = $prod->addWishlist($_GET['productid']); 
 		}
 	}
 ?>
 <style type="text/css">
 	span {
		font-size: 18px;
	}

 	span.error {
		color: red;
	}

	span.success {
		color: green;
	}
 </style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<!-- <?php 
    		if(isset($addCart)) {
    			echo $addCart;
    		}	
    	?> -->
    	<div class="section group">
    		<?php 
    			$prodDetails = $prod->getProductById($prodId);
    			if($prodDetails) {
    				while ($prodResult = $prodDetails->fetch_assoc()) {
    			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img  src="admin/uploads/<?php echo $prodResult['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $prodResult['productName']?></h2>
					<p><?php echo $fm->textShorten($prodResult['product_desc'], 200);?></p>					
					<div class="price">
						<p>Price: <span><?php echo Format::formatNumberAsCurrency($prodResult['price'])?> đ</span></p>
						<p>Category: <span><?php echo $prodResult['catName']?></span></p>
						<p>Brand:<span><?php echo $prodResult['brandName']?></span></p>
					</div>
				<div class="add-cart">
					
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/><br>
						<?php 
							if(isset($addCart)) {
								echo "<span style='color:red; font-weight:200'>".$addCart."</span>";
							}
						?>
								
				</div>
				<div class="add-cart">
					<?php if(Session::get('customer_id') != NULL) echo "<input type='submit' name='submit_wishlist' class='buysubmit' value='Save to Wishlist'>"?>
					<?php if(Session::get('customer_id') != NULL) echo "<input type='submit' name='submit_compare' class='buysubmit' value='Compare Product'>"?>
					<br><br><?php if(isset($addProductCompare)) echo $addProductCompare; ?>
					<?php if(isset($addWishlist)) echo $addWishlist; ?>					
				</div>

			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $prodResult['product_desc'] ?></p>
	    </div>
	    <div class="product-desc">
			<div class="row">
				<div class="col-md-12">
					<h5>Product comments</h5>
					<p class="col-md-4"><input type="text" class="form-control" name="commentatorName" placeholder="Your name..."></p>
					<p class="col-md-4"><input type="text" class="form-control" name="email" placeholder="Your email..."></p>
					<p><textarea rows="5" style="resize: none" placeholder="Comment..." class="form-control" name="content"></textarea></p>
					<p><input type="button" name="" value="Send comment" class="btn btn-success"></p>
				</div>
			</div>
			
	    </div>
	    <?php 
	    		}
    		} else {
    			echo "<script>window.location = '404.php'</script>";
    		}
	    ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php 
							$categoryList = $cat->show_category_site();
							if($categoryList) {
								while ($result = $categoryList->fetch_assoc()) {
						?>
						<li><a href="productbycat.php?catid=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a></li>
						<?php
								}
							}
						?>
				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
 </form>	
 	<?php
	include 'inc/footer.php';
?>

