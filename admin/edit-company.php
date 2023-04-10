<?php 
 $title = 'Edit Company'; 
include 'header.php';?>

                <!-- Change Password Modal -->
              <div class="modal fade" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <form action="post">
                      <label for="">Old Password*</label>
                      <input type="password" required>
                      <label for="">New Password*</label>
                      <input type="password" required>
                      <label for="">Repeat Password*</label>
                      <input type="password" required>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                     </form>
                </div>
              </div>
            </div>
             <!-- Change Password End  -->
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
                <div class="edit-company">
                    <h2>Edit Your Profile</h2>
                    <form action="#">
                        <label for="">Enter Company Name*</label>
                        <input type="text" required>
                        <label for="">Choose Logo*</label>
                        <input type="file" required>
                        <label for="">Company Address-1*</label>
                        <input type="text" required>
                        <label for="">Company Address-2*</label>
                        <input type="text" required>
                        <label for="">HR Manager Name*</label>
                        <input type="text" required>   
                        <hr>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                       </form>
                </div>

          </div>


        </div>
      </div>
    </div>
  </div>




  <!-- JS here -->

<?php include 'footer.php';?>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>