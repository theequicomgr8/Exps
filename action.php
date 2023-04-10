<?php	 
	include "admin/config.php";
	if(isset($_POST['action']))
	{
	
		 $id = $_POST['id'];
		 $name = $_POST['name'];	
		 $gender = $_POST['gender'];	
		 $datebirth = $_POST['datebirth'];	
		 $phone = $_POST['phone'];	
		 $address = $_POST['address'];	
		 $email = $_POST['email'];	
		 $highest = $_POST['highest'];	
		 $passing_year = $_POST['passing_year'];	
		 $exp_year = $_POST['exp_year'];	
		 $exp_month = $_POST['exp_month'];	
		 $date_joining = $_POST['date_joining'];	
		 	
		 $joining_pack = $_POST['joining_pack'];	
		 $current_salary = $_POST['current_salary'];	
		 $annual_package = $_POST['annual_package'];	
		 $current_desig = $_POST['current_desig'];	
		 $desig_joining = $_POST['desig_joining'];	
		 $brief_work = $_POST['brief_work'] ?? '';
		 $current_working=$_POST['current_working'];
		 
		 if($current_working=='1'){
		     $date_relieving='';
		 }else{
		     $date_relieving = $_POST['date_relieving'] ?? '';
		 }
		 
		 
		 
		 if($_POST['id']){
		 
            $res="UPDATE emp_records SET emp_name='$name',gender='$gender',emp_datebirth='$datebirth',emp_phone= '$phone',address= '$address',emp_email='$email',emp_highest='$highest',emp_passing_year='$passing_year',emp_exp_year='$exp_year',emp_exp_month= '$exp_month',emp_doj= '$date_joining',emp_dor='$date_relieving',emp_joining_pack='$joining_pack',emp_current_salary='$current_salary',emp_ctc3='$annual_package',emp_newdesignation='$current_desig',emp_designation='$desig_joining',emp_brief_work='$brief_work',current_working='$current_working' WHERE id=$id" ; 
            
            $qry = mysqli_query($con_exp,$res);
            
            //$fes1=mysqli_query($con,"UPDATE wp_addpayments_details set name='$name',")
            $fes=mysqli_query($con,"UPDATE wp_associate_details set name='$name',email='$email' where mobile='$phone'");
            if($qry){
            $data['status']= 1;
            $data['msg']= "Successfully Update thanks";
            
            }else{
            $data['status']= 0;
            	$data['msg']= "Insert Data Error";
            }
	    }else{
	        
	        /*$find=mysqli_query($con_exp,"select * from emp_records where emp_phone='$phone'");
	        $findqry=mysqli_fetch_array($find);
	        if($findqry){
	            $data['status']= 1;
                $data['msg']= "Successfully added thanks";
	        }else{
	            
	            $res= "INSERT INTO emp_records(emp_name,gender,emp_datebirth,emp_phone,address,emp_email,emp_highest,emp_passing_year,emp_exp_year,emp_exp_month,emp_doj,emp_dor,emp_joining_pack,emp_current_salary,emp_ctc3,emp_newdesignation,emp_designation,emp_brief_work,current_working) VALUES('".$name."','".$gender."','".$datebirth."','".$phone."','".$address."','".$email."','".$highest."','".$passing_year."','".$exp_year."','".$exp_month."','".$date_joining."','".$date_relieving."','".$joining_pack."','".$current_salary."','".$annual_package."','".$current_desig."','".$desig_joining."','".$brief_work."','".$current_working."')"; 
                $qry = mysqli_query($con_exp,$res);
                $fes=mysqli_query($con,"UPDATE wp_associate_details set name='$name',email='$email' where mobile='$phone'");
                if($qry){
                	$data['status']= 1;
                	$data['msg']= "Successfully added thanks";
                	
                }else{
                    	$data['status']= 0;
                		$data['msg']= "Insert Data Error";
                }
	            
	            
	        }*/
	        
	        $res= "INSERT INTO emp_records(emp_name,gender,emp_datebirth,emp_phone,address,emp_email,emp_highest,emp_passing_year,emp_exp_year,emp_exp_month,emp_doj,emp_dor,emp_joining_pack,emp_current_salary,emp_ctc3,emp_newdesignation,emp_designation,emp_brief_work,current_working) VALUES('".$name."','".$gender."','".$datebirth."','".$phone."','".$address."','".$email."','".$highest."','".$passing_year."','".$exp_year."','".$exp_month."','".$date_joining."','".$date_relieving."','".$joining_pack."','".$current_salary."','".$annual_package."','".$current_desig."','".$desig_joining."','".$brief_work."','".$current_working."')"; 
            $qry = mysqli_query($con_exp,$res);
            $fes=mysqli_query($con,"UPDATE wp_associate_details set name='$name',email='$email' where mobile='$phone'");
            if($qry){
            	$data['status']= 1;
            	$data['msg']= "Successfully added thanks";
            	
            }else{
                	$data['status']= 0;
            		$data['msg']= "Insert Data Error";
            }
		    
	    }
		echo json_encode($data);	
	}
	
	
	
?>