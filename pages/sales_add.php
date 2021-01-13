<?php session_start();
$id=$_SESSION['id'];

include('db.php');

	$total = $_POST['total'];
	
	date_default_timezone_set("Asia/Kuala_Lumpur"); 
	$date = date("Y-m-d H:i:s");

	mysqli_query($con,"INSERT INTO sales(user_id,total,date_added) 
	VALUES('$id','$total','$date')")or die(mysqli_error($con));

	$sales_id=mysqli_insert_id($con);
	$_SESSION['sid']=$sales_id;

	$query=mysqli_query($con,"select * from temp_trans where user_id='$id'")or die(mysqli_error($con));
		while ($row=mysqli_fetch_assoc($query))
		{
			$pid=$row['product_id'];	
 			$qty=$row['qty'];
			$price=$row['price'];
			
			
			mysqli_query($con,"INSERT INTO sales_detail(product_id,qty,price,sales_id) VALUES('$pid','$qty','$price','$sales_id')")or die(mysqli_error($con));
			mysqli_query($con,"UPDATE product SET product_qty=product_qty-'$qty' where product_id='$pid' and user_id='$id'") or die(mysqli_error($con)); 
		}
		
		$result=mysqli_query($con,"DELETE FROM temp_trans where user_id='$id'")	or die(mysqli_error($con));
			echo "<script>document.location='trans.php?cid=$sales_id'</script>";  	
		
	
?>

<!--<?php session_start();
$id=$_SESSION['id'];	

include('db.php');

	$total = $_POST['total'];
	
	date_default_timezone_set("Asia/Kuala_Lumpur"); 
	$date = date("Y-m-d H:i:s");
	$cid=$_REQUEST['cid'];
	$id=$_SESSION['id'];
	
	mysqli_query($con,"INSERT INTO sales(cust_id,user_id,total,date_added) 
	VALUES('$cid','$id','$total','$date')")or die(mysqli_error($con));
		
	$sales_id=mysqli_insert_id($con);
	$query=mysqli_query($con,"select * from temp_trans where user_id='$id'")or die(mysqli_error($con));
		while ($row=mysqli_fetch_assoc($query))
		{
			$pid=$row['product_id'];	
 			$qty=$row['qty'];
			$price=$row['price'];
			
			
			mysqli_query($con,"INSERT INTO sales_detail(product_id,qty,price,sales_id) VALUES('$pid','$qty','$price','$sales_id')")or die(mysqli_error($con));
			mysqli_query($con,"UPDATE product SET product_qty=product_qty-'$qty' where product_id='$pid' and user_id='$id'") or die(mysqli_error($con)); 
		}
		
		$result=mysqli_query($con,"DELETE FROM temp_trans where user_id='$id'")	or die(mysqli_error($con));
			echo "<script>document.location='customer.php?cid=$cid'</script>";  	
		
	
?>-->