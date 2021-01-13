<?php
  session_start();
  $username = "";
  $user_id = "";
  $errors = array();

  //connect to database
  include('pages/db.php');

  //register
  if (isset($_POST['reg_btn'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password2 = mysqli_real_escape_string($con, $_POST['password2']);

    //check if username exist or not
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user >= 1) { 
    // if user exists
      array_push($errors, "Username already exists");
    } 

    //register if no error
    if (count($errors) == 0) {
      $password = md5($password);
      $sql = "INSERT INTO users (username, name, password)
        VALUES('$username', '$name', '$password')";

      mysqli_query($con, $sql)or die(mysqli_error($con));
      echo "<script type='text/javascript'>alert('Successfully Register! Please Relogin to Enter');</script>";
		echo "<script>document.location='index.php'</script>";
    }
  }

  //login user
  if (isset($_POST['log_btn'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


    if (count($errors) == 0) {
    $password = md5($password);
    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'")or die(mysqli_error($con));
    $row=mysqli_fetch_assoc($query);
    $counter=mysqli_num_rows($query);


    if ($counter == 1) {
      $_SESSION['id'] = $row['user_id'];
      header('location: pages/dashboard.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }

  }

?>