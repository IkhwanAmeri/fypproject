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
      <div  class="col-md-8">
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Transaction</h3>
          </div>
          <div class="card-body">
            <form method="post" action="cust_add.php">
                <div class="row">
                  <div class="col-md-12">
                    <h3>New Customer detail</h3>
                    <hr>
                  </div>
                <div class="form-group col-md-6">
                  <?php 
                    $cid=$_REQUEST['cid'];
                  ?>
                  <label>Name *</label>
                    <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>">
                    <input type="hidden" class="form-control" name="rcid" id="rcid">
                    <input type="text" class="form-control" name="name" id="cname" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Contact Number *</label>
                    <input type="text" class="form-control" name="contact" id="ccont" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Address</label>
                    <input type="text" class="form-control" name="address" id="cadd">
                </div>
                <div class="form-group col-md-6">
                  <label>City</label>
                    <input type="text" class="form-control" name="city" id="ccity">
                </div>

                <div class="form-group col-md-6">
                  <label>State</label>
                    <input type="text" class="form-control" name="state" id="cstate">
                </div>

                <div class="form-group col-md-6">
                  <label>Poscode</label>
                    <input type="text" class="form-control" name="poscode" id="cpos">
                </div>
              </div>
                <i style="color: red">* required</i>
                <button type="submit" class="btn btn-primary float-right">Next</button>
            </form>
          </div>
        </div>
      </div><!--col-->

      <div class="col-md-4">
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Existing Customer</h3>
          </div>
          <div class="card-body">
            <form method="get">
              <div class="form-group">
                <label>Search Existing Customer</label>
                <div class="input-group col-md-12">
                  <select class="form-control" id="custid" required>
                    <option value="">Select Customer</option>
                    <?php
                       include('db.php');
                       $id=$_SESSION['id'];
                        $query2=mysqli_query($con,"select * from customer where user_id='$id' group by cust_name")or die(mysqli_error());
                          while($row2=mysqli_fetch_assoc($query2)){
                      ?>
                    <option value="<?php echo $row2['cust_id'];?>"><?php echo $row2['cust_name'];?></option>
                  <?php }?>
                  </select>
                </div>
              </div>
            </form>
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
    <script type="text/javascript">
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

      $(document).ready(function(){
        $('#custid').change(function(){
          var id= $('#custid').val();
          if(id != '')
          {
           $.ajax({
            url:"exist_cust.php",
            method:"POST",
            data:{id:id},
            dataType:"JSON",
            success:function(data)
            {
             $('#rcid').val(data.id);
             $('#cname').val(data.name);
             $('#ccont').val(data.cont);
             $('#cadd').val(data.address);
             $('#ccity').val(data.city);
             $('#cstate').val(data.state);
             $('#cpos').val(data.poscode);
            }
           })
          }
          else
          {
           alert("Please Select Existing Customer");
          }
        });
      });
    </script>
  </body>
</html>