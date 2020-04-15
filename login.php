<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php 
	if(Session::get('customer_login')) {
		header('Location: profile.php');
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
	.inputs input,.search input.grey{
	    padding:10px 15px;
	    font-size:15px;
	    font-weight:bold;
	    color             : #fff;
	    -webkit-box-shadow: 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        -moz-box-shadow   : 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        box-shadow        : 0 1px rgba(255,255,255,0.2) inset, 0 2px 2px -1px rgba(0,0,0,0.3);
        -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;  
        cursor:pointer;   
	}

	 input.grey,.search input.grey{
		 	border            : 1px solid #303030;
	        background        : #3f4040;
	        background        : -moz-linear-gradient(top,  #3f4040 0%, #303131 100%);
	        background        : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3f4040), color-stop(100%,#303131));
	        background        : -webkit-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : -o-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : -ms-linear-gradient(top,  #3f4040 0%,#303131 100%);
	        background        : linear-gradient(top,  #3f4040 0%,#303131 100%);
	        filter            : progid:DXImageTransform.Microsoft.gradient( startColorstr='#3f4040', endColorstr='#303131',GradientType=0 );
	        text-shadow       : 0 1px 0 rgba(0, 0, 0, 0.4);
	}
	 input.grey:hover,.search input.grey:hover{
		        border            : 1px solid #303030;
	        background        : #525252;
	        background        : -moz-linear-gradient(top,  #525252 0%, #454646 100%);
	        background        : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#525252), color-stop(100%,#454646));
	        background        : -webkit-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : -o-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : -ms-linear-gradient(top,  #525252 0%,#454646 100%);
	        background        : linear-gradient(top,  #525252 0%,#454646 100%);
	        filter            : progid:DXImageTransform.Microsoft.gradient( startColorstr='#525252', endColorstr='#454646',GradientType=0 );
	        text-shadow       : 0 1px 0 rgba(0, 0, 0, 0.4);  
	}

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
        	<h3>Login Account</h3>
        	<p>Sign in with the form below.</p>
        	<?php 
        		if(isset($loginAcc)) {
        			echo $loginAcc;
        		}
        	?>
        	<form action="" method="POST" id="member">
                	<input name="email" type="text" placeholder="Email" class="field" >
                    <input name="password" type="password" placeholder="Password" class="field" >
                 
                 <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                    <div class="inputs"><div><input type="submit" name="submit_login" class="grey" value="Sign In" /></div></div>
                    </div>
        	</form>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if(isset($insertCus)) {
    				echo $insertCus;
    			}
    		?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Name...">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter City...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter Zip code...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Email...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Address...">
						</div>
		    		<div>
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
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Phone...">
		          </div>
				  
				  <div>
					<input type="password" class="field" name="password" placeholder="Enter Password...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit_register" class="grey" value="Create Account" /></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>

