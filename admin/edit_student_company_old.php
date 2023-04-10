<?php 
	//session_start();
	include "config.php";
	
?>
<?php
	if(isset($_POST['update']))
	{
		//echo "<pre>"; print_r($_POST); die;
		$id = $_POST['id'];
		$emp_company_id = $_POST['emp_company'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$current_desig = $_POST['current_desig'];
		$date_joining = $_POST['date_joining'];
		$date_relieving = $_POST['date_relieving'];
		$emp_joining_pack = $_POST['emp_joining_pack'];
		$emp_id = $_POST['emp_id'];
		$paymode = $_POST['paymode'];
		$netpay = $_POST['netpay'];
		$department = $_POST['department'];
		$ctc1 = $_POST['ctc1'];
		$ctc2 = $_POST['ctc2'];
		$newctc = $_POST['newctc'];
		$newdesignation = $_POST['newdesignation'];
		$appraisaldate = $_POST['appraisaldate'];
		$slipsyear = $_POST['slipsyear'];
		//$slipsmonth = $_POST['slipsmonth'];
		/* $chk="";  
		foreach($slipsmonth as $chk1)  
		{  
			$chk .= $chk1.",";  
		}   */
		
		    $sqlc = "SELECT * FROM companies where id=".$emp_company_id;
			$sqlqueryc = mysqli_query($con_exp,$sqlc);
			$company = mysqli_fetch_assoc($sqlqueryc);	
			$company_name = $company['comp_name'];
			$update = "UPDATE emp_records SET emp_company_id='$emp_company_id',emp_company='$company_name', emp_name='$name',gender='$gender',address='$address',emp_current_desig='$current_desig',emp_date_joining='$date_joining',emp_date_relieving='date_relieving',emp_joining_pack='$emp_joining_pack',emp_id='$emp_id',emp_paymode='$paymode',emp_netpay='$netpay',emp_department='$department',emp_ctc1='$ctc1',emp_ctc2='$ctc2',emp_ctc3='$newctc',emp_newdesignation='$newdesignation',emp_appraisaldate='$appraisaldate',emp_slipsyear='$slipsyear' WHERE id=$id";
			
			$qry = mysqli_query($con_exp,$update);
			//echo "<pre>"; print_r($update); die;
		if($qry){
			//echo "update succ.";
			echo"<script> window.location.href ='dashboard.php';</script>";
		}else{
			echo "data update error";
		}
		
	}
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Site Title Here</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
        <link rel="stylesheet" href="css/style2.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script>
        $( function() {
        $( "#datepicker" ).datepicker();
        
        } );
        $( function() {
        $( "#datepicker2" ).datepicker();
        
        } );
        $( function() {
        $( "#datepicker3" ).datepicker();
        
        } );
        </script>
    </head> 
    <body>
	<?php include 'header.php';?>
	<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con_exp, "SELECT * FROM emp_records WHERE id=$id");
		//echo "<pre>"; print_r($record); die;
		$row = mysqli_fetch_array($record);
	//	echo "<pre>"; print_r($row); die;	
		  // Create checkboxes
		//$languages_arr = array("PHP","JavaScript","jQuery","AngularJS");
			//foreach($languages_arr as $language){
		
		?>
    
        <div class="myfrom-center">
            <div class="container form-bg-section">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                   
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <form action="" method="POST">
                            <div class="row">
                                
								<div class="col-lg-4">
								    <input type="hidden" name="id" value="<?php echo $row['id'];
                                    <div class="form-group">
                                        <label for="pwd">Company Name</label>	 
										<select class="form-control my-from" name="emp_company">
											<option>---Select subject---</option> 
											<?php 
											$sqlc = "SELECT * FROM companies";
											$sqlqueryc = mysqli_query($con_exp,$sqlc);	
											while($abresult = mysqli_fetch_assoc($sqlqueryc)){  ?>
													
											<option value="<?php echo $abresult['id'];?>"> <?php echo $abresult['comp_name'];?></option>
											<?php }?> 
										</select>
										
                                    </div>
                                </div>
								
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Candidate Name</label>
                                        <input type="text" class="form-control my-from" name="name" value="<?php  echo (isset($row['emp_name'])?$row['emp_name']:"");  ?>">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>
								<div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Gender</label>
										<select class="form-control select-from" id="" name="gender">
                                        <!--<option value=""><?php //if(isset($row['gender'])) {echo $row['gender'];}else{echo "Select Gender";}?></option>-->
                                            <option value="">Select Gender</option>
                                            <option value="Mr." <?php echo (isset($row['gender']) && $row['gender']=='Mr')?"selected":""?> selected>Mr.</option>
                                            <option value="Ms." <?php echo (isset($row['gender']) && $row['gender']=='Ms.')?"selected":""?>>Ms.</option>     
                                        </select>	
                                    </div>
                                </div> 
								 <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="pwd">Address</label>
                                        <input type="text" class="form-control my-from" name="address" value="<?php echo $row['address']; ?>">
                                        <!--<i class="fal fa-graduation-cap"></i>-->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Designation</label>
                                        <input type="text" class="form-control my-from" name="current_desig" value="<?php  echo (isset($row['emp_current_desig'])?$row['emp_current_desig']:"");  ?>">
                                        <i class="fal fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Date Of Joining</label>
                                        <input type="datetime" class="form-control my-from" id="datepicker" name="date_joining" value="<?php  echo (isset($row['emp_date_joining'])?$row['emp_date_joining']:"");  ?>">
                                        <i class="fal fa-calendar-alt"></i>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Date Of Relieving</label>
                                        <input type="datetime" class="form-control my-from" id="datepicker2" name="date_relieving" value="<?php  echo (isset($row['emp_date_relieving'])?$row['emp_date_relieving']:"");  ?>">
                                        <i class="fal fa-calendar-alt"></i>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="pwd">Joining CTC</label>
                                        <input type="datetime" class="form-control my-from" id="Joining_CTC" name="emp_joining_pack" value="<?php  echo (isset($row['emp_joining_pack'])?$row['emp_joining_pack']:"");  ?>">
                                        <i class="fal fa-money-bill-alt"></i>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="pwd">Employee Id</label>
									<input type="datetime" class="form-control my-from" name="emp_id" value="<?php  echo (isset($row['emp_id'])?$row['emp_id']:"");  ?>">
                                        <i class="fal fa-id-badge"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Pay Mode</label>
                                        <select class="form-control select-from" id="" name="paymode">
                                            <option value="">Payment Option</option>
                                            <option value="Phonepe" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Phonepe')?"selected":""?>>Phonepe</option>
                                            <option value="Googlepay" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Googlepay')?"selected":""?>>Googlepay</option>
                                            <option value="Paytm" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Paytm')?"selected":""?>>Paytm</option>
                                            <option value="Cheque" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Cheque')?"selected":""?>>Cheque</option>
                                            <option value="Banking" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Banking')?"selected":""?>>Net Banking</option>
                                            <option value="Cash" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Cash')?"selected":""?>>Cash</option>      
                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Net Pay</label>
                             <input type="datetime" class="form-control my-from" name="netpay" value="<?php  echo (isset($row['emp_netpay'])?$row['emp_netpay']:"");  ?>">
                                        <i class="fal fa-money-bill-alt"></i>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Department</label>
                                        <input type="datetime" class="form-control my-from" name="department" value="<?php  echo (isset($row['emp_department'])?$row['emp_department']:"");  ?>">
                                        <i class="fal fa-user-tag"></i>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-12 mt-3">
                                    <h5  class="ap-details">Appraisal Details</h5>
                                </div>
                                <div class="col-lg-12">
                                    <div class="appraisal-details">
                                        
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">CTC 1</label>
                                                    <input type="text" class="form-control my-from" name="ctc1" value="<?php  echo (isset($row['emp_ctc1'])?$row['emp_ctc1']:"");  ?>">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">CTC 2</label>
                                                    <input type="text" class="form-control my-from" name="ctc2" value="<?php  echo (isset($row['emp_ctc2'])?$row['emp_ctc2']:"");  ?>">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
											<div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">CTC 3</label>
                                                    <input type="text" class="form-control my-from" id="newctc" name="newctc" value="<?php  echo (isset($row['emp_ctc3'])?$row['emp_ctc3']:"");  ?>">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">New Designation</label>
                                                    <input type="text" class="form-control my-from" name="newdesignation" value="<?php  echo (isset($row['emp_newdesignation'])?$row['emp_newdesignation']:"");  ?>">
                                                    <i class="fal fa-graduation-cap"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Appraisal Date</label>
                                                    <input type="datetime" class="form-control my-from" id="datepicker3" name="appraisaldate" value="<?php  echo (isset($row['emp_appraisaldate'])?$row['emp_appraisaldate']:"");  ?>">
                                                    <i class="fal fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Salary Slips Year</label>
                                                    <select class="form-control select-from" id="" name="slipsyear" >
                                                        <!--<option value="">Year</option>-->
                                                        <option value="<?php echo $row['emp_slipsyear'];?>"><?php echo $row['emp_slipsyear'];?></option>
													
														<?php for ($x = 2000; $x <= 2050; $x++){ ?>
														<option value="<?php echo "$x";?>"><?php echo "$x";?></option>	  	
														<?php } ?>
													</select>
													<!--<select class="form-control select-from" id="">
                                                        <option value="">Year</option>
                                                        <option>2000</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                        <option>2018</option>
                                                        <option>2019</option>
                                                        <option>2020</option>
                                                        <option>2021</option>
                                                        
                                                    </select>-->
                                                </div>
                                            </div>
                                            <!--<div class="col-lg-9">
                                                <div class="mt-10">
                                                    <ul class="list-calender" name="slipsmonth">-->
                                                        <!--<li><input type="checkbox" value="January" <?php// echo (isset($row['emp_slipsmonth']) && $row['emp_slipsmonth']=='January')?"selected":""?> name="month_chk[]" />Jan</li>
                                                        <li><input type="checkbox" value="February" name="month_chk[]" />Feb</li>
                                                        <li><input type="checkbox" value="March" name="month_chk[]" />Mar</li>
                                                        <li><input type="checkbox" value="April" name="month_chk[]" />Apr</li>
                                                        <li><input type="checkbox" value="May" name="month_chk[]" />May</li>
                                                        <li><input type="checkbox" value="June" name="month_chk[]" />Jun</li>
                                                        <li><input type="checkbox" value="July" name="month_chk[]" />Jul</li>
                                                        <li><input type="checkbox" value="August" name="month_chk[]" />Aug</li>
                                                        <li><input type="checkbox" value="September" name="month_chk[]" />Sep</li>
                                                        <li><input type="checkbox" value="October" name="month_chk[]" />Oct</li>
                                                        <li><input type="checkbox" value="November" name="month_chk[]" />Nov</li>
                                                        <li><input type="checkbox" value="December" name="month_chk[]"/>Dec</li>-->
														<!--<li><input type="checkbox" value="January" name="slipsmonth[]" />Jan</li>
                                                        <li><input type="checkbox" value="February" name="month_chk[]" />Feb</li>
                                                        <li><input type="checkbox" value="March" name="slipsmonth[]" />Mar</li>
                                                        <li><input type="checkbox" value="April" name="slipsmonth[]" />Apr</li>
                                                        <li><input type="checkbox" value="May"  name="slipsmonth[]" />May</li>
                                                        <li><input type="checkbox" value="June" name="slipsmonth[]" />Jun</li>
                                                        <li><input type="checkbox" value="July" name="slipsmonth[]" />Jul</li>
                                                        <li><input type="checkbox" value="August" name="slipsmonth[]" />Aug</li>
                                                        <li><input type="checkbox" value="September" name="slipsmonth[]" />Sep</li>
                                                        <li><input type="checkbox" value="October" name="slipsmonth[]" />Oct</li>
                                                        <li><input type="checkbox" value="November" name="slipsmonth[]" />Nov</li>
                                                        <li><input type="checkbox" value="December" name="slipsmonth[]" />Dec</li>-->
                                                    <!--</ul>
                                                </div>
											</div>-->
										</div>	
									</div>
									<div class="download-section mt-3">
										<div class="container">
											<div class="row">
												<div class="col-lg-12 text-center">
													<button class=" btn btn-success" name="update">Update</button>
												</div>
											</div>
										</div>  
									</div>
                                </div>
                            </div>
                        </form>
                        <!--<div class="download-btn-list mt-3">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="letter-download">
                                        
                                        <button class="green btn-letter">Appointment Letter</button>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="letter-download">
                                        
                                        <button class="green btn-letter">Appraisal Letter</button>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="letter-download">
                                        
                                        <button class="btn-letter">Experience Letter</button>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="letter-download">
                                        
                                        <button class="btn-letter">Salary Slips</button>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="download-section mt-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6 text-center">
                                            <button class="btn-blue">Download Letterhead</button>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <button class=" btn-blue">Download Plain Paper</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>-->
                    </div>
                    <div class="col-lg-3">
                        <div class="right-img">
                            <img src="img/right-bg.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 	 } ?>		
        <!-- JS here -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>