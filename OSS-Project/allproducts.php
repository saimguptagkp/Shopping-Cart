<?php
  include 'functions/functions.php';
?>
<html>
<head>
	<title>Online Shopping</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" media="all">
</head>
  <body>
    <div class="main_wrapper">
    	<div class="header_wrapper">
    		<img id="logo" src="images/logo.png"/>
    		<img id="ad_banner"src="images/ad_banner.png"/>
    	</div>
    	<div class="menubar">
    		<ul id="mainmenu">
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php">All Products</a></li>
              <li><a href="#">MyAccount</a></li>
              <li><a href="#">Sign Up</a></li>
              <li><a href="">Shopping Cart</a></li>
              <li><a href="">Contact Us</a></li>
            </ul>

            <form>
                <input type="text" name="search" placeholder="Search a Product"/>
                <input type="submit" value="Search" name="btnSearch">
            </form>

    	</div>
    	<div class="content_wrapper">
    		<div id="sidebar">
    			<div id="sidebar_title">
                    Categories
                </div>
                <ul id="cats">
                <?php 
                  getCat();
                ?>   
                </ul>
                <div id="sidebar_title">
                   Brands
                </div>
                <ul id="cats">
                <?php 
                  getBrand();
                ?> 
                </ul>
    		</div>
        <?php
            getCount();
        ?>
    		<div id="content_area">
    			<div id="cart_bar">
             <span style="float:right">
              <b style="color:white">Welcome Guest : </b><b style="color:yellow">Shopping Cart - </b><b style="color:white"> Total Items : <?php echo cart();?> Total Price : $ <?php getPrice() ?> </b><b><a  style="color:yellow;padding-left:10px" href="cart.php"> Go to Cart </a> </b><b><a style="color:orange;padding-right:10px;padding-left:10px" href="">Login</a></b>
             </span>
          </div>
          <div id="product_box">
            <?php
              getPro();
            ?>

          </div>
    		</div>
    	</div>
    	<div id="footer">
    		<p>&copy;2016 www.hamdardshopping.com</p>
    	</div>
    </div>
  </body>
</html>