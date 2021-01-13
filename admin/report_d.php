<?php session_start();
if(empty($_SESSION['id'])):
header('Location:index.php');
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- fontawesome CSS-->
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>fyp</title>
    <style type="text/css">
      .html,body{
        background-color: #EDEDED;
      }
    </style>
</head>
<body>
  <?php
  $user=$_GET['id1'];
  $_SESSION['user']=$_GET['id1'];
  include ('navbar.php');
  ?>
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title text-center">Sales Record</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-xs-2">
              <div class="card-body text-center card border-dark">
                <span><i class="fas fa-dollar-sign"></i> Total Sales (Monthly)</span>
                
                <?php
                  include('db.php'); 
                                
                  $year1 = date("Y");
                  $month = date("m");
                  $id = $_GET['id1'];
                  $query = mysqli_query($con,"select SUM(total) as total_payment from sales where user_id ='$id' and MONTH(date_added)='$month'") or die(mysqli_error($con));
                  $row=mysqli_fetch_array($query);
                ?>
                
                <font size="5" color="green">RM <?php echo $row['total_payment'];?></font>
              </div>
            </div>
            <div class="col-md-4 col-xs-2">
              <div class="card-body text-center card border-dark">
                <span><i class="fas fa-dollar-sign"></i> Total Sales (Annual)</span>
                  
                <?php
                  $query = mysqli_query($con,"select SUM(total) as total_payment from sales where user_id ='$id' and YEAR(date_added)='$year1'") or die(mysqli_error($con));
                  $row=mysqli_fetch_array($query);
                ?>
                                
                <font size="5" color="green">RM <?php echo $row['total_payment'];?></font>
              </div>
            </div>
            <div class="col-md-4 col-xs-2">
              <div class="card-body text-center card border-dark">
                <span><i class="fas fa-users"></i> Total Customer</span>
                    
                <?php
                  $query = mysqli_query($con,"select COUNT(*) as total_no_cust from customer where user_id ='$id'") or die(mysqli_error($con));
                      $row=mysqli_fetch_array($query);
                ?>
                    
                <font size="5" color="green"><?php echo $row['total_no_cust'];?></font>
              </div>        
            </div>
                            </div>
                        <div id="graph" class="mt-5">
                        </div>
                    </div>
                    <div class="card-footer">
                      <?php
                            $user = $_GET['id1'];
                            $query=mysqli_query($con,"select * from users where user_id='$user'")or die(mysqli_error($con));
                            $row=mysqli_fetch_assoc($query);
                            ?>
                      <h7>Sales by <?php echo $row['name'];?></h7>
                      <a class = "btn btn-primary btn-print float-right" href = "" onclick = "window.print()" data-toggle="tooltip" title="Print"><i class="fas fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

<script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../dist/highcharts.js"></script>
<script src="../dist/exporting.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      var options = {
              chart: {
                  renderTo: 'graph',
                  type: 'column'
              },
              title: {
                  text: ''
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  
                  title: {
                      text: 'Total Monthly Sales'
                  },
                  
              },
              series: [],
              plotOptions: {
                series: {
                pointWidth: 50    
                }
            }
          }
          
          $.getJSON("data.php", function(json) {
            options.xAxis.categories = json[0]['name'];
            options.series[0] = json[1];
            
            chart = new Highcharts.Chart(options);
          });
      });
    </script>
</body>
</html>
