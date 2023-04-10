<?php	 
	include "config.php";
?>
<?php
	//echo "<pre>"; print_r($_POST); 
		//echo "<pre>"; print_r($_FILES); die;
	//echo "<pre>"; print_r($_POST);  
	//$phone	= $_SESSION['phone'];
	//echo $phone;
	//if(!$_SESSION['phone'])	
?>
<?php  
        // Add Company Name
	if(isset($_POST['action']) && $_POST['action']=='companySave')
	{
		//echo "<pre>";print_r($_POST);print_r($_FILES);
		 $comp_name = $_POST['comp_name'];	
		 $comp_abbr = $_POST['comp_abbr'];	
		 $comp_address = $_POST['comp_address'];	
		 $company_address2 = $_POST['company_address2'];	
		 $hr_name = $_POST['hr_name'];	
		 $img = $_FILES['comp_logo']['name'];
		 $letterhead_header = $_FILES['comp_letterhead_header']['name'];
		 $letterhead_footer = $_FILES['comp_letterhead_footer']['name'];   
		
		if($_FILES['comp_logo']['name']){
			move_uploaded_file($_FILES['comp_logo']['tmp_name'], "upload/".$_FILES['comp_logo']['name']);
			$img = "upload/".$_FILES['comp_logo']['name'];
		}
		if($_FILES['comp_letterhead_header']['name']){
			move_uploaded_file($_FILES['comp_letterhead_header']['tmp_name'], "upload/".$_FILES['comp_letterhead_header']['name']);
			$letterhead_header = "upload/".$_FILES['comp_letterhead_header']['name'];
		}
		if($_FILES['comp_letterhead_footer']['name']){
			move_uploaded_file($_FILES['comp_letterhead_footer']['tmp_name'], "upload/".$_FILES['comp_letterhead_footer']['name']);
			$letterhead_footer = "upload/".$_FILES['comp_letterhead_footer']['name'];
		}
		$res= "INSERT INTO companies(comp_name,comp_abbreviation,comp_address,company_address2,hr_name,comp_logo,comp_letterhead_header,comp_letterhead_footer) VALUES('".$comp_name."','".$comp_abbr."','".$comp_address."','".$company_address2."','".$hr_name."','".$img."','".$letterhead_header."','".$letterhead_footer."')"; 	
	    //echo $res; die;
		$qry = mysqli_query($con_exp,$res);
		if($qry){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
			
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}	
	 // Edit Company Name
	/*if(isset($_POST['update']) && $_POST['update']=='editcompany')
	{
		//echo"<pre>";print_r($_POST);die;
		 $id = $_POST['id'];
		 $comp_name = $_POST['comp_name'];
		 $comp_abbr = $_POST['comp_abbr'];	
		 $comp_address = $_POST['comp_address'];	
		 $company_address2 = $_POST['company_address2'];	
		 $hr_name = $_POST['hr_name'];	
		 //$img = $_FILES['comp_logo']['name'];
		// $letterhead = $_FILES['comp_letterhead']['name'];
	 
		if($_FILES['comp_logo']['name']){
			move_uploaded_file($_FILES['comp_logo']['tmp_name'], "upload/".$_FILES['comp_logo']['name']);
			$comp_logo = "upload/".$_FILES['comp_logo']['name'];
		}else{
		    $comp_logo=$_POST['comp_logo'];
		}
		 
		if($_FILES['comp_letterhead_header']['name']){
			move_uploaded_file($_FILES['comp_letterhead_header']['tmp_name'], "upload/".$_FILES['comp_letterhead_header']['name']);
			$letterhead_header = "upload/".$_FILES['comp_letterhead_header']['name'];
	 
		}else{
		    
		    $letterhead_header = $_POST['comp_letterhead_header'];
		    
		}
			if($_FILES['comp_letterhead_footer']['name']){
			move_uploaded_file($_FILES['comp_letterhead_footer']['tmp_name'], "upload/".$_FILES['comp_letterhead_footer']['name']);
			$letterhead_footer = "upload/".$_FILES['comp_letterhead_footer']['name'];
	 
		}else{
		    
		    $letterhead_footer = $_POST['comp_letterhead_footer'];
		    
		}
		$res="UPDATE companies SET comp_name='$comp_name',comp_abbreviation='$comp_abbr',comp_address='$comp_address',company_address2= '$company_address2',hr_name= '$hr_name',comp_logo='$comp_logo',comp_letterhead_header='$letterhead_header',comp_letterhead_footer='$letterhead_footer' WHERE id=$id" ;
		
		$qry = mysqli_query($con_exp,$res);
		if($qry){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
			
		}else{
		$data['status']= 0;
				$data['msg']= "Successfully added thanks";
		}
		echo json_encode($data);	
	}*/
	
	if(isset($_POST['companyUpdate']) && $_POST['companyUpdate']=='editcompany')
	{
		//echo"<pre>";print_r($_POST);print_r($_FILES);die;
		 $id = $_POST['id'];
		 $comp_name = $_POST['comp_name'];
		 $comp_abbr = $_POST['comp_abbr'];	
		// $comp_logo = $_POST['comp_logo'];	
		// $comp_letterhead_header = $_POST['comp_letterhead_header'];	
		// $comp_letterhead_footer = $_POST['comp_letterhead_footer'];	
		// $comp_stamp = $_POST['comp_stamp'];	
		// $salaryslip_stamp = $_FILES['salaryslip_stamp'];	
		 $comp_address = $_POST['comp_address'];	
		 $company_address2 = $_POST['company_address2'];	
		 $hr_name = $_POST['hr_name'];	
		 //$img = $_FILES['comp_logo']['name'];
		// $letterhead = $_FILES['comp_letterhead']['name'];
	 
		if(isset($_FILES['comp_logo'])){
			$comp_logo = "upload/".$_FILES['comp_logo']['name'];
			move_uploaded_file($_FILES['comp_logo']['tmp_name'], $comp_logo);
			
		}else{
		    $comp_logo=$_POST['comp_logo'];
		}
		 
		if(isset($_FILES['comp_letterhead_header'])){
			
			$letterhead_header = "upload/".$_FILES['comp_letterhead_header']['name'];
			move_uploaded_file($_FILES['comp_letterhead_header']['tmp_name'], $letterhead_header);
			
	 
		}else{
		    
		    $letterhead_header = $_POST['comp_letterhead_header'];
		    
		}
			if(isset($_FILES['comp_letterhead_footer'])){
				$letterhead_footer = "upload/".$_FILES['comp_letterhead_footer']['name'];
			move_uploaded_file($_FILES['comp_letterhead_footer']['tmp_name'], $letterhead_footer);
			
	 
		}else{
		    
		    $letterhead_footer = $_POST['comp_letterhead_footer'];
		    
		}
		
		if(isset($_FILES['comp_stamp'])){
			$comp_stamp = "upload/".$_FILES['comp_stamp']['name'];
			move_uploaded_file($_FILES['comp_stamp']['tmp_name'], $comp_stamp);
			
	 
		}else{
		    
		    $comp_stamp = $_POST['comp_stamp'];
		    
		}
		if(isset($_FILES['salaryslip_stamp'])){
			$salaryslip_stamp = "upload/".$_FILES['salaryslip_stamp']['name'];
			move_uploaded_file($_FILES['salaryslip_stamp']['tmp_name'], $salaryslip_stamp);
			
	 
		}else{
		    
		    $salaryslip_stamp = $_POST['salaryslip_stamp'];
		    
		}
		
	 
		$res="UPDATE companies SET comp_name='$comp_name',comp_abbreviation='$comp_abbr',comp_address='$comp_address',company_address2= '$company_address2',hr_name= '$hr_name',comp_logo='$comp_logo',comp_letterhead_header='$letterhead_header',comp_letterhead_footer='$letterhead_footer',comp_stamp='$comp_stamp',salaryslip_stamp='$salaryslip_stamp' WHERE id=$id" ;
	//	echo $res;die;
		$qry = mysqli_query($con_exp,$res);
		//echo "<pre>"; print_r($qry);
		if($qry){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
			
		}else{
		$data['status']= 0;
				$data['msg']= "not successfully added";
		}
		echo json_encode($data);	
	}
	
	
	
	  // Edit stamp
	if(isset($_POST['action']) && $_POST['action']=='addStamp')
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES);
		$id = $_POST['id'];
		$comp_stamp = $_POST['comp_stamp'];	
		
		if($_FILES['comp_stamp']['name']){
			move_uploaded_file($_FILES['comp_stamp']['tmp_name'], "stamp/".$_FILES['comp_stamp']['name']);
			$imgstamp = $_FILES['comp_stamp']['name'];
		}
	    $editStamp="UPDATE companies SET comp_stamp='$imgstamp' WHERE id=$id" ;
		
	    //echo $editStamp; die;
		$qry = mysqli_query($con_exp,$editStamp);
		//echo $qry; die;
		if($qry){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
			
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}
	
	  // Edit salary slips stamp
	if(isset($_POST['action']) && $_POST['action']=='salaryStamp')
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES);
		$id = $_POST['id'];
		$comp_stamp = $_POST['salaryslip_stamp'];	
		
		if($_FILES['salaryslip_stamp']['name']){
			move_uploaded_file($_FILES['salaryslip_stamp']['tmp_name'], "stamp/".$_FILES['salaryslip_stamp']['name']);
			$imgstamp = $_FILES['salaryslip_stamp']['name'];
		}
	    $editStamp="UPDATE companies SET salaryslip_stamp='$imgstamp' WHERE id=$id" ;
		
	    //echo $editStamp; die;
		$qry = mysqli_query($con_exp,$editStamp);
		//echo $qry; die;
		if($qry){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
			
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}
	
	
	// login  Admin
	if(isset($_POST['login']) && $_POST['login'] =="Login" )
	{
	  
	//  echo "<pre>";print_r($_POST);die;
	  $name = $_POST['user_name'];
	  $pass = md5($_POST['user_pass']);
		
		$sql = "SELECT * FROM users WHERE user_name = '$name' and user_pass = '$pass'";
		
		$result = mysqli_query($con_exp, $sql);
		$row = mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
		
		if(($count)>0){	 
			$_SESSION['role'] = $row['role']; 
			$_SESSION['id'] = $row['id']; 
			$_SESSION['name'] = $row['user_name']; 
			//$_SESSION['phone'] = $row['phone']; 
			$_SESSION['email'] =  $row['email']; 
		
			header("location:dashboard.php");
			
		}else{
		  
			header("location:index.php");
		
			
		}
	}
		
	// Change Password 
	
	if(isset($_POST['password']) && $_POST['password']=='changePass')
	{
		
		
		//echo "<pre>"; print_r($_POST); die;
	
		$currentPassword = $_POST['currentPassword'];
		$newPassword = md5($_POST['newPassword']);
		$confirmPassword = $_POST['confirmPassword'];
			//echo $_SESSION["id"];
			if ($currentPassword) {
				$result = mysqli_query($con_exp, "SELECT *from users WHERE id='".$_SESSION["id"]."'");
				
				$row = mysqli_fetch_array($result);
				//echo "<pre>"; print_r($row);  
				if (md5($_POST["currentPassword"]) == $row["user_pass"]) {
					
					//echo "inner";die;
					$sql= "UPDATE users set user_pass='" . md5($_POST["newPassword"]) . "' WHERE id='" . $_SESSION["id"] . "'";
			 
					  mysqli_query($con_exp, $sql);
					 
					
				$data['status']= 1;
				$data['msg']= "Successfully Password changed";
				} else
				$data['status']= 0;
				$data['msg']= "Old passord does not match please currect password";
				//echo "out";die;
					 
			}
			
			echo json_encode($data);	
	}
	
	//******Edit student comapny ******
	
	if(isset($_POST['update']) && $_POST['update']=='studentUpdate')
	{
	 
		//echo "<pre>"; print_r($_POST); die;
		$id = $_POST['id'];
		$emp_company_id = $_POST['emp_company'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$emp_phone = $_POST['emp_phone'];
		$emp_designation = $_POST['emp_designation'];
		$date_joining = $_POST['date_joining'];
		$date_relieving = $_POST['date_relieving'];
		//$emp_joining_pack = $_POST['emp_joining_pack'];
		$emp_id = $_POST['emp_id'];
		
		$paymode = $_POST['paymode'];
		$netpay = $_POST['netpay'];
		$department = $_POST['department'];
		//$ctc1 = $_POST['emp_joining_pack'];
		
		$ctc1 = $_POST['ctc1'];
		$ctc2 = $_POST['ctc2'];
		$newctc = $_POST['newctc'];
		$newdesignation = $_POST['newdesignation'];
		$appraisaldate = $_POST['appraisaldate'];
		//$emp_Issue_appraisaldate = $_POST['emp_Issue_appraisaldate'];
		$slipsyear = $_POST['slipsyear'];
		$month_chk = serialize($_POST['month_chk']);
		
			$status = $_POST['status'];
		
		//$slipsmonth = $_POST['slipsmonth'];
		/* $chk="";  
		foreach($slipsmonth as $chk1)  
		{  
			$chk .= $chk1.",";  
		}   */
		$emp_id = $_POST['emp_id'];
			
        /*	$sqlr = "SELECT * FROM emp_records where id!=".$id." and emp_id='".$emp_id."'";
        $sqlqueryr = mysqli_query($con_exp,$sqlr);
        $checkempid = mysqli_num_rows($sqlqueryr);	
        if($checkempid>0){
        $data['status']= 0;
        $data['msg']= "Employee ID Already Exist !";
        }else{*/
	
			$sqlc = "SELECT * FROM companies where id=".$emp_company_id;
			$sqlqueryc = mysqli_query($con_exp,$sqlc);
			$company = mysqli_fetch_assoc($sqlqueryc);	
			//echo "<pre>"; print_r($company); die;	
			$company_name = $company['comp_name'];
			//echo $company_name; die;
			$update = "UPDATE emp_records SET emp_company_id='$emp_company_id',emp_company='$company_name', emp_name='$name',gender='$gender',address='$address',emp_phone='$emp_phone',emp_designation='$emp_designation',emp_doj='$date_joining',emp_dor='$date_relieving',emp_id='$emp_id',emp_paymode='$paymode',emp_netpay='$netpay',emp_department='$department',emp_ctc1='$ctc1',emp_ctc2='$ctc2',emp_ctc3='$newctc',emp_newdesignation='$newdesignation',emp_appraisaldate='$appraisaldate',emp_slipsyear='$slipsyear',month_chk='$month_chk',status='$status' WHERE id=$id";
			//echo $update; die;
			$qry = mysqli_query($con_exp,$update);
			//echo "<pre>"; print_r($update); die;
		if($qry){
		    
        $data['status']= 1;
        $data['msg']= "Successfully updated";
        }else{
        $data['status']= 0;
        $data['msg']= "Successfully not update";
        }
		
		 
	
		echo json_encode($data);	
	
	}
	
	
	
//************ Add Appraisal Record ***********
	
	if(isset($_POST['appraAction']) && $_POST['appraAction']=='appraSave')
	{
		//echo "<pre>"; print_r($_POST); die;
		$id	= $_POST['id'];
		$emp_id	= $_POST['emp_id'];
		$oldctc = $_POST['oldctc'];	
		$newctc = $_POST['newctc'];
		$appraisaldate = $_POST['appraisaldate'];	
		$newdesignation = $_POST['newdesignation'];	
		$new_dor = $_POST['new_dor'];	
		$month_chk = serialize($_POST['month_chk']);	
		$new_slipsyear = $_POST['new_slipsyear'];	
		$new_netpay = $_POST['new_netpay'];	
		
		$recordresult= "INSERT INTO appraisal_records(record_id,emp_id,oldctc,new_ctc,new_appraisaldate,new_designation,new_dor,new_month_chk,new_slipsyear,new_netpay) VALUES('".$id."','".$emp_id."','".$oldctc."','".$newctc."','".$appraisaldate."','".$newdesignation."','".$new_dor."','".$month_chk."','".$new_slipsyear."','".$new_netpay."')"; 	
	    //echo $recordresult; die;
		$rquery = mysqli_query($con_exp,$recordresult);
		if($rquery){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}
	
	
	//************ Add Date of Relieving Record ***********
	
	if(isset($_POST['dorAction']) && $_POST['dorAction']=='dorSave')
	{
		//echo "<pre>"; print_r($_POST); die;
		$id	= $_POST['id'];
		$emp_id	= $_POST['emp_id'];
		$new_dor = $_POST['new_dor'];	
				
		$recordresult= "INSERT INTO appraisal_records(record_id,emp_id,new_dor) VALUES('".$id."','".$emp_id."','".$new_dor."')"; 	
	    //echo $recordresult; die;
		$rquery = mysqli_query($con_exp,$recordresult);
		if($rquery){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}
	
	
	//************ Add Salary Record ***********
	
	if(isset($_POST['salaryAction']) && $_POST['salaryAction']=='salarySave')
	{
		//echo "<pre>"; print_r($_POST); die;
		$id	= $_POST['id'];
		$emp_id	= $_POST['emp_id'];
		$month_chk = serialize($_POST['month_chk']);	
		$new_slipsyear = $_POST['new_slipsyear'];	
		$new_netpay = $_POST['new_netpay'];	
				
		$recordresult= "INSERT INTO appraisal_records(record_id,emp_id,new_month_chk,new_slipsyear,new_netpay) VALUES('".$id."','".$emp_id."','".$month_chk."','".$new_slipsyear."','".$new_netpay."')"; 	
	    //echo $recordresult; die;
		$rquery = mysqli_query($con_exp,$recordresult);
		if($rquery){
			$data['status']= 1;
				$data['msg']= "Successfully added thanks";
		}else{
		$data['status']= 0;
				$data['msg']= "Insert Data Error";
		}
		echo json_encode($data);	
	}
	
	
	
	
	
	
	
?>