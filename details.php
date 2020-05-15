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

	input[type="button"].register_button{
		width: 150px;
		height: 50px;
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
						<!-- <img  src="admin/uploads/<?php echo $prodResult['image']?>" alt="" /> -->
						<?php $myImage = base64_encode($prodResult['convertedImage']);?>
						<img src="data:image/jpeg;base64,<?php echo $myImage?>" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $prodResult['productName']?></h2>
					<p><?php echo $fm->textShorten($prodResult['product_desc'], 200);?></p>					
					<div class="price">
						<p><?= _PRICE?>: <span><?php echo Format::formatNumberAsCurrency($prodResult['price'])?> Yen</span></p>
						<p><?= _CATEGORY?>: <span><?php echo $prodResult['catName']?></span></p>
						<p><?= _BRAND?>:<span><?php echo $prodResult['brandName']?></span></p>
					</div>
				<div class="add-cart">
					
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="register_button" name="submit" value="<?= _ADD_TO_CART?>"/><br>
						<?php 
							if(isset($addCart)) {
								echo "<span style='color:red; font-weight:200'>".$addCart."</span>";
							}
						?>
								
				</div>
				<div class="add-cart">
					<?php if(Session::get('customer_id') != NULL) echo "<input type='submit' name='submit_wishlist' class='register_button' value='"._SAVE_TO_WISHLIST."'>"?>
					<?php if(Session::get('customer_id') != NULL) echo "<input type='submit' name='submit_compare' class='register_button' value='"._COMPARE_PRODUCT."'>"?>
					<br><br><?php if(isset($addProductCompare)) echo $addProductCompare; ?>
					<?php if(isset($addWishlist)) echo $addWishlist; ?>					
				</div>

			</div>
			<div class="product-desc">
			<h2><?= _PRODUCT_DETAILS?></h2>
			<p><?php echo $prodResult['product_desc'] ?></p>
	    </div>
	    <div class="product-desc">
			<div class="row">
				<div class="col-md-12">
					<h5><?= _PRODUCT_COMMENTS?></h5>
					<p class="col-md-4"><input type="text" class="form-control" name="commentatorName" placeholder="<?= _NAME?>..."></p>
					<p class="col-md-4"><input type="text" class="form-control" name="email" placeholder="<?= _EMAIL?>..."></p>
					<p><textarea rows="5" style="resize: none" placeholder="<?= _COMMENT?>..." class="form-control" name="content"></textarea></p>
					<p>
						<input class="register_button" type="button" name="" value="<?= _SEND?>" class="btn btn-success"></p>
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
					<h2><?= _CATEGORY?></h2>
					<ul>
						<?php 
							$categoryList = $cat->show_category_site();
							if($categoryList) {
								while ($result = $categoryList->fetch_assoc()) {
									$myValue = '';
									$lang = $_SESSION['lang'];
									switch ($lang) {
										case 'english':
											$myValue = $result['catName'];
											break;
										case 'japanese':
											$myValue = $result['catNameJp'];
											break;
										case 'vietnamese':
											$myValue = $result['catNameVn'];
											break;
										default:
											$myValue = $result['catNameJp'];
											break;
									}
						?>
						<li><a href="productbycat.php?catid=<?php echo $result['catId'] ?>"><?php echo $myValue?></a></li>
						<?php
								}
							}
						?>
				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 	<?php
	include 'inc/footer.php';
?>
 </div>
 </form>	
 	

