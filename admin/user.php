<?php session_start();
if(empty($_SESSION['id'])):
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

    <!-- DataTable CSS-->
    <link rel="stylesheet" type="text/css" href="../plugins/DataTables/datatables.min.css"/>

    <!-- fontawesome CSS -->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>fyp</title>
  </head>
  <body>
    <?php include ('navbar.php');?>
    <div class="container">
      <div class="row">
          <div class="col-md-4">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
              </div>
              <div class="card-body"> 
                <form method="post" action="user_add.php" oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
                  <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Enter Username" name="username" required>          
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name" required>          
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Re-enter Your Password" name="password2" required>
                </div>
                <div class="form-group float-right">
                <button type="submit" class="btn btn-primary" name="reg_btn">Submit</button>
              <button type="reset" class="btn btn-danger">Reset</button>
              </div>
                </form>
              </div>
            </div>
      </div>
      <div class="col-md-8 col-xs-8">
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">User List</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-md table-body">
            <table id="user" class="table table-bordered table-striped" >
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('db.php');
                $id=$_SESSION['id'];
                $query=mysqli_query($con,"select * from users where user_id!='$id' order by user_id ASC")or die(mysqli_error());
                while($row=mysqli_fetch_assoc($query)){
                  $id=$row["user_id"];
                ?>
                <tr>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['name'];?></td>
                  <td>*****</td>
                  <td>
                    <a href="#updateuser<?php echo $id;?>" data-toggle="modal" data-target="#updateuser<?php echo $id;?>" style="color: green" title="Edit"><i class="fas fa-edit"></i></a>
                    <a onclick='confirmationDelete($(this));return false;' href="user_del.php?del=<?php echo $id;?>"><i class="fas fa-trash-alt" style="color: red" title="delete"></i></a>
                  </td>
                </tr>
                <?php include 'user_update_modal.php';?>

                <?php }?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="../plugins/DataTables/datatables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#user').DataTable({
          lengthMenu: [[5,10,25,50,-1],[5,10,25,50,"All"]]
        });
      } );
      function confirmationDelete(anchor)
        {
          var conf = confirm('Are you sure want to delete?');
          if(conf)
            window.location=anchor.attr("href");
        };
    </script>
  </body>
</html>