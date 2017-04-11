<?php
  include 'includes/connect.php';

  /*function to get category list*/ 
 
  function getCat()
  {
       $queryCatSelect='Select *from category';
       $resultCatSelect = mysql_query($queryCatSelect) or die(mysql_error());
       while($catRow = mysql_fetch_array($resultCatSelect))
        {
           $c_id = $catRow['cat_id'];
           $c_name = $catRow['cat_name'];
           echo '<li><a href="'."index.php".'?c_id='.$c_id.'">'.$c_name.'</a></li>'; 
        } 
  }

  /*function to get brand list*/ 

  function getBrand()
  {
  	 $queryCatSelect='Select *from brand';
     $resultCatSelect = mysql_query($queryCatSelect) or die(mysql_error());
     while($catRow = mysql_fetch_array($resultCatSelect))
      {
        $b_id = $catRow['brand_id'];
        $b_name = $catRow['brand_name'];
        echo '<li><a href="'."index.php".'?b_id='.$b_id.'">'.$b_name.'</a></li>'; 
      } 
  }

  function getPro()
  {
              if(isset($_GET['search']))
                {
                      $searchkey = '%'.$_GET['search'].'%'; 

                      $selectProducts = "Select *from products where product_name like '$searchkey' OR product_price like '$searchkey' OR product_desc like '$searchkey' OR product_keywords like '$searchkey'";
                }  
              else if(isset($_GET['c_id']))
               {
                    $cid=$_GET['c_id'];
                    $selectProducts = "Select *from products where product_cat='$cid'"; 
               }
               else if(isset($_GET['b_id']))
               {
                    $bid=$_GET['b_id'];
                    $selectProducts = "Select *from products where product_brand='$bid'";
               }
               else if(isset($_GET['p_id']))
               {
                    $pid=$_GET['p_id'];
                    $selectProducts = "Select *from products where product_id='$pid'";
               }
               else if($_SERVER['PHP_SELF']=='/oss-project/allproducts.php')
               {
                    $selectProducts = "Select *from products order by RAND()";
               }      
               else
               {
                    $selectProducts = "Select *from products order by RAND() LIMIT 0,6";
               }
               
               
               $productResult = mysql_query($selectProducts) or die(mysql_error());
               if(isset($_GET['p_id']))
               { 
                  $productRow = mysql_fetch_array($productResult);
                  $product_id = $productRow['product_id'];
                  $product_name = $productRow['product_name'];
                  $product_price = $productRow['product_price'];
                  $product_image = $productRow['product_image'];
                  $product_desc = $productRow['product_desc'];
                  $imagepath = 'admin_area/product_images/'.$product_image;
                  $pagepath = $_SERVER['PHP_SELF'];
                  $pagepath = $pagepath."?p_id=".$product_id;
                  echo '<div id="product_detail">
                        <p style="font-size:18px;font-weight:bold">'.$product_name.'</p>
                   <img src="'.$imagepath.'" height="400" width="400" border="2"/>
                        <p style="font-size:16px;font-weight:bold;margin-top:5px;"> Price : $'.$product_price.'</p>
                 <p style="font-size:16px;font-weight:bold;margin-top:5px;">'.$product_desc.'</p>
                        <a href="index.php" style="float:left;font-weight:bold">Back</a>
                       <a href="index.php?cartp_id='.$product_id.'"><button name="add_to_cart" style="float:right;font-weight:bold;padding:5px;">Add to Cart</button></a>
                  </div>';  
               }
               else
               {
                while($productRow = mysql_fetch_array($productResult))
                {
                  $product_id = $productRow['product_id'];
                  $product_name = $productRow['product_name'];
                  $product_price = $productRow['product_price'];
                  $product_image = $productRow['product_image'];
                  $imagepath = 'admin_area/product_images/'.$product_image;
                  $pagepath = $_SERVER['PHP_SELF'];
                  $pagepath = $pagepath."?p_id=".$product_id;
                  echo '<div id="single_product">
                        <p style="font-size:18px;font-weight:bold">'.$product_name.'</p>
                        <img src="'.$imagepath.'" height="200" width="200" border="2"/>
                        <p style="font-size:16px;font-weight:bold;margin-top:5px;"> Price : $'.$product_price.'</p>
                        <a href="'.$pagepath.'" style="float:left;font-weight:bold">Details</a>
                        <a href="index.php?cartp_id='.$product_id.'"><button name="add_to_cart" style="float:right;font-weight:bold;padding:5px;">Add to Cart</button></a>
                  </div>';
                 
                }
               }
              
  }

 /* function getCount()
  {
    echo $_GET['add_to_cart'];
    $ip = $_SERVER['REMOTE_ADDR'];
    if(isset($_GET['cartp_id']) AND isset($_GET['add_to_cart']))
    {
       
       $product_id = $_GET['cartp_id']; 
       $check_pro = "Select *from product_cart where product_id='$product_id' AND ip_address = '$ip'";
       $pro_count_result = mysql_query($check_pro) or die(mysql_error());
       $pro_count = mysql_num_rows($pro_count_result);
       if($pro_count>0)
       {}
       else
       {
          $created = date('Y-m-d');
          mysql_query("Insert into product_cart (ip_address , product_id,created) values('$ip','$product_id','$created')") or die(mysql_error());
          $cartCountResult = mysql_query("Select *from product_cart where ip_address='$ip'");
          $count = mysql_num_rows($cartCountResult);
         echo $count;
       }
     
    }
    else
    {
       $pro_select = "Select *from product_cart where ip_address = '$ip'";  
       $pro_count = mysql_query($pro_select) or die(mysql_error());    
       $count = mysql_num_rows($pro_count);
       if($count>0)
       {
         echo $count;
       }
      

    }

   
  }*/

