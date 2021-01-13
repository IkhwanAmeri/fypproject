<div class="modal fade" id="updateuser<?php echo $id;?>" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                      <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="user_update.php" method="post">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>" required>
                          <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $row['username'];?>">          
                        </div>
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $row['name'];?>">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>   
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form> 

              
                    </div>
                  </div>
                </div>
</div>
