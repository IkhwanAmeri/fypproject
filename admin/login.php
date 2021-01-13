<?php session_start();
$errors = array();

include('db.php');

if(isset($_POST['log_btn']))
{

$user_unsafe=$_POST['username'];
$pass_unsafe=$_POST['password'];

$user = mysqli_real_escape_string($con,$user_unsafe);
$pass1 = mysqli_real_escape_string($con,$pass_unsafe);
$pass=md5($pass1);

$query=mysqli_query($con,"select * from users where username='$user' and password='$pass' and status='admin'")or die(mysqli_error($con));
		$row=mysqli_fetch_array($query);
          
           $counter=mysqli_num_rows($query);

    if ($counter == 1) {
      $_SESSION['id'] = $row['user_id'];
      header('location: report.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
	

?>