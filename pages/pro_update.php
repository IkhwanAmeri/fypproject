<?php session_start();

include('db.php');
	$id = $_POST['id'];
	$username = $_POST['username'];
	$name = $_POST['name'];
	$cont = $_POST['cont'];
	$password = $_POST['password'];

	
	
	$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{	
					$pic=$_POST['image1'];
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/images/".$pic);
				      }
					}
			
			}

			if ($password=="") {
				$pass = $_POST['pass'];
			}
			else{
				$pass = md5($password);
			}
			

		mysqli_query($con,"update users set username='$username', name='$name', password='$pass', cont='$cont', pro_pic='$pic' where user_id='$id'")or die(mysqli_error($con));
		echo "<script type='text/javascript'>alert('Successfully updated prodile details!');</script>";
		echo "<script>document.location='profile.php'</script>";  

	?>