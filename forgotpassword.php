<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php 
	if(Session::get('customer_login')) {
		// header('Location: profile.php');
		echo "<script> location.replace('profile.php'); </script>";
	}
?>
<?php 
    $cs = new customer();
    if($_SERVER['REQUEST_METHOD']  == 'POST'){
    	if(isset($_POST['submit_email'])){
    		$checkEmail = $cs->check_customer_email($_POST);
    	} 
    }
?>
<style type="text/css">
	span.error {
		color: red;
	}

	span.success {
		color: green;
	}

	.register_account form input[type="password"]{
		width:95%;
	}

	.register_account form input[type="password"] {
		font-size:12px;
		color:black;
		padding:8px;
		outline:none;
		margin:5px 0;
		width:340px;
	}
</style>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3><?=_RESET_PASSWORD?></h3>
        	<p><?=_EMAIL_RESET_PASSWORD?></p>
        	<?php 
        		$userData = [];
        		if(isset($checkEmail)) {
        			if($checkEmail != null && sizeof($checkEmail) > 0) {
        				echo "<span class='success'>"._CHECK_EMAIL_AND_RESET_PASSWORD."</span>";
        				$userData = $checkEmail;
        			} else {
        				echo "<span class='error'>"._EMAIL_NOT_EXIST."</span>";
        			}
        		}
        	?>
        	<form action="" method="POST" id="member">
                	<input name="email" type="text" placeholder="<?=_EMAIL?>" class="field" > <br><br>
                    <input class="register_button" type="submit" name="submit_email" value="<?=_SEND?>" />
        	</form>
       <div class="clear"></div>
    </div>
    <?php
	include 'inc/footer.php';
?>
 </div>
 <?php 
if(isset($userData) && $userData != null && sizeof($userData) > 0) {
	
	$cs->notifyResetPassword($userData[1], $userData[0], $userData[2]);
}
 ?>
}

