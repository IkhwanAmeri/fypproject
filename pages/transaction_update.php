<?php session_start();

include('db.php');
	$id = $_POST['id'];
	$qty =$_POST['qty'];
	$cid =$_POST['cid'];
	
	
	mysqli_query($con,"update temp_trans set qty='$qty' where temp_trans_id='$id'")or die(mysqli_error());
	
	echo "<script>document.location='cust_transaction.php?cid=$cid'</script>";  

	
?>
