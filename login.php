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
    	if(isset($_POST['submit_register'])){
    		$insertCus = $cs->insert_customer($_POST);
    	} elseif (isset($_POST['submit_login'])) {
    		$loginAcc = $cs->check_customer($_POST);
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
        	<h3><?=_LOGIN?></h3>
        	<p><?=_SIGN_IN_TEXT_DESC?></p>
        	<?php 
        		if(isset($loginAcc)) {
        			echo $loginAcc;
        		}
        	?>
        	<form action="" method="POST" id="member">
                	<input name="email" type="text" placeholder="<?=_EMAIL?>" class="field" > <br>
                    <input name="password" type="password" placeholder="<?=_PASSWORD?>" class="field" >
                 <br><a href="register.php"><?= _CREATE_ACCOUNT?>?</a>
                 <p class="note"><a href="forgotpassword.php"><?= _CLICK_HERE?></a><?= _IF_YOU_FORGOT_YOUR_PASSWORD?></p>
                    <div><div><input class="register_button" type="submit" name="submit_login" value="<?=_LOGIN?>" /></div></div>
                    </div>
        	</form>
       <div class="clear"></div>
    </div>
    <?php
	include 'inc/footer.php';
?>
 </div>

