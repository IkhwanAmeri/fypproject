<?php session_start();
include('db.php');
	
	$id=$_SESSION['id'];
	$cid=$_REQUEST['cid'];
	$rcid=$_POST['rcid'];
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$poscode = $_POST['poscode'];

	$query2=mysqli_query($con,"select * from customer where cust_id='$rcid' and user_id='$id'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			mysqli_query($con,"update customer set cust_name='$name', cust_cont='$contact', address='$address', city='$city', state='$state', poscode='$poscode' where cust_id='$rcid' and user_id='$id'")or die(mysqli_error($con));
			mysqli_query($con, "update sales set cust_id='$rcid' where sales_id='$cid' and user_id='$id'")or die(mysqli_error($con));
		}
		else
		{	
			mysqli_query($con,"INSERT INTO customer(cust_name,cust_cont,address,city,state,poscode,user_id) 
				VALUES('$name','$contact','$address','$city','$state','$poscode','$id')")or die(mysqli_error($con));
			$custid=mysqli_insert_id($con);
			mysqli_query($con, "update sales set cust_id='$custid' where sales_id='$cid' and user_id='$id'")or die(mysqli_error($con));
		}
			mysqli_query($con,"delete from sales where sales_id='$cid'+1")or die(mysqli_error($con));
			mysqli_query($con,"alter table sales AUTO_INCREMENT = 1")or die(mysqli_error($con));
			echo "<script>document.location='product.php'</script>"; 
		
?>


<!--<?php session_start();

include('db.php');
	
	$id=$_SESSION['id'];
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$poscode = $_POST['poscode'];
	
	$query2=mysqli_query($con,"select * from customer where cust_name='$name' and user_id='$id'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Customer already exist!');</script>";
			echo "<script>document.location='transaction.php'</script>";  
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO customer(cust_name,cust_cont,address,city,state,poscode,user_id) 
				VALUES('$name','$contact','$address','$city','$state','$poscode','$id')")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			echo "<script>document.location='cust_transaction.php?cid=$id'</script>";  
		}
?>-->