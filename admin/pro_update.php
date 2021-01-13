<?php 

include('db.php');
	$id = $_POST['id'];
	$name = $_POST['name'];
	$cont = $_POST['cont'];
	mysqli_query($con,"update users set name='$name', cont='$cont' where user_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated prodile details!');</script>";
	echo "<script>document.location='report.php'</script>";  

	
?>
