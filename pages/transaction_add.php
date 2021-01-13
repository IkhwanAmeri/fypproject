<?php session_start();
$id=$_SESSION['id'];

include('db.php');

	$name = $_POST['product_name'];
	$qty = $_POST['qty'];
			
		$query=mysqli_query($con,"select * from product where product_id='$name'")or die(mysqli_error($con));
		$row=mysqli_fetch_assoc($query);
		$price=$row['product_price'];
		$stock=$row['product_qty'];
		
		$query1=mysqli_query($con,"select * from temp_trans where product_id='$name' and user_id='$id'")or die(mysqli_error());
		$row=mysqli_fetch_assoc($query1);
		$count=mysqli_num_rows($query1);
		$default = null;
		$temp_qty=isset($row['qty']) ? $row['qty'] : $default;
		$total=$price*$qty;

		if ($stock<=0 || $qty>$stock || $temp_qty>=$stock || $qty+$temp_qty>$stock) {
			echo "<script>
			alert('Item Out of Stock!');
			document.location='cust_trans.php'
			</script>";
		}
		else
		{
			if ($count>0){
			mysqli_query($con,"update temp_trans set qty=qty+'$qty',price=price+'$total' where product_id='$name' and user_id='$id'")or die(mysqli_error($con));
			}
			else{
				mysqli_query($con,"INSERT INTO temp_trans(product_id,qty,price,user_id) VALUES('$name','$qty','$total','$id')")or die(mysqli_error($con));
			}
			echo "<script>document.location='cust_trans.php'</script>";
		}
		
		

?>


<!--<?php 
$id=$_SESSION['id'];

include('db.php');

	$cid = $_POST['cid'];
	$name = $_POST['product_name'];
	$qty = $_POST['qty'];
			
		$query=mysqli_query($con,"select * from product where product_id='$name'")or die(mysqli_error($con));
		$row=mysqli_fetch_assoc($query);
		$price=$row['product_price'];
		$stock=$row['product_qty'];
		
		$query1=mysqli_query($con,"select * from temp_trans where product_id='$name' and user_id='$id'")or die(mysqli_error());
		$row=mysqli_fetch_assoc($query1);
		$count=mysqli_num_rows($query1);
		$temp_qty=isset($row['qty']);
		$total=$price*$qty;

		if ($stock<=0 || $qty>$stock || $temp_qty>=$stock) {
			echo "<script>
			alert('Item Out of Stock!');
			document.location='cust_transaction.php?cid=$cid'
			</script>";
		}
		else
		{
			if ($count>0){
			mysqli_query($con,"update temp_trans set qty=qty+'$qty',price=price+'$total' where product_id='$name' and user_id='$id'")or die(mysqli_error($con));
			}
			else{
				mysqli_query($con,"INSERT INTO temp_trans(product_id,qty,price,user_id) VALUES('$name','$qty','$total','$id')")or die(mysqli_error($con));
			}

		echo "<script>document.location='cust_transaction.php?cid=$cid'</script>";
		}
		
		

?>-->