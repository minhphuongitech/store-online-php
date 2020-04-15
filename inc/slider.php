<?php 
	$prod = new product();
	$fm = new Format();
?>
<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$prodBrand = $prod->getLastest(1);
					if($prodBrand) {
						while ($result = $prodBrand->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['image']?>" alt="no img" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']?></h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50)?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php 
				   		}
					}
				   ?>
			   <?php
					$prodBrand = $prod->getLastest(2);
					if($prodBrand) {
						while ($result = $prodBrand->fetch_assoc()) {
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['image']?>" alt="no img" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2><?php echo $result['brandName']?></h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50)?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php 
				   		}
					}
				   ?>
			</div>
			<div class="section group">
				<?php
					$prodBrand = $prod->getLastest(3);
					if($prodBrand) {
						while ($result = $prodBrand->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['image']?>" alt="no img" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']?></h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50)?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php 
				   		}
					}
				   ?>
			   <?php
					$prodBrand = $prod->getLastest(4);
					if($prodBrand) {
						while ($result = $prodBrand->fetch_assoc()) {
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?productid=<?php echo $result['productId'] ?>"> <img src="admin/uploads/<?php echo $result['image']?>" alt="no img" /></a>
					</div>
					<div class="text list_2_of_1">
						<h2><?php echo $result['brandName']?></h2>
						<p><?php echo $fm->textShorten($result['product_desc'], 50)?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php 
				   		}
					}
				   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
							$activeSlider = $prod->show_actived_slider();
							if($activeSlider) {
								while ($sliderResult = $activeSlider->fetch_assoc()) {
						?>
						<li><img src="admin/uploads/<?php echo $sliderResult['sliderImage'] ?>" alt="no img"/></li>
						<?php 
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	