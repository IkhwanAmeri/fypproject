<?php

include('db.php');

$del = $_REQUEST['del'];

mysqli_query($con,"delete from users where user_id='$del'")or die(mysqli_error($con));
		
			echo "<script type='text/javascript'>alert('Successfully deleted!');</script>";
					  echo "<script>document.location='user.php'</script>";  
	
		
?>