<?php

include('db.php');
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	
	if($password==""){
		mysqli_query($con,"UPDATE users SET username='$username', name = '$name' where user_id='$id'")or die(mysqli_error($con));
	}
	else{
	$pass1=md5($password);
		mysqli_query($con,"update users set username='$username',name='$name', password='$pass1' where user_id='$id'")or die(mysqli_error());
			
		}
		echo "<script type='text/javascript'>alert('Update Successfully!');</script>";
			echo "<script>window.location='user.php'</script>";
?>