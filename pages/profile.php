<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- DataTable CSS-->
    <link rel="stylesheet" type="text/css" href="../plugins/DataTables/datatables.min.css"/>

    <!-- fontawesome CSS-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <link rel="stylesheet" href="style.css">

    <title>fyp</title>
  </head>
  <body>
    <?php include ('navbar.php');?>
    <div class="container mb-3">
      <?php include ('navbar_top.php');?>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card mt-3">
            <div class="card-header">
              <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
              <?php
                            include('db.php');
                            $id=$_SESSION['id'];
                            $query=mysqli_query($con, "select * from users where user_id='$id'")or die(mysqli_error());
                            while ($row=mysqli_fetch_assoc($query)) {
                          ?>
              <form action="pro_update.php" method="post" enctype="multipart/form-data" oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
                
                        <div class="form-group">
                          
                          <label>Username</label>
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['user_id'];?>" required>
                          <input type="text" class="form-control" placeholder="Name" name="username" value="<?php echo $row['username'];?>">
                        </div>

                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $row['name'];?>">          
                        </div>
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="text" class="form-control" placeholder="013*******" name="cont" value="<?php echo $row['cont'];?>">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="hidden" class="form-control" name="pass" value="<?php echo $row['password'];?>">
                          <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" name="password2">
                        </div>
                        <div class="form-group">
                          <label>Picture</label>
                          <input type="hidden" class="form-control" name="image1" value="<?php echo $row['pro_pic'];?>"> 
                          <input type="file" class="form-control" name="image">    
                        </div>   
                      <hr>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form>
                    <?php }?>
            </div>
          </div>
        </div>
      </div><!--row1-->
    </div><!--container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>