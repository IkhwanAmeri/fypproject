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

    <!-- fontawesome CSS -->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <link rel="stylesheet" href="style.css">

    <title>fyp</title>
  </head>
  <body>
    <?php include ('navbar.php');?>
    <div class="container mb-3">
      <?php include ('navbar_top.php');?>
      <div class="row">
        <div class="col-md-4">
        	<div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Stock Products</h3>
              </div>
              <div class="card-body"> 
                <form method="post" action="stockin_add.php">
                  <div class="form-group">
                    <label>Product Name</label>
                    <div class="input-group">
                      <select class="form-control" name="product_name" required>
                        <?php
                        include('db.php');

                        $id=$_SESSION['id'];
                        $query2=mysqli_query($con,"select * from product where user_id='$id' order by product_name")or die(mysqli_error());
                        while($row=mysqli_fetch_assoc($query2)){
                        ?>
                          <option value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <div class="input-group">
                      <input type="number" name="qty" class="form-control float-right" min="1" step="1" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
      </div>
      </div>

      	<div class="col-md-8">
        	<div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Product Stock List</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
            <table id="stockin" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity Added</th>
                  <th>Supplier</th>
                  <th>Date Added</th>
                  <th>Quantity Left</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $id=$_SESSION['id'];
                $query=mysqli_query($con,"select * from stockin natural join product where user_id='$id' order by date desc")or die(mysqli_error());
                while($row=mysqli_fetch_assoc($query)){
                
                ?>
                <tr>
                  <td><?php echo $row['product_name'];?></td>
                  <td><?php echo $row['s_quantity'];?></td>
                  <td><?php echo $row['supplier'];?></td>
                  <td><?php echo $row['date'];?></td>
                  <td><?php echo $row['product_qty'];?></td>
                </tr>
              <?php }?>
              </tbody>
            </table>
            </div>
          </div>
        	</div>
      	</div>
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
        $('#stockin').DataTable({
          lengthMenu: [[3,6,12,-1],[3,6,12,"All"]]
        });
      } );
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
  </body>
</html>