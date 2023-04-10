<?php
include "config.php";
	if( !isset($_POST['export']) ) {
		die("You can't access it directly");
	}
 
	header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0'); 
	header('Pragma: no-cache'); 
	header('Content-Type: application/x-msexcel; format=attachment;'); 
	header('Content-Disposition: attachment; filename=record-details_'.date('Y-m-d H:i a').'.xls'); 
	if( isset($_POST['export']) && $_POST['export'] == 'export' ) {
        $queryString = "SELECT * FROM `emp_records` where status=1 ORDER BY id DESC";
    }
?>
    <table border="1" cellspacing="10" cellpadding="2">
    <thead>
      <tr>
        <th>EMP ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Exp Year</th>
        <th>Company Name</th>
         <th>Designation</th>
         <th>Date Of Join</th>
         <th>Date Of Eelieving </th>
         
         <th>Joining Pack</th>
        <th>Current Salary</th> 
         
      </tr>
    </thead>
    <tbody>
    <?php
      
      	$result = mysqli_query($con_exp, $queryString);
    while ($row = mysqli_fetch_assoc($result)) {
    
            ?>
            <tr>
            <td><?php if($row['emp_id']){ echo $row['emp_id']; } ?></td>
              <td><?php echo $row['gender'].' '.$row['emp_name'] ; ?></td>
              <td><?php echo $row['emp_phone']; ?></td>
              <td><?php echo $row['emp_email']; ?></td>
              <td><?php if($row['emp_exp_year']){  echo $row['emp_exp_year'].' Year '.$row['emp_exp_month'].' months'; } ?></td>
               <td><?php if($row["emp_company"]){ echo $row["emp_company"]; } ?></td>
              <td><?php if($row['emp_designation']){ echo $row['emp_designation']; } ?></td>
               <td><?php echo $row["emp_doj"];?></td>
                  <td><?php echo $row["emp_dor"];?></td>  
               <td><?php if($row['emp_joining_pack']){ echo $row['emp_joining_pack']; } ?></td>
                <td><?php if($row['emp_current_salary']){ echo $row['emp_current_salary']; } ?></td>
              
             
            </tr>
            <?php
          }
       
    ?>                
    </tbody>
    </table>