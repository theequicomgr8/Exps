<?php include 'header.php';?>

<?php 
	//session_start();
	include "config.php";
?>
<div class="add-comapny">
                <a href="#" data-toggle="modal" data-target="#exampleModal">Add Company</a>
            </div>
<div class="part-name"> <h2>Search Student</h2> </div>
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
            <table class="table table-hover table-responsive" id="myTable">
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
					$sql = "SELECT * FROM emp_records where emp_id ORDER BY id ASC";
					$result = mysqli_query($con_exp, $sql);
					$row = mysqli_fetch_array($result);
					//echo "<pre>"; print_r($row); die;
						$i = 1;
						while ($row = $result->fetch_assoc()) {
				
				?>
                <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $row["emp_id"];?></td>
                  <td><?php echo $row["emp_name"];?></td>
                  <td><?php echo $row["emp_company"];?></td>
                  <td><?php echo $row["emp_designation"];?></td>
                  <td><?php echo $row["emp_annual_ctc"];?></td>
                  <td><?php echo $row["emp_monthly_ctc"];?></td>
                  <td><?php echo $row["emp_date_joining"];?></td>
                  <td><?php echo $row["emp_date_relieving"];?></td>               
                </tr>
				<?php } ?>
                <!--<tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>04205</td>
                    <td>Pankaj Singh</td>
                    <td>Croma Campus</td>
                    <td>Web Developer</td>
                    <td>2 Lakh</td>
                    <td>10000</td>
                    <td>08/04/2022</td>
                    <td>08/04/2022</td>                 
                  </tr>-->

            
              </tbody>
            </table>

          </div>


        </div>
      </div>
    </div>
  </div>




  <!-- JS here -->

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>