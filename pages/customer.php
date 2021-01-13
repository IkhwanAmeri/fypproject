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
            <h3 class="card-title">Customer List</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
            <table id="customer" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Poscode</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('db.php');
                $id=$_SESSION['id'];
                //$query=mysqli_query($con,"select * from customer natural join sales where user_id='$id'")or die(mysqli_error($con));
                $query=mysqli_query($con,"select * from customer where user_id='$id'")or die(mysqli_error($con));
                $i=1;
                while($row=mysqli_fetch_assoc($query)){
                  $cid=$row['cust_id'];
                ?>
                
                <tr>
                  <td><?php echo $row['cust_name'];?></td>
                  <td><?php echo $row['cust_cont'];?></td>
                  <td><?php echo $row['address'];?></td>
                  <td><?php echo $row['city'];?></td>
                  <td><?php echo $row['state'];?></td>
                  <td><?php echo $row['poscode'];?></td>
                  <td>
                    <div class="text-center">
                    <a href="#updatecust<?php echo $row['cust_id'];?>" data-toggle="modal" data-target="#updatecust<?php echo $row['cust_id'];?>" style="color: green" title="edit"><i class="fas fa-user-edit"></i></a>
                    </div>

                  </td>
                </tr>
                <div class="modal fade" id="updatecust<?php echo $row['cust_id'];?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Customer Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                      <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="cust_update.php" method="post">
                        <div class="form-group">
                          <label>Customer Name</label>
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>
                          <input type="text" class="form-control" placeholder="Product Name" name="name" value="<?php echo $row['cust_name'];?>">          
                        </div>
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="text" class="form-control" placeholder="013*******" name="contact" value="<?php echo $row['cust_cont'];?>">
                        </div>
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" placeholder="1 Jalan XYZ" name="address" value="<?php echo $row['address'];?>">
                        </div>
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" placeholder="Sarawak" name="city" value="<?php echo $row['city'];?>">
                        </div>
                        <div class="form-group">
                          <label>State</label>
                          <input type="text" class="form-control" placeholder="Samarahan" name="state" value="<?php echo $row['state'];?>">
                        </div>
                        <div class="form-group">
                          <label>Poscode</label>
                          <input type="text" class="form-control" placeholder="93060" name="poscode" value="<?php echo $row['poscode'];?>">
                        </div>    
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form> 
                    </div>
                  </div>
                </div>
              </div>

                <?php $i++;}?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div><!--col-->
      </div><!--row-->
    </div><!--container-->
  </div><!--navbar-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="../plugins/DataTables/datatables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#customer').DataTable();
      } );
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
  </body>
</html>