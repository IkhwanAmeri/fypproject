<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
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

    <link rel="stylesheet" href="style.css">

    <title>fyp</title>
</head>
<body>
  <?php include ('navbar.php');?>
    <div class="container mr-4 mb-3">
      <?php include ('navbar_top.php');?>
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <h3 class="mt-3 mb-3">Dashboard</h3>
          </div>
            <div class="col-md-4 col-xs-2">
              <div class="card-body text-center card border-dark">
                <span><i class="fas fa-dollar-sign"></i> Total Sales (Monthly)</span>
                
                <?php
                  include('db.php'); 
                                
                  $year1 = date("Y");
                  $month = date("m");
                  $id = $_SESSION['id'];
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
                  include('db.php'); 
                                
                  $year1 = date("Y");
                  $month = date("m");
                  $id = $_SESSION['id'];
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
            <div class="col-md-8 mt-3">
              <div class="card">
                <div class="card-header">
                  <h4>Earning Overview</h4>
                </div>
                  <div class="card-body">
                    <div id="graph"></div>
                  </div>
              </div>
            </div>
        <div class="col-md-4 mt-3">
          <div class="card">
            <div class="card-header">
              <h4>Popular Product</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive-md">
                <table class="table-bordered" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Qty Sold</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query3=mysqli_query($con,"select product.*,SUM(sales_detail.qty) as total from product join sales_detail on product.product_id=sales_detail.product_id where product.user_id='$id' group by sales_detail.product_id order by total desc limit 2")or die(mysqli_error($con));
                    while ($row=mysqli_fetch_assoc($query3)) {
                    ?>
                    <tr>
                      <td><?php echo $row['product_name'];?></td>
                      <td><?php echo $row['total']?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
    </div><!--row-->
  </div><!--container-->
</div><!--navbar-->
    
<script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../dist/highcharts.js"></script>
<script src="../dist/exporting.js"></script>
<script src="../dist/dom-to-image.min.js"></script>
<script src="../dist/jspdf.min.js"></script>
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
    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    $('#downloadPDF').click(function () {
    domtoimage.toPng(document.getElementById('content2'))
        .then(function (blob) {
            var pdf = new jsPDF('l', 'pt', [$('#content2').width(), $('#content2').height()]);

            pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
            pdf.save("sales.pdf");

            that.options.api.optionsChanged();
        });
});
    </script>
</body>
</html>
