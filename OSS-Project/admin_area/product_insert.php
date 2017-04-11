<?php
  include('includes/functions/functions.php');
?>
<?php
 $flag=false;
 if(isset($_POST['btnSubmit']))
 {
 	$p_name = $_POST['p_name'];
 	$p_price = $_POST['p_price'];
 	$p_desc = $_POST['p_desc'];
 	$p_keywords = $_POST['p_keywords'];
 	$p_category = $_POST['p_category'];
 	$p_brand = $_POST['p_brand'];
 	$created = date('Y-m-d');
	if(isset($_FILES['p_file']['name']))
	{
      $image_name = $_FILES['p_file']['name'];
      $imagetmppath =$_FILES['p_file']['tmp_name']; 
      $imagepath ='product_images/'.$image_name;
      if(move_uploaded_file($imagetmppath,$imagepath))
      {
      	$insertImageQuery = "Insert into products (product_name,product_cat,product_brand,product_image,product_price,product_keywords,product_desc,created) values('$p_name','$p_category','$p_brand','$image_name','$p_price','$p_keywords','$p_desc','$created')";
        mysql_query($insertImageQuery) or die(mysql_error());
        $flag = true; 
      }    
	}
 }
?>
<link rel="stylesheet" type="text/css" href="style/style.css" media="all">
<form method="post" enctype="multipart/form-data">
	<table align="center" cellspacing="5" cellpadding="5" border="1" bgcolor="pink" width="700">
		<tr>
			<td style="text-align:center;color:black;font-size:28px" colspan="2" align="left"><h1>Product Upload</h1></td>
		</tr>
		<tr>
			<td>Product Name</td>
			<td><input type="text" name="p_name" id="p_name" required/></td>
		</tr>
		<tr>
			<td>Product Price</td>
			<td><input type="text" name="p_price" id="p_price" required/></td>
		</tr>
		<tr>
			<td>Product Desc</td>
			<td><textarea cols="20" rows="10" name="p_desc" required></textarea></td>
		</tr>
		<tr>
			<td>Product Keywords</td>
			<td><input type="text" name="p_keywords" id="p_keywords" required/></td>
		</tr>
		<tr>
			<td>Product Category</td>
			<td><select name="p_category" id="p_category" >
				<option >Select category</option>
				<?php
                   getCat(); 
				?>
			</select></td>
		</tr>
		<tr>
			<td>Product Brand</td>
			<td><select name="p_brand" id="p_brand">
				<option>Select Brand</option>
				<?php getBrand(); ?>
			</select></td>
		</tr>
		<tr>
			<td>Product Image</td>
			<td><input type="file" name="p_file" id="p_file" required/></td>
		</tr>
		<tr>
			<th colspan="2" align="center"><input type="Submit" name="btnSubmit" value="Upload Product" /></th>
		</tr>
		<tr>
		 	<?php
              if($flag==true)
              {
              	echo '<th colspan="2" align="center" style="color:white;background-color:brown">Product Uploaded</th>';
              	$flag=false;
              }
		 	?>
		</tr>
	</table>
</form>