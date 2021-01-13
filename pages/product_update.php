<?php session_start();

include('db.php');

	$id = $_POST['id'];
	$name = $_POST['product_name'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$desc = $_POST['description'];
	$supplier = $_POST['supplier'];

	$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{	
				if ($_POST['image1']<>""){
					$pic=$_POST['image1'];
				}
				else
					$pic="default.gif";
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/images/".$pic);
				      }
					}
			
			}
	mysqli_query($con,"update product set product_name='$name', product_price='$price', product_qty='$quantity', description='$desc', supplier='$supplier', prod_pic='$pic' where product_id='$id'")or die(mysqli_error($con));
		echo "<script type='text/javascript'>alert('Successfully update!');</script>";
		echo "<script>document.location='product.php'</script>";  
		
?>