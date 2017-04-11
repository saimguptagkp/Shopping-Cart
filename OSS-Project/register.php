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
    			<div id="cart_bar">
             <span style="float:right">
              <b style="color:white">Welcome Guest : </b><b style="color:yellow">Shopping Cart - </b><b style="color:white"> Total Items : <?php echo cart();?> Total Price $: <?php getPrice();?> </b><b><a  style="color:yellow;padding-left:10px" href="cart.php"> Go to Cart </a> </b><b><a style="color:orange;padding-right:10px;padding-left:10px" href="">Login</a></b>
             </span>
          </div>
        
          <div id="product_box">
             <form name="register" action="" method="post" enctype="multipart/form-data">
               <table id="registration" width="750" cellpadding="5" cellspacing="5">
                 <tr>
                   <th colspan="3" align="center">Create an Account</th>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Name</td><td><input type="text" name="c_name" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Email</td><td><input type="text" name="c_email" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Password</td><td><input type="password" name="c_password" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Image</td><td><input type="file" name="c_image" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Country</td><td><select name="c_country" required>
                     <option>Select Country</option>
                     <option value="india">India</option>
                     <option value="nepal">Nepal</option>
                     <option value="indonesia">Indonesia</option>
                     <option value="berma">Berma</option>
                     <option value="srilanka">Srilanka</option>
                     <option value="bhutan">Bhutan</option>
                     <option value="Malesiya">Malesiya</option>
                   </select></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer City</td><td><input type="text" name="c_city" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Address</td><td><input type="text" name="c_address" required></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="right">Customer Contact</td><td><input type="text" name="c_contact" required></td>
                 </tr>
                 <tr>
                   <td colspan="3" align="center"><input type="submit" value="Create Account" name="create_account"></td>
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
<?php
  if(isset($_POST['create_account']))
  {
    $c_ip = $_SERVER['REMOTE_ADDR'];
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_password =$_POST['c_password'];
    $c_image = $_FILES['c_image']['name'];
    $c_path = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_address = $_POST['c_address'];
    $c_contact = $_POST['c_contact'];
    $created = date('Y-m-d');

    move_uploaded_file($c_path,'customers/customer_images/'.$c_image);
    $c_query = mysql_query("Insert into customers (customer_ip,customer_name,customer_email,customer_password,customer_image,customer_country,customer_city,customer_address,customer_contact,created) values('$c_ip','$c_name','$c_email','$c_password','$c_image','$c_country','$c_city','$c_address','$c_contact','$created')") or die(mysql_error());
    if($c_query)
    {
      $pro_select = mysql_query("Select *from product_cart where ip_address='$c_ip'") or die(mysql_error());
      $pro_count = mysql_num_rows($pro_select);
      if($pro_count>0)
      {
        $_SESSION['email_id'] = $c_email;
        echo "<script>alert('Customer Registered!')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
        //header('Location:checkout.php');
      }
      else
      {
        $_SESSION['email_id'] = $c_email;
        echo "<script>alert('Customer Registered!')</script>";
        echo "<script>window.open('myaccount.php','_self')</script>";
        //header('Location:myaccount.php');
      }
      
    }
   }   


?>