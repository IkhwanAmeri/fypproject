<?php include('login.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <title>fyp</title>
    <style type="text/css">
    	.html,body{
		background-size: cover;
		background-repeat: no-repeat;
		background-color: rgb(76,190,225);
		}
		.container-fluid {
		  width: auto;
		  margin-top: 9%;
		  box-shadow: 0 3px 20px rgba(0,0,00.3);
		  padding: 30px;
		  background-color: rgb(255,255,255);
		}

		button {
		  width: 48%;
		}
		#registerbutton {
		  width: auto;
		  margin-bottom: 2%;
		}
    </style>
  </head>
  <body>
    <div class="container-fluid col-md-4">
    <h4 class="text-center">Welcome Admin</h4>  
    <hr>  
      <form action="index.php" method="post">
      	<?php include('errors.php'); ?>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Enter Your Username" name="username" required>          
        </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" placeholder="Enter Your Password" name="password" required>
      </div>
      
      <button type="submit" class="btn btn-primary" name="log_btn">Submit</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      <hr>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>