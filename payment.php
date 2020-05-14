<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<style type="text/css">
	.atag a,.search a.grey{
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

	 a.grey,.search a.grey{
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
	 a.grey:hover,.search a.grey:hover{
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

    .wrapper_method {
        
        border: 1px solid;
        border-color: black;
        width: 50%;
        height: 75px;
    }

    .container_wrapper {
        
    }

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    			<h3>Choose your payment method</h3>
	    		</div>
    		<div class="clear"></div>
    		<br>
            <div class="container_wrapper" align="center">
                <div class="wrapper_method" align="center">
                    <br>
                    <div class="atag">
                        <a class="grey" href="offlinepayment.php"><?= _OFFLINE_PAYMENT?></a> 
                        <a class="grey" href="onlinepayment.php"><?= _ONLINE_PAYMENT?></a>
                    </div> 
                </div>
                <br>
                <div class="atag">
                        <a class="grey" href="offpay.php"><?= _PREVIOUS?></a> 
                    </div> 
            </div>
        	</div>
 		</div>
	</div>
 	<?php
	include 'inc/footer.php';
?>

