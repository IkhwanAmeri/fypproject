<?php
    include('db.php');
    $id=$_SESSION['id'];
    $query=mysqli_query($con, "select * from users where user_id='$id'")or die(mysqli_error());
    $row=mysqli_fetch_assoc($query);
?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sticky-top">
            <div class="sidebar-header profile clearfix">
                <div class="profile_pic">
                <img src="../dist/images/<?php echo $row['pro_pic'];?>" alt="..." class="rounded-circle">   
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2><?php echo $row['name']?></h2>
                <h3><?php echo $row['cont']?></h3>
              </div>
               
                <strong><i class="fas fa-user-alt"></i></strong>
            
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="dashboard.php" >
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                    
                </li>
                <li>
                    <a href="product.php" >
                        <i class="fas fa-cart-plus"></i>
                        Product
                    </a>
                    
                </li>
                <li>
                    <a href="cust_trans.php">
                        <i class="fas fa-user-plus"></i>
                        Transaction
                    </a>
                    
                    
                </li>
                <li>
                	<a href="customer.php">
                        <i class="fas fa-user-check"></i>
                        Customer
                    </a>
                </li>
                <li>
                    <a href="stockin.php">
                        <i class="fas fa-cart-arrow-down"></i>
                        Stock
                    </a>
                </li>
                <li>
                    <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-dollar-sign"></i>
                        Report
                    </a>
                    <ul class="collapse list-unstyled" id="report">
                        <li>
                            <a href="report_inventory.php"><i class="far fa-chart-bar"></i> Inventory</a>
                        </li>
                        <li>
                            <a href="report_sales.php"><i class="fas fa-clipboard"></i> Sales</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="logout.php?logout='1'">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout</a>
                </li>
            </ul>
        </div>
        </nav>
    