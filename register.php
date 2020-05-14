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
<link rel="stylesheet" type="text/css" href="template_pvs/css_pvs/style_pvs.css">
<style type="text/css">
	input.larger{
      width: 17px;
      height: 17px;
      }

    span.error {
		color: red;
	}

	span.success {
		color: green;
	}
</style>
<script type="text/javascript">
	
	function validateAllForm() {
		var errMsg = "";
		clearAllErrorMsg();
		if(!validateRequiredFieldsInput()) {
			errMsg += "<?php echo ErrorMessagePVS::CHECK_REQUIRED_FIELDS.'<br>'?>";
		}
		if(!ValidateEmail(document.getElementsByName("email")[0].value)) {
			errMsg += "<?php echo ErrorMessagePVS::CHECK_EMAIL_FORMAT.'<br>'?>";
		}
		if(!validateConfirmPassword()) {
			errMsg += "<?php echo ErrorMessagePVS::PASSWORD_NOT_MATCHED.'<br>'?>";
		}
		if (!validateBirthday()) {
			errMsg += "<?php echo ErrorMessagePVS::CHECK_BIRTHDAY_18_OR_OLDER.'<br>'?>";
		}
		if(!validateCheckedOnAgree()) {
			errMsg += "<?php echo ErrorMessagePVS::CHECK_ON_AGREE_CHECKBOX.'<br>'?>";
		}
		showErrorMsg(errMsg);
		if(errMsg == "") {
			if(validateCheckedOnAgree()) {
				isShowLoadingIcon(true);
				return true;	//Form Data is all OK
			} else {
				return false;
			}
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
		var pass = document.getElementById("password_id").value;
		var pass_confirm = document.getElementById("confirm_password_id").value;
		return ValidateConfirmPassword(pass, pass_confirm);
	}

	function validateBirthday() {
		var birthday = document.getElementsByName("birthday")[0].value;		
		if(!ValidateDateOfBirthday(birthday)) {	//utilsPVS.js
			return false;
		} else {
			return true;	//Validated OK
		}
	}

	function validateRequiredFieldsInput() {
		var lastname = document.getElementsByName("lastname")[0].value;
		var firstname = document.getElementsByName("firstname")[0].value;
		var email = document.getElementsByName("email")[0].value;
		var password = document.getElementsByName("password")[0].value;
		var confirm_password = document.getElementsByName("confirm_password")[0].value;
		var address = document.getElementsByName("address")[0].value;
		var phone = document.getElementsByName("phone")[0].value;
		var male = document.getElementsByName("gender")[0].checked;
		var female = document.getElementsByName("gender")[1].checked;
		var other = document.getElementsByName("gender")[2].checked;
		var gender = false;
		if(!male && !female && !other) {
			return false;
		} else {
			return true;
		}
		alert('Gender' + gender);
		var birthday = document.getElementsByName("birthday")[0].value;
		if (lastname == "" || firstname == "" || email == "" || password == "" || confirm_password == "" || address == "" || 
			phone == "" || !gender || birthday == "" ) {
			return false;
		} else {
			return true;
		}
	}

	function validateCheckedOnAgree() {
		var agree = document.getElementsByName("agree")[0].checked;
		return agree;
	}

	function isShowLoadingIcon(show) {
		if (show) {
			document.getElementById("loadingIcon").style.display = "block";
		} else {
			document.getElementById("loadingIcon").style.display = "none";
		}
	}
	
</script>
	<div style="display: none;" id="loadingIcon"><?php
					include 'template_pvs/loading.php';
				?></div>
    <div class="">
    	<div class="register_account">
    		<h3><?= _REGISTER_NEW_ACCOUNT?></h3>
    		<span class="error" id="errorMsg"></span>
    		<?php 
    			if(isset($insertCus)) {
    				echo $insertCus;
    				echo '<script>isShowLoadingIcon(false);</script>';
    			}
    		?>
    		<form action="" method="POST" onsubmit="return validateAllForm();">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" style="width: 150px" name="lastname" placeholder="<?= _LASTNAME?>">
							<input type="text"  style="width:186px" name="firstname" placeholder="<?= _FIRSTNAME?>">
							</div>
							<div>
								<input type="text" name="email" placeholder="<?= _EMAIL?>">
							</div>
							<div>
								<input minlength="6" maxlength="20" style="width: 168px" type="password" id="password_id" name="password" placeholder="<?= _PASSWORD?>">
								<input minlength="6" maxlength="20" style="width: 168px" type="password" id="confirm_password_id" name="confirm_password" placeholder="<?= _CONFIRM_PASSWORD?>">
							</div>
							<div>
							<input type="text" name="address" placeholder="<?= _ADDRESS?>">
							</div>
							<div>
							<input type="text" name="phone" placeholder="<?= _PHONE?>">
							</div>

							<div>
								<?= _GENDER ?>　:　
								<input type="radio" name="gender" value="0" id="male">
								<label for="male"><?= _MALE ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="1" id="female">
								<label for="female"><?= _FEMALE ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="3" id="other">
								<label for="other"><?= _OTHER ?></label>
							</div>
							<div>
								<label for="birthday"><?= _BIRTHDAY?>　:　</label>
								<input type="date" name="birthday" value="1990-02-15">
							</div>

							<!-- <div>
							   <input type="text" name="city" placeholder="<?= _CITY?>">
							</div>
							<div>
								<input type="text" name="zipcode" placeholder="<?= _ZIPCODE?>">
							</div> -->
							
							
							
		    		<!-- <div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>	 -->
		    			 </td>
		    			<td>
		    	</td>
		    </tr> 
		    </tbody></table> 
		    <hr>
		    <p><input class="larger" type="checkbox" name="agree"><span style="padding: 10px 0px 10px 10px;"><?=_AGREE_TERMS_CONDITIONS?></span> <a href="#"><?=_VIEW_DETAILS?></a></p>
		   <div><div><input class="register_button" type="submit" name="submit_register" value="<?=_CREATE_ACCOUNT ?>" /></div></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
       <?php
	include 'inc/footer.php';
?>
    </div>


