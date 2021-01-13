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
        <div class="col-md-9">
          <div class="card mt-3">
            <div class="card-header">
              <h3 class="card-title">Sales Transaction</h3>
            </div>
            <div class="card-body">
              <form class="form" method="post" action="transaction_add.php">
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Product Name</label>
                    <select class="form-control" tabindex="1" name="product_name" autofocus="required" required>
                      <?php
                      include('db.php');
                      $id = $_SESSION['id'];
                      $query2=mysqli_query($con,"select * from product where user_id='$id' order by product_name")or die(mysqli_error($con));
                      while($row=mysqli_fetch_assoc($query2)){
                      ?>
                      <option value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class=" col-md-2">
                  <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group">
                      <input type="number" class="form-control pull-right" name="qty" min="1" step="1" value="1" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="date"></label>
                    <div class="input-group">
                      <button class="btn btn-lg btn-primary" type="submit" name="addtocart" title="Add to Cart">+</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>
            </div><!--cardbody-->
            <div class="col-md-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Quantity</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query=mysqli_query($con,"select * from temp_trans inner join product on temp_trans.product_id=product.product_id where temp_trans.user_id='$id'")or die(mysqli_error($con));
                  
                    $grand=0;
                    while($row=mysqli_fetch_assoc($query)){
                        $id=$row['temp_trans_id'];
                        $total=$row['product_price']*$row['qty'];
                        $grand=$grand+$total;
                  ?>
                  <tr>
                    <td><?php echo $row['qty'];?></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php echo number_format($total,2);?></td>
                    <td>

                    <a href="#delete<?php echo $row['temp_trans_id'];?>" data-target="#delete<?php echo $row['temp_trans_id'];?>" data-toggle="modal"><i class="fas fa-trash-alt" style="color: red" title="delete"></i></a>
                              
                    </td>
                  </tr>
                 
                  <!--delete modal-->
                  <div class="modal fade" id="delete<?php echo $row['temp_trans_id'];?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Delete</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                          <span aria-hidden="true">&times;</span>
                        </div>     
                          <div class="modal-body">
                            <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>   
                            <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
                            <p>Are you sure you want to remove <?php echo $row['product_name'];?>?</p>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                            </form>
                      </div>
                    </div>
                 </div>
               </div><!--deletemodal-->
                <?php }?>           
                </tbody>
              </table>
            </div>
          </div>
        </div><!--colmd9-->
        <div class="col-md-3">
            <div class="card mt-3">
              <div class="card-body">
                <form method="post" action="sales_add.php">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="date">Total</label>
                        <input type="text" class="form-control" name="total" value="<?php echo number_format($grand,2)?>" readonly>
                    </div>
                  </div>
                </div>  
                <div class="text-center">
                  <button class="btn btn-primary" type="submit">Complete Sales
                  </button>
                </div>
                </form>
              </div>
            </div>
          </div><!--colmd3-->
      </div><!--row-->
    </div><!--container-->
  </div><!--navbar-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
  </body>
</html>