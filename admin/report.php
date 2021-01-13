<?php session_start();
if (empty($_SESSION['id'])):
header('Location:index.php');
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

    <!-- fontawesome CSS-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>fyp</title>
  </head>
  <body>
    <?php include ('navbar.php');?>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card mt-3">
            <div class="card-header">
              <h3 class="card-title">Dropshipper Reports</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <?php 
                include 'db.php';
                $id=$_SESSION['id'];
                $query1=mysqli_query($con,"select * from users where user_id!='$id' ORDER BY username")or die(mysqli_error($con));
                while ($row=mysqli_fetch_array($query1)){
                $id1=$row['user_id'];
                $_SESSION['id1']=$id1;?>
                <div class="col-md-6 col-xs-6">
                    <div class="card-body card border-dark mt-2">
                      <h5 class="card-text text-center">
                        <a href  = "report_d.php?id1=<?php echo $row['user_id'];?>">
                        <?php echo $row['name'];?>
                        </a> 
                      </h5>
                    </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mt-3">
            <?php
              include('db.php');
              $id=$_SESSION['id'];
              $query=mysqli_query($con, "select * from users where user_id='$id'")or die(mysqli_error());
              $row=mysqli_fetch_assoc($query);
            ?>
            <div class="card-header">
                <h3 class="card-title">Profile
                  <a href="#updatepro<?php echo $row['user_id'];?>" data-toggle="modal" data-target="#updatepro<?php echo $row['user_id'];?>" style="color: black" class="float-right" title="Edit"><i class="fas fa-users-cog text-black"></i> </a></h3>
            </div>
            <div class="card-body">
              <p><b><i class="fas fa-user-tie"></i> Name: </b><br>
                <?php echo $row['name']; ?></p>
              <p><b><i class="fas fa-user"></i> Username: </b><br>
                <?php echo $row['username']?></p>
              <p><b><i class="fas fa-address-book"></i> Contact Number: </b><br>
                <?php echo $row['cont']?></p>
            </div>
            <div class="modal fade" id="updatepro<?php echo $row['user_id'];?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Profile</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                      <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="pro_update.php" method="post">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['user_id'];?>" required>
                          <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $row['name'];?>">          
                        </div>
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="text" class="form-control" placeholder="013*******" name="cont" value="<?php echo $row['cont'];?>">
                        </div>   
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--row-->
    </div><!--container-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>