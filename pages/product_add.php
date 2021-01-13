<?php session_start();
$id=$_SESSION['id'];

include('db.php');

	$name = $_POST['product_name'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$desc = $_POST['description'];
	$supplier = $_POST['supplier'];

	$query2=mysqli_query($con,"select * from product where product_name='$name' and user_id='$id'")or die(mysqli_error($con));
			$count=mysqli_num_rows($query2);

			if ($count>0)
			{
				echo "<script type='text/javascript'>alert('Product already exist!');</script>";
				echo "<script>document.location='product.php'</script>";  
			}
			else
			{
				$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
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
				mysqli_query($con,"INSERT INTO product(product_name,product_price,product_qty,description,supplier,prod_pic,user_id)
				VALUES('$name','$price','$quantity','$desc','$supplier','$pic','$id')")or die(mysqli_error($con));

				echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
						  echo "<script>document.location='product.php'</script>";  
			}
		
?>