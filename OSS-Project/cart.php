<?php
  include 'functions/functions.php';
  session_start();
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
              <li><a href="allproducts.php">All Products</a></li>
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
        <?php getCount();?>
    		<div id="content_area">
    			<?php
             updateCart();
          ?>
          <div id="product_box">
          <form method="post" enctype="multipart/form-data">
           <table width="750" align="center" bgcolor="skyblue">
             <tr align="center">
               <th>Remove</th>
               <th>Product(S)</th>
               <th>Qty</th>
               <th>Price</th>
             </tr>
             <?php
              $i=0;
              $total = 0;
              $value=0;
              $ip = $_SERVER['REMOTE_ADDR'];
              $all_products = mysql_query("Select *from product_cart where ip_address = '$ip'") or die(mysql_error());
             
              while($single_product = mysql_fetch_array($all_products))
                {
                
                 $pro_id = $single_product['product_id']; 
                 $all_price = mysql_query("Select *from products where product_id='$pro_id'") or die(mysql_error());
                 $price_row = mysql_fetch_array($all_price);
                 $price = $price_row['product_price'];
                 $pro_image = $price_row['product_image'];
                 $pro_title = $price_row['product_name'];
                ?>
                  <?php
               
                 if(isset($_POST['qty']))
                 {
                    $q=$_POST['qty'][$i++]; 
                    if($q!="")
                    {
                       $value =$value+$price*$q;
                     
                       mysql_query("Update product_cart set product_quantity='$q' where product_id='$pro_id'") or die(mysql_error());
                    }
                  }  
                ?>
             <tr align="center">
               <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id?>"></td>
               <td><?php echo $pro_title;?><br/><img src="<?php echo 'admin_area/product_images/'.$pro_image?>" width="60" height="60"/></td>
                 <?php
                 $qty_result =mysql_query( "Select *from product_cart where ip_address='$ip' AND product_id='$pro_id'") or die(mysql_error());
                 $qty_row = mysql_fetch_array($qty_result);
                 $p_qty = $qty_row['product_quantity'];
                 if($p_qty==0)
                  $p_qty="";
               ?>
               <td><input type="text" size="10" name="qty[]" value="<?php echo $p_qty;?>"></td>
                
                <?php
                   if(!isset($_POST['qty']))
                   {
                      if($p_qty!="")
                         $value =$value+$price*$p_qty;
                      else 
                         $value =$value+$price;   
                   } 

                ?>
              
               <td><?php echo '$ '.$price; ?></td>
             </tr>

            <?php
            }
             $total = $total+$value;
             $_SESSION['total_price']=$total;

            ?> 
            <tr>
              <th colspan="4" align="right" style="padding:10px;">
                <?php echo 'Total Price  $ '.$_SESSION['total_price'];?>
              </th>
            </tr>
            <tr align="center">
              <td></td>
              <td><input type="submit" name="update_cart" value="Update Cart" /></td>
              <td><button><a href="index.php" style="text-decoration:none;color:black">Continue Shopping</a></button></td>
              <td><button><a href="checkout.php" style="text-decoration:none;color:black">Checkout</a></button></td>
            </tr>
           </table>
          </form>
          </div>
    		</div>
    	</div>
    	<div id="footer">
    		<p>&copy;2016 www.hamdardshopping.com</p>
    	</div>
    </div>
  </body>
</html>

