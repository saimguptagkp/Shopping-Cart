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
           echo '<option value="'.$c_id.'">'.$c_name.'</option>'; 
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
        echo '<option value="'.$b_id.'">'.$b_name.'</option>'; 
      } 
  }
?>