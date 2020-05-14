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
<script type="text/javascript">
    
    function validateAllForm() {
        var errMsg = "";
        clearAllErrorMsg();
        if(!validateRequiredFieldsInput()) {
            errMsg += "<?php echo ErrorMessagePVS::CHECK_REQUIRED_FIELDS.'<br>'?>";
        }
        if(!validateConfirmPassword()) {
            errMsg += "<?php echo ErrorMessagePVS::PASSWORD_NOT_MATCHED.'<br>'?>";
        }
        showErrorMsg(errMsg);
        if(errMsg == "") {
            return true;
        } else {
            return false;
        }
    }

    function showErrorMsg(msg) {
        document.getElementById("errorMsg").innerHTML = msg;
    }

    function clearAllErrorMsg() {
        document.getElementById("errorMsg").innerHTML = "";
    }

    function validateConfirmPassword() {
        var new_password = document.getElementsByName("new_password")[0].value;
        var confirm_password = document.getElementsByName("confirm_password")[0].value;
        return ValidateConfirmPassword(new_password, confirm_password);
    }

    function validateRequiredFieldsInput() {
        var current_password = document.getElementsByName("current_password")[0].value;
        var new_password = document.getElementsByName("new_password")[0].value;
        var confirm_password = document.getElementsByName("confirm_password")[0].value;
        if (current_password == "" || new_password == "" || confirm_password == "") {
            return false;
        } else {
            return true;
        }
    }
</script>
<?php 
    $cs = new customer();
    $isShowErrorMsg = false;
    if($_SERVER['REQUEST_METHOD']  == 'POST'){
        if(isset($_POST['submit_new_password'])){
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $update_new_pass = $cs->update_newPasswordFromUser($_GET['id'], $_POST['current_password'], $_POST['new_password']);
            } else {
                $isShowErrorMsg = true;
            }
        } 
    }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3><?=_UPDATE_PASSWORD?></h3>
        	<p><?=_UPDATE_PASSWORD_TEXT_DESC?></p>
            <span class="error" id="errorMsg"></span>
        	<?php 
        		if(isset($update_new_pass)) {
                    if ($update_new_pass) {
                        echo "<span class='success'>"._UPDATE_PASSWORD_SUCCESS."</span><a href='login.php'>"._LOGIN."</a>";
                    } else {
                        echo "<span class='error'>"._UPDATE_PASSWORD_FAILED."</span>";
                    }
        		} else if($isShowErrorMsg){
                    echo "<script>showErrorMsg('"._CLICK_LINK_FROM_EMAL."');</script>";
                }
        	?>
        	<form action="" method="POST" id="member" onsubmit="return validateAllForm();">
                    <input minlength="6" maxlength="20" name="current_password" type="password" placeholder="<?=_CURRENT_PASSWORD?>" class="field" > <br>
                	<input minlength="6" maxlength="20" name="new_password" type="password" placeholder="<?=_NEW_PASSWORD?>" class="field" > <br>
                    <input minlength="6" maxlength="20" name="confirm_password" type="password" placeholder="<?=_CONFIRM_PASSWORD?>" class="field" ><br><br>
                    <div><div><input class="register_button" type="submit" name="submit_new_password" value="<?=_UPDATE?>" /></div></div>
                    </div>
        	</form>
       <div class="clear"></div>
    </div>
    <?php
	include 'inc/footer.php';
?>
 </div>

