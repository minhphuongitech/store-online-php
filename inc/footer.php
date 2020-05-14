</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
					<h4><?= _INFORMATION?></h4>
						<ul>
						<li><a href="contact.php"><?= _CONTACT_US?></a></li>
						<li><a href="#"><?= _FAQ?></a></li>	
						<li><a href="#"><?= _ABOUT_US?></a></li>
						<li><a href="#"><?= _CUSTOMER_SERVICE?></a></li>
						<li><a href="#"><?= _PRIVACY_POLICY?></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4><?= _MY_ACCOUNT?></h4>
						<ul>
							<li><a href="login.php"><?= _SIGN_IN?></a></li>
							<li><a href="register.php"><?= _CREATE_ACCOUNT?></a></li>
							<li><a href="cart.php"><?= _CART?></a></li>
							<li><a href="wishlist.php"><?= _WISHLIST?></a></li>
							<li><a href="orderdetails.php"><?= _ORDERED?></a></li>
							
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4><?= _CONTACT?></h4>
						<ul style="color: white">
							<li>❖ <?= _JAPAN?>:　 +81(0) 70-4511-1934</li>
							<li>❖ <?= _VIETNAM?>: +84(0) 93-8687-071</li>
						</ul>
						<div class="social-icons">
							<h4><?= _FOLLOW_US?></h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p style="color: white">© 2020 PvSoft &amp; All rights Reserved</p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>