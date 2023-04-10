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
	    $id= $_POST['id'];
        $queryString = "SELECT * FROM `emp_records` where status=1 and id=".$id." ORDER BY id DESC";
        
       // echo $queryString;die;
    }
?>
    <table border="1" cellspacing="10" cellpadding="2">
    <thead>
         <?php
      
      	$result = mysqli_query($con_exp, $queryString);
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr><th>EMP ID</th> <td><?php if($row['emp_id']){ echo $row['emp_id']; } ?></td></tr> 
        <tr><th>Name</th><td><?php echo $row['gender'].' '.$row['emp_name'] ; ?></td></tr>
        <tr><th>Mobile</th> <td style="text-align:left"><?php echo $row['emp_phone']; ?></td> </tr>
      <tr> <th>Email</th> <td><?php echo $row['emp_email']; ?></td></tr>
           <tr> <th>Exp Year</th>   <td><?php if($row['emp_exp_year']){  echo $row['emp_exp_year'].' Year '.$row['emp_exp_month'].' months'; } ?></td>  </tr>
           <tr> <th>Company Name</th>   <td><?php if($row["emp_company"]){ echo $row["emp_company"]; } ?></td>   </tr>
           <tr> <th>Designation</th>  <td><?php if($row['emp_designation']){ echo $row['emp_designation']; } ?></td>   </tr>
         <tr>   <th>Date Of Join</th> <td style="text-align:left"><?php echo $row["emp_doj"];?></td>    </tr>
          <tr>  <th>Date Of Eelieving </th>  <td style="text-align:left"><?php echo $row["emp_dor"];?></td>      </tr>
        
            <tr><th>Joining Pack</th>   <td style="text-align:left"><?php if($row['emp_joining_pack']){ echo $row['emp_joining_pack']; } ?></td>   </tr>
         <tr> <th>Current Salary</th>    <td style="text-align:left"><?php if($row['emp_current_salary']){ echo $row['emp_current_salary']; } ?></td></tr>
         <tr> <th>Net Pay</th>  <td style="text-align:left"><?php if($row['emp_netpay']){ echo $row['emp_netpay']; } ?></td> </tr>
        
         <tr> <th>CTC 1</th> <td style="text-align:left"><?php if($row['emp_ctc1']){ echo $row['emp_ctc1']; } ?></td>  </tr>
         <tr> <th>CTC 2</th><td style="text-align:left"><?php if($row['emp_ctc2']){ echo $row['emp_ctc2']; } ?></td>   </tr>
       <tr>   <th>CTC 3</th>  <td style="text-align:left"><?php if($row['emp_ctc3']){ echo $row['emp_ctc3']; } ?></td>  </tr>
        
        <tr>  <th>Department</th>  <td><?php if($row['emp_department']){ echo $row['emp_department']; } ?></td> </tr>
         <tr> <th>Address</th>  <td><?php if($row['address']){ echo $row['address']; } ?></td> </tr>
      <tr>    <th>Work</th>    <td><?php if($row['emp_brief_work']){ echo $row['emp_brief_work']; } ?></td> </tr>
        
        
      <?php  } ?>
    </thead>
  
   
    </table>