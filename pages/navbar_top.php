<?php
    include('db.php');
    $id=$_SESSION['id'];
    $query=mysqli_query($con, "select * from users where user_id='$id'")or die(mysqli_error());
    $row=mysqli_fetch_assoc($query);
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light topbar">
      <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-info mt-1"><i class="fas fa-align-left"></i>
          </button> 
        <!--<a href="logout.php?logout='1'" class="btn btn-warning mt-2"><i class="fas fa-sign-out-alt" data-toggle="tooltip" title="Log Out"></i> Log Out</a>!-->
        <ul class="navbar-nav ml-auto">
        	<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $row['name']; ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php?logout='1'">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
              </div>
            </li>
        </ul>
</div>
</nav>  