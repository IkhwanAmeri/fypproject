<?php include('login.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- fontawesome CSS-->
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="index.css">

    <title>fyp</title>
  </head>
  <body>
    <div class="container h-100 mt-5 mb-5 mx-auto">
	    <div class="row justify-content-center">  
		    <div class="col-md-6 p5 secondcol order-md-1 order-2 text-center d-flex flex-column">
				<form>
					<h1 class="mb-4">Welcome Dropshipper</h1>
					<hr>
					<div class="js tilt" data-tilt>
						<img src="dist/images/login.png" class="img-fluid my-auto mx-auto">
					</div>
					
				</form>
			</div><!--col1-->

		    <div class="col-md-6 p-5 firstcol order-md-2 order-1">
		    	<h3 class="text-center">Login</h3>
			    <form action="index.php" method="post">
			      	<?php include('pages/errors.php'); ?>
				        <div class="form-group form-inline">
				        	<label class="col-md-2"><i class="fas fa-user"></i></label>
				          	<input type="text" class="col-md-10 form-control" placeholder="Enter Your Username" name="username" required>    
				        </div>
						<div class="form-group form-inline">
							<label class="col-md-2"><i class="fas fa-lock"></i></label>
						    <input type="password" class="col-md-10 form-control" placeholder="Enter Your Password" name="password" required>
						</div>
			      		
				    	<button type="submit" class="btn btn-primary btn-block col-md-8 offset-md-2" name="log_btn">Submit</button>
			      
			      	<hr>
			      	<p class="text-center">Havent Join? Register Now! <button type="button" class="btn btn-link" data-toggle="modal" data-target="#register" id="registerbutton">Register</button></p>
			    </form>
			</div><!--col2-->
			
		</div><!--row-->
    </div><!--container-->

    
    <div class="modal fade" id="register" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Register</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post" oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
      				<?php include('pages/errors.php'); ?>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Enter Your Username" name="username" required>          
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Your Name" name="name" required>          
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Enter Your Password" name="password" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Re-enter Your Password" name="password2" required>
                </div>       
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="reg_btn">Submit</button>
              <button type="reset" class="btn btn-danger">Reset</button>
              </form> 
            </div>
          </div>
        </div>
      </div>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/jquery/tilt.jquery.min.js"></script>
    <script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
  </body>
</html>