function cart()
{
 if(isset($_GET['cartp_id']))
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    $check_pro = "Select *from product_cart where ip_address = '$ip'";
    $pro_count_result = mysql_query($check_pro) or die(mysql_error());
    $pro_count = mysql_num_rows($pro_count_result);
  }
  else
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    $check_pro = "Select *from product_cart where ip_address = '$ip'";
    $pro_count_result = mysql_query($check_pro) or die(mysql_error());
    $pro_count = mysql_num_rows($pro_count_result);
  }
  echo $pro_count;
}
function getCount()
{
      if(isset($_GET['cartp_id']))
      { 
       $ip = $_SERVER['REMOTE_ADDR']; 
       $product_id = $_GET['cartp_id']; 
       $check_pro = "Select *from product_cart where product_id='$product_id' && ip_address = '$ip'";
       $pro_count_result = mysql_query($check_pro) or die(mysql_error());
       $pro_count = mysql_num_rows($pro_count_result);
       if($pro_count>0)
       {}
       else
       {
          $created = date('Y-m-d');
          mysql_query("Insert into product_cart (ip_address , product_id,created) values('$ip','$product_id','$created')") or die(mysql_error());
          $cartCountResult = mysql_query("Select *from product_cart where ip_address='$ip'");
          $count = mysql_num_rows($cartCountResult);
          header('Location:index.php'); 
       }
      } 
}


  function getPrice()
  {
    $total = 0;
    $ip = $_SERVER['REMOTE_ADDR'];
    $all_products = mysql_query("Select *from product_cart where ip_address = '$ip'") or die(mysql_error());
    while($single_product = mysql_fetch_array($all_products))
    {
      $pro_id = $single_product['product_id']; 
      $all_price = mysql_query("Select *from products where product_id='$pro_id'") or die(mysql_error());
      $price_row = mysql_fetch_array($all_price);
      $price = $price_row['product_price'];
      $qty_result = mysql_query("Select *from product_cart where ip_address='$ip' AND product_id='$pro_id'") or die(mysql_error());
      $qty_row = mysql_fetch_array($qty_result);
      $qty=$qty_row['product_quantity'];
      if($qty>0)
         $price = $qty*$price;
      $total=$total+$price;
    }
    echo $total; 
  }
 function updateCart()
          {
             
            if(isset($_POST['update_cart']))
             {

              $ip=$_SERVER['REMOTE_ADDR'];
              if(isset($_POST['remove']))
               {
                foreach($_POST['remove'] as $p_remove)
                {
                  
                  mysql_query("Delete from product_cart where ip_address='$ip' AND product_id = '$p_remove'") or die(mysql_error());
                } 
               }
             }
            
           
          }
 /*         function updateCart()
          {
             
            if(isset($_POST['update_cart']))
             {

              $ip=$_SERVER['REMOTE_ADDR'];
              if(isset($_POST['remove']))
               {
                foreach($_POST['remove'] as $p_remove)
                {
                  
                  mysql_query("Delete from product_cart where ip_address='$ip' AND product_id = '$p_remove'") or die(mysql_error());
                } 
               }
             }
            
           
          }*/

?>