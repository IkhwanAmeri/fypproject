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
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <title>fyp</title>
</head>
<body>
  <?php include ('navbar.php');?>
    <div class="container mb-3">
      <?php include ('navbar_top.php');?>
        <div class="col-md-12">
          <div class="card-body">
            <form method="post">
            <label>Date Range</label>
              <div class="row">
                <div class="form-group col-md-6">
                  <input type="text" name="date" class="form-control" id="reservation" required>
                </div>
              <button type="submit" class="btn btn-primary h-100" name="display">Display</button>
              </div>
            </form>
          </div>
        </div><!--colmd12-->

        <?php
        if (isset($_POST['display']))
        {
          $date=$_POST['date'];
          $date=explode('-',$date);
          $id=$_SESSION['id'];
          $start=date("Y/m/d",strtotime($date[0]));
          $end=date("Y/m/d",strtotime($date[1]));
        
        ?>
        
        <div class="col-md-12">
          <div class="card mt-3">
            <div class="card-header">
              <h5 class="card-title">Cash Sales Report as of <?php echo date("M d, Y",strtotime($start))." to ".date("M d, Y",strtotime($end));?></h5>
            </div>
            <div class="card-body" id="content2">
              <div class="table-responsive-md">
                <table class="table table-bordered table-striped" id="stable">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Date Paid</th>
                      <th>Item Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include('db.php');
                      $id=$_SESSION['id'];
                      $query=mysqli_query($con,"select * from sales natural join sales_detail natural join product natural join customer where date(date_added)>='$start' and date(date_added)<='$end' and user_id='$id' order by sales_id")or die(mysqli_error($con));
                      $qty=0;
                      $grand=0;
                        while ($row=mysqli_fetch_assoc($query)) {
                          $total=$row['price'];
                          $grand=$grand+$total;
                    ?>

                    <tr>
                      <td><?php echo $row['cust_name'];?></td>
                      <td><?php echo $row['product_name'];?></td>
                      <td><?php echo $row['qty'];?></td>
                      <td><?php echo date("M d, Y h:i a",strtotime($row['date_added']));?></td>
                      <td><?php echo $row['price'];?></td>
                      <?php }?><!--endwhile-->
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="4">Total Sale</th>
                      <th colspan="1"><?php  echo number_format($grand,2);?></th>
                    </tr>
                  </tfoot>
                </table>
              </div><!--tableresponsive-->
                <?php
                $id=$_SESSION['id'];
                $query=mysqli_query($con,"select * from users where user_id='$id'")or die(mysqli_error($con));
                $row=mysqli_fetch_assoc($query);
                ?>
                <h7>Report by <?php echo $row['name'];?></h7><br>
                <h7>On <?php date_default_timezone_set("Asia/Kuala_Lumpur");echo date("M d, Y h:i a");?></h7>
            </div><!--cardbody-->

          </div><!--card-->
          <div class="card-footer">
            <div class="row">
            	  <button id="icsv" class="btn btn-success col-md-1 ml-2 mt-1">CSV<i class="fas fa-arrow-down"></i></button>
                <button class="btn btn-warning col-md-1 ml-2 mt-1" onclick="generate()">Pdf<i class="fas fa-arrow-down"></i></button>
                <a class = "btn btn-primary col-md-1 ml-2 mt-1" href = "" onclick = "window.print()" title="print">Print<i class="fas fa-print"></i></a>
            </div><!--rowfooter-->
          </div>
          
        </div>
        <?php }?><!--endif-->
    </div><!--container-->
  </div><!--navbar-->
    

    

<script src="../plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/daterangepicker/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../dist/jspdf.min.js"></script>
<script src="../dist/jspdf.plugin.autotable.min.js"></script>
<script src="../dist/FileSaver.js"></script>
<script src="../dist/tableexport.js"></script>
<script type="text/javascript">
  $('#reservation').daterangepicker();
  $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
  function generate() {
    var doc = new jsPDF()

    doc.autoTable({ html: '#stable', 
                    theme: 'grid',
                    headStyles: {lineWidth: 0.1}, 
                    footStyles: { fillColor: null,
                                  textColor: 20,
                                  lineWidth: 0.1} })

    doc.save('Sales.pdf') 
  };

  var inventory = 'stable';
  var ExportButtons = document.getElementById(inventory);
  var instance = new TableExport(ExportButtons,{
          filename: 'sales',
          formats: ['csv'],
          exportButtons: false
        });

  var exportData = instance.getExportData()[inventory]['csv'];
  var XLSbutton = document.getElementById('icsv');

  XLSbutton.addEventListener('click', function (e) {
        instance.export2file(exportData.data, exportData.mimeType, exportData.filename, exportData.fileExtension);
      });
        
</script>
</body>
</html>
