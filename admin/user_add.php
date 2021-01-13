<?php

include('db.php');
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	 
    $query2=mysqli_query($con,"select * from users where username='$username'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Username already exist!');</script>";
			echo "<script>document.location='user.php'</script>";  
		}
    else{
	$pass1=md5($password);
	
		mysqli_query($con,"INSERT INTO users
		(username,password,name) 
		VALUES
		('$username','$pass1','$name')")
		or die(mysqli_error($con));  
			echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
			echo "<script>window.location='user.php'</script>";
		}
?>