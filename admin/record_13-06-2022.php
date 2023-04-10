<?php 
 $title = 'Search Company'; 
include "config.php";
include 'header.php';?>

			<!--<div class="add-comapny">
                <a href="#" data-toggle="modal" data-target="#exampleModal">Add Company</a>
            </div>-->
<div class="part-name"> <h2>Search Student</h2> </div>
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
            <table class="table table-hover table-responsive" id="data-table-dashbaords">
              <thead>
                <tr class="top-table1">
                  <th>SL No.</th>
                  <th>Emp ID</th>
                  <th>Name</th>
                  <th>Company </th>
                  <th>Desination </th>
                  <th>Annual CTC </th>
                  <th>Month CTC </th>
                  <th>DOJ</th>
                  <th>Resign Date</th>
                </tr>
              </thead>
              <tbody>
			  
			    <?php //$sql = "SELECT * FROM emp_records ";
					$sql = "SELECT * FROM emp_records ORDER BY id ASC";
					$result = mysqli_query($con_exp, $sql);
						$i = 1;
						while($row = mysqli_fetch_array($result)) {
				 
				?>
                <tr>
                   <td><?php echo $row["id"];?> </td>
                  <td><?php echo $row['emp_id'];?></td>
                  <td><?php echo $row["emp_name"];?></td>
                  <td><?php echo $row["emp_company"];?></td>
                  <td><?php echo $row["emp_designation"];?></td>
                  <td><?php echo $row["emp_annual_ctc"];?></td>
                  <td><?php echo $row["emp_monthly_ctc"];?></td>
                  <td><?php echo $row["emp_doj"];?></td>
                  <td><?php echo $row["emp_dor"];?></td>               
                </tr>
				<?php } ?>
                 

            
              </tbody>
            </table>

          </div>


        </div>
      </div>
    </div>
  </div>




  <!-- JS here -->

<?php include 'footer.php';?>
  <script>
  //  $(document).ready(function () {
  //    $('#myTable').DataTable();
  //  });
  </script>
  
  <script>
    $(document).ready(function () {
       $('#data-table-dashbaords').DataTable({
      //  columnDefs: [ { type: 'ID', 'targets': [0] } ],
        order: [[ 0, 'desc' ]],
        "lengthMenu": [
        [10,50,100,250,500],
        ['10','50','100','250','500']
        ],
        
        });
     
    });
  </script> 
  
  
</body>

</html>