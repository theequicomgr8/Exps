<?php
include "config.php";
	if( !isset($_POST['export']) ) {
		die("You can't access it directly");
	}
 
	header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0'); 
	header('Pragma: no-cache'); 
	header('Content-Type: application/x-msexcel; format=attachment;'); 
	header('Content-Disposition: attachment; filename=exp-dashbord-details_'.date('Y-m-d H:i a').'.xls'); 
	if( isset($_POST['export']) && $_POST['export'] == 'export' ) {
        $queryString = "SELECT * FROM `emp_records` ORDER BY id DESC";
    }
?>
    <table border="1" cellspacing="10" cellpadding="2">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Exp Year</th>
          <th>Designation</th>
           <th>Current Salary</th> 
         
      </tr>
    </thead>
    <tbody>
    <?php
      
      	$result = mysqli_query($con_exp, $queryString);
    while ($row = mysqli_fetch_assoc($result)) {
   //  echo "<pre>";print_r($row);die;
            ?>
            <tr>
              <td><?php echo $row['gender'].' '.$row['emp_name'] ; ?></td>
              <td><?php echo $row['emp_phone']; ?></td>
              <td><?php echo $row['emp_email']; ?></td>
              <td><?php if($row['emp_exp_year']){  echo $row['emp_exp_year'].' Year '.$row['emp_exp_month'].' months'; } ?></td>
              <td><?php if($row['emp_designation']){ echo $row['emp_designation']; } ?></td>
                <td><?php if($row['emp_current_salary']){ echo $row['emp_current_salary']; } ?></td>
              
             
            </tr>
            <?php
          }
       
    ?>                
    </tbody>
    </table>