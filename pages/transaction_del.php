<?php

include("db.php");
	$id = $_REQUEST['id'];
	$result=mysqli_query($con,"DELETE FROM temp_trans WHERE temp_trans_id ='$id'")or die(mysqli_error());
		
	echo "<script>document.location='cust_trans.php'</script>";  
?>