<?php session_start();

include('db.php');
	$name = $_POST['product_name'];
	$qty = $_POST['qty'];
	
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$date = date('Y-m-d H:i:s');
	$id=$_SESSION['id'];
	
	$query=mysqli_query($con,"select product_name from product where product_id='$name'")or die(mysqli_error());
  
        $row=mysqli_fetch_assoc($query);
		$product=$row['product_name'];
	
		
		
	mysqli_query($con,"UPDATE product SET product_qty=product_qty+'$qty' where product_id='$name' and user_id='$id'") or die(mysqli_error($con)); 
			
		mysqli_query($con,"INSERT INTO stockin(product_id,s_quantity,date,user_id) VALUES('$name','$qty','$date','$id')")or die(mysqli_error($con));
			echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
			echo "<script>document.location='stockin.php'</script>";  
	
?>