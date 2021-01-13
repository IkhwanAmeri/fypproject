<?php session_start();

include('db.php');

	$del = $_POST['del'];

	mysqli_query($con,"delete from product where product_id='$del'")or die(mysqli_error($con));
		echo "<script type='text/javascript'>alert('Successfully deleted!');</script>";
		echo "<script>document.location='product.php'</script>";  
		
?>