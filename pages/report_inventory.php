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
              <h4 class="card-title">Product Inventory</h4>
          </div>
          <div class="card-body" id="content2">
            <div class="table-responsive-md" id="dvData">
            <table class="table table-bordered table-striped" id="itable">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity Left</th>
                  <th>Description</th>
                  <th>Supplier</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('db.php');
                $id=$_SESSION['id'];
                $query=mysqli_query($con,"select * from product where user_id='$id' order by product_name")or die(mysqli_error($con));
                $grand=0;
                while($row=mysqli_fetch_assoc($query)){
                  $total=$row['product_price']*$row['product_qty'];
                  $grand+=$total;
                ?>
                
                <tr>
                  <td><?php echo $row['product_name'];?></td>
                  <td><?php echo $row['product_qty'];?></td>
                  <td><?php echo $row['description'];?></td>
                  <td><?php echo $row['supplier'];?></td>
                  <td><?php echo $row['product_price'];?></td>
                  <td><?php echo number_format($total,2);?></td>
                </tr>
              <?php }?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="5">Total</th>
                  <th colspan="1"><?php echo number_format($grand,2);?></th>
                </tr>
              </tfoot>
            </table>
            </div>
            <hr>
            <?php
              $id=$_SESSION['id'];
              $query=mysqli_query($con,"select * from users where user_id='$id'")or die(mysqli_error($con));
              $row=mysqli_fetch_assoc($query);
              ?>
              <h7>Report by <?php echo $row['name'];?></h7><br>
              <h7>On <?php date_default_timezone_set("Asia/Kuala_Lumpur");echo date("M d, Y h:i a");?></h7>
          </div>
          
        </div>
        <div class="card-footer">
            <div class="row">
   				<button id="icsv" class="btn btn-success col-md-1 ml-2 mt-1">CSV<i class="fas fa-arrow-down"></i></button>
                <button class="btn btn-warning col-md-1 ml-2 mt-1" onclick="pdf()">Pdf<i class="fas fa-arrow-down"></i></button>
                <a class = "btn btn-primary col-md-1 ml-2 mt-1" href = "" onclick = "window.print()" title="print">Print<i class="fas fa-print"></i></a>
            </div><!--rowfooter-->
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
    <script src="../plugins/DataTables/datatables.min.js"></script>
    <script src="../dist/jspdf.min.js"></script>
    <script src="../dist/jspdf.plugin.autotable.min.js"></script>
    <script src="../dist/FileSaver.js"></script>
    <script src="../dist/tableexport.js"></script>
    <script>
      $(document).ready( function () {
        $('#itable').DataTable();
      } );
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
      function pdf() {
        var doc = new jsPDF()

        doc.autoTable({ html: '#itable', 
                        theme: 'grid',
                        headStyles: {lineWidth: 0.1}, 
                        footStyles: { fillColor: null,
                                      textColor: 20,
                                      lineWidth: 0.1} })

        doc.save('Inventory.pdf') 
      };


      	var inventory = 'itable';
      	var ExportButtons = document.getElementById(inventory);
      	var instance = new TableExport(ExportButtons,{
      		filename: 'inventory',
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