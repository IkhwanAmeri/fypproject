<?php session_start();
if (empty($_SESSION['id'])):
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
        <div class="col-md-12 col-xs-12">
          <div class="card mt-3">
            <div class="card-header">
              <h3 class="card-title d-inline">Product List</h3>
              <button type="button" class="btn d-inline btn-primary float-right" data-toggle="modal" data-target="#add" id="registerbutton" title="Add new Product">Add New Product</button>
            </div>
            <div class="card-body">
              <div class="table-responsive-md">
              <table id="product" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Product Pic</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity Left</th>
                    <th>Description</th>
                    <th>Supplier</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('db.php');
                  
                  $id=$_SESSION['id'];
                  $query=mysqli_query($con,"SELECT * FROM product where user_id='$id' order by product_id")or die(mysqli_error($con));
                  while($row=mysqli_fetch_assoc($query)){
                    ?>
                  <tr>
                    <td><img style="width: 80px;height: 60px" src="../dist/images/<?php echo $row['prod_pic'];?>"></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php echo $row['product_price'];?></td>
                    <td><?php echo $row['product_qty'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td><?php echo $row['supplier'];?></td>
                    <td>
                      <a href="#updateprod<?php echo $row['product_id'];?>" data-toggle="modal" data-target="#updateprod<?php echo $row['product_id'];?>" style="color: green" title="edit"><i class="fas fa-edit"></i></a> 
                      <a href="#delete<?php echo $row['product_id'];?>" data-target="#delete<?php echo $row['product_id'];?>" data-toggle="modal"><i class="fas fa-trash-alt" style="color: red" title="delete"></i></a>
                    </td>
                  </tr>

                <!--Update modal-->
                <div class="modal fade" id="updateprod<?php echo $row['product_id'];?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <span aria-hidden="true">&times;</span>
                      </div>
                      <div class="modal-body">
                          <form action="product_update.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Product</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['product_id'];?>" required>
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="<?php echo $row['product_name'];?>">          
                          </div>
                          <div class="form-group">
                            <label>Price (RM)</label>
                            <input type="number" class="form-control" placeholder="Enter Product Price" name="price" min="0.01" step="0.01" value="<?php echo $row['product_price'];?>">
                          </div>
                          <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" placeholder="Enter Product Quantity" class="form-control" min="1" step="1" name="quantity" value="<?php echo $row['product_qty'];?>">          
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" placeholder="Enter Product Description" name="description" value="<?php echo $row['description'];?>">          
                          </div>
                          <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" placeholder="Enter Product Supplier" name="supplier" value="<?php echo $row['supplier'];?>">       
                          </div>
                          <div class="form-group">
                            <label>Picture</label>
                            <input type="hidden" class="form-control" name="image1" value="<?php echo $row['prod_pic'];?>"> 
                            <input type="file" class="form-control" name="image">    
                          </div>     
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button> 
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div><!--modalupdate-->

                <!--Delete modal-->
                <div class="modal fade" id="delete<?php echo $row['product_id'];?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            <span aria-hidden="true">&times;</span>
                          </div>     
                            <div class="modal-body">
                              <form class="form-horizontal" method="post" action="product_del.php" enctype='multipart/form-data'>
                              <input type="hidden" class="form-control" name="del" value="<?php echo $row['product_id'];?>" required> 
                              <p>Are you sure you want to remove product <?php echo $row['product_name'];?>?</p>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Delete</button>
                              </div>
                            </form>
                        </div>
                      </div>
                   </div>
                 </div><!--modaldelete-->
                 
                <?php }?>
                </tbody>
              </table>
              </div><!--responsive table-->
            </div><!--cardbody-->
          </div><!--card-->
        </div><!--Col-->
        </div><!--row-->
      </div><!--container-->
    </div><!--navbar-->

      <!--Addproduct modal-->
      <div class="modal fade" id="add" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Product </h5>
                <i style="color: red">* required (You may leave others in blank)</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
              </div>
              <div class="modal-body">
                  <form method="post" action="product_add.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Product *</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" required>          
                  </div>
                  <div class="form-group">
                    <label>Price (RM) *</label>
                    <input type="number" class="form-control" placeholder="Enter Product Price" name="price" min="0.01" step="0.01" required>
                  </div>
                  <div class="form-group">
                    <label>Quantity *</label>
                    <input type="number" class="form-control" placeholder="Enter Product Quantity" name="quantity" min="1" step="1" required>          
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="Enter Product Description" name="description">          
                  </div>
                  <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" class="form-control" placeholder="Enter Product Supplier" name="supplier">       
                  </div>
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" name="image">    
                  </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
                </form> 
            </div>
          </div>
        </div>
      </div><!--addmodal-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="../plugins/DataTables/datatables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#product').DataTable();
      } );

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
  </body>
</html>