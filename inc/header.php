<?php 
    include 'lib/session.php';
    Session::init();
?>

    <?php 
	define('_LANGUAGES', serialize(array("japanese","english","vietnamese")));

	include_once 'lib/database.php';
	include_once 'helpers/format.php';
	include_once 'helpers/constantPVS.php';
    include_once 'helpers/errorMessagePVS.php';

	spl_autoload_register(function($className){
		include_once  'classes/'.$className.'.php';
	});

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cat = new category();
	$product = new product();
	$cs = new customer();
?>

        <?php
	if(isset($_GET['lang']) && !empty($_GET['lang'])) {
		$_SESSION['lang'] = $_GET['lang'];
		if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {
			echo "<script type='text/javascript'>location.reload();</script>;";
		}
	}

    $page_include = '';
	if (isset($_SESSION['lang'])) {
		$my_langs = unserialize(_LANGUAGES);
		$my_key = array_search($_SESSION['lang'], $my_langs);
		if ($my_key != NULL) {    // If found out language that defined
			$page_include = 'languages/lang_'.$_SESSION['lang'].'.php'; 
		} else {
            $_SESSION['lang'] = "japanese";
            $page_include = 'languages/lang_japanese.php'; // default language
        }
	} else {
        $_SESSION['lang'] = "japanese";
        $page_include = 'languages/lang_japanese.php'; // default language
    }
	include $page_include;

	// echo "<script>alert('".$_SESSION['lang']."');</script>";
?>

            <?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

                <!DOCTYPE HTML>

                <head>
                    <title><?= _WEBSITE_TITLE?></title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
                    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
                    <link href="css/menu_pvs.css" rel="stylesheet" type="text/css" media="all" />
                    <script src="js/jquerymain.js"></script>
                    <script src="js/script.js" type="text/javascript"></script>
                    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
                    <script type="text/javascript" src="js/nav.js"></script>
                    <script type="text/javascript" src="js/move-top.js"></script>
                    <script type="text/javascript" src="js/easing.js"></script>
                    <script type="text/javascript" src="js/nav-hover.js"></script>
                    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
                    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                    <link rel="stylesheet" type="text/css" href="template_pvs/css_pvs/menu_pvs.css">
                    <link rel="stylesheet" type="text/css" href="template_pvs/css_pvs/style_pvs.css">
                    <script type="text/javascript" src="js/utilsPVS.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function($) {
                            $('#dc_mega-menu-orange').dcMegaMenu({
                                rowItems: '4',
                                speed: 'fast',
                                effect: 'fade'
                            });
                        });

                        function changeLanguage() {
                            document.getElementById('form_language').submit();
                        }
                    </script>
                </head>

                <body>
                    <div class="wrap_pvs">
                        <div class="header_top_pvs">
                            <div class="logo_pvs">
                                <a href="index.php"><img src="template_pvs/images/logo.png" alt="" width="100px" height="100px" /></a>
                            </div>
                            <div class="header_top_right_pvs">
                                <div class="search_box_pvs">
                                    <form action="search.php" method="GET">
                                        <input type="text" name="keyword" placeholder="<?= _SEARCH_PRODUCTS?>">
                                        <input type="submit" value="<?= _SEARCH?>">
                                    </form>
                                </div>
                                <div class="cart_box_pvs">
                                    <img width="33px" height="33px" src="images/header_cart.png">
                                    <a href="cart.php">
                                        <span><?= _CART?></span>
                                        <span>
                                            
                                    <?php
                                        $check_cart = $ct->check_cart();
                                        if ($check_cart) {
                                            $subTotalSession = Session::get("sub_total");
                                            if($subTotalSession == NULL || $subTotalSession == 0) {
                                                $subTotal = 0;
                                                while ($result = $check_cart->fetch_assoc()) {
                                                    $subTotal += $result['price'];
                                                }
                                                $subTotalSession = $subTotal;
                                            }
                                            echo $subTotalSession;
                                        } else {
                                            echo "("._EMPTY.")"; 
                                        }
                                    ?>
                                        </span>
                                    </a>
                                </div>
                                <div class='login_pvs'>
                                    <?php 
			    	if(Session::get('customer_login')) {
			    		echo "<a href='?customer_id=".Session::get('customer_id')."'>"._LOGOUT."</a>";	
			    	}else {
			    		echo "<a href='login.php'>"._LOGIN."</a>";	
			    	}

			    	if(isset($_GET['customer_id']) && $_GET['customer_id'] != NULL) {
			    		$deleteResult = $ct->deleteAllCartBySessionId();
			    		Session::destroy();
			    	} ?>
                                </div>
                                <form method="GET" action="" id="form_language">
                                    <div class="change_language">
                                        <select name="lang" onchange="changeLanguage();">
                                            <option <?php if (isset($_SESSION[ 'lang']) && $_SESSION[ 'lang']=='japanese' ) { echo "selected"; } ?> value="japanese">JP</option>
                                            <option <?php if (isset($_SESSION[ 'lang']) && $_SESSION[ 'lang']=='english' ) { echo "selected"; } ?> value="english">EN</option>
                                            <option <?php if (isset($_SESSION[ 'lang']) && $_SESSION[ 'lang']=='vietnamese' ) { echo "selected"; } ?> value="vietnamese">VN</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="menu_container">
                            <ul>
                                <li>
                                    <a href="index.php">
                                        <?= _HOME?>
                                    </a>
                                </li>
                                <li><a><?= _CATEGORY?></a>
                                    <ul>
                                        <?php 
                                            $categoryList = $cat->show_category_site();
                                            if($categoryList) {
                                                while ($result = $categoryList->pg_fetch_assoc()) {
                                        ?>
                                        <li><a style="padding-left: 10px" href="productbycat.php?catid=<?php echo $result['catId'] ?>">
                                            <?php 
                                            $catLang = $_SESSION['lang'];
                                            switch ($catLang) {
                                                case 'japanese':
                                                    echo $result['catNameJp'];
                                                    break;
                                                case 'english':
                                                    echo $result['catName'];
                                                    break;
                                                case 'vietnamese':
                                                    echo $result['catNameVn'];
                                                    break;
                                                default:
                                                    case 'japanese':
                                                    echo $result['catNameJp'];
                                                    break;
                                            }
                                            ?>
                                            </a></li>
                                        <?php
                                                }
                                            }
                                        ?>
                                      
                                    </ul>
                                </li>
                                <?php 
		  	$checkOrdered = $ct->check_ordered();
			if($checkOrdered) {
				echo "<li><a href='orderdetails.php'>"._ORDERED."</a></li>";	
			}
			?>
                                    <li>
                                        <a href="cart.php">
                                            <?= _CART?>
                                        </a>
                                    </li>
                                    <?php 
			if(Session::get('customer_login')) {
				echo "<li><a href='profile.php'>"._PROFILE."</a></li>";	
			}
			?>
                                        <?php 
				if(Session::get('customer_login')) {
					echo "<li><a href='compare.php'>"._COMPARE."</a> </li>";	
				}
				?>
                                            <?php 
				if(Session::get('customer_login')) {
					echo "<li><a href='wishlist.php'>"._WISHLIST."</a> </li>";	
				}
				?>
                                                <li>
                                                    <a href="contact.php">
                                                        <?= _CONTACT?>
                                                    </a>
                                                </li>
                            </ul>
                        </div>