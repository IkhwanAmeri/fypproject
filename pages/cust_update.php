<?php session_start();

include('db.php');
	$id = $_POST['id'];
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$poscode = $_POST['poscode'];
		
		mysqli_query($con,"update customer set cust_name='$name',cust_cont='$contact', address='$address',city='$city', state='$state', poscode='$poscode' where cust_id='$id'")or die(mysqli_error());
			echo "<script type='text/javascript'>alert('Successfully updated customer details!');</script>";
			echo "<script>document.location='customer.php'</script>";  

	
?>
