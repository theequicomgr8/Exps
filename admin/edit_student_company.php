<!doctype html>
<?php 
 $title = 'Edit Student Company'; 
	//session_start();
	include "config.php";
	
?>
<?php
	if(isset($_POST['update']))
	{
	//	echo "<pre>"; print_r($_POST); die;
		$id = $_POST['id'];
		$emp_company_id = $_POST['emp_company'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$emp_phone = $_POST['emp_phone'];
		$current_desig = $_POST['current_desig'];
		$date_joining = $_POST['emp_doj'];
		$date_relieving = $_POST['emp_dor'];
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
			//echo "<pre>"; print_r($company); die;	
			$company_name = $company['comp_name'];
			//echo $company_name; die;
			$update = "UPDATE emp_records SET emp_company_id='$emp_company_id',emp_company='$company_name', emp_name='$name',gender='$gender',address='$address',emp_phone='$emp_phone',emp_current_desig='$current_desig',emp_doj='$date_joining',emp_dor='$date_relieving',emp_joining_pack='$emp_joining_pack',emp_id='$emp_id',emp_paymode='$paymode',emp_netpay='$netpay',emp_department='$department',emp_ctc1='$ctc1',emp_ctc2='$ctc2',emp_ctc3='$newctc',emp_newdesignation='$newdesignation',emp_appraisaldate='$appraisaldate',emp_slipsyear='$slipsyear' WHERE id=$id";
			
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


	<?php include 'header.php';?>
	<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con_exp, "SELECT * FROM emp_records WHERE id=$id");
		//echo "<pre>"; print_r($record); die;
		$row = mysqli_fetch_assoc($record);
		//echo "<pre>"; print_r($row); die;	
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
                        <form  method="POST" class="registraUpdate" autocomplete="off">
                            <div class="row">
								<div class="col-lg-4">
								<input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    <div class="form-group">
                                        <?php 
											$sqlc = "SELECT * FROM companies";
											$sqlqueryc = mysqli_query($con_exp,$sqlc);	?>
                                        <label for="pwd">Company Name</label>	 
										<select class="form-control my-from" name="emp_company">
											<option value="">Select Company</option> 
											<?php 
											while($abresult = mysqli_fetch_assoc($sqlqueryc)){  ?>
													
											<option value="<?php echo $abresult['id'];?>"  <?php if(isset($abresult['id']) && $abresult['id']==$row['emp_company_id'] ){ echo "selected"; } ?>> <?php echo $abresult['comp_name'];?></option>
											<?php }?> 
										</select>
										
                                    </div>
                                </div>
							    <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Title</label>
										<select class="form-control select-from" id="" name="gender">
                                        <!--<option value=""><?php //if(isset($row['gender'])) {echo $row['gender'];}else{echo "Select Gender";}?></option>-->
                                            <option value="">Select Title</option>
                                            <option value="Mr." <?php echo (isset($row['gender']) && $row['gender']=='Mr')?"selected":""?> selected>Mr.</option>
                                            <option value="Ms." <?php echo (isset($row['gender']) && $row['gender']=='Ms')?"selected":""?>>Ms.</option>     
                                        </select>	
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Candidate Name</label>
                                        <input type="text" class="form-control my-from" name="name" value="<?php  echo (isset($row['emp_name'])?$row['emp_name']:"");  ?>" placeholder="Eneter Name" >
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>
							
								 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Address</label>
                                        <input type="text" class="form-control my-from" name="address" value="<?php echo $row['address']; ?>" placeholder="Eneter Address">
                                        <!--<i class="fal fa-graduation-cap"></i>-->
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Contact no.</label>
                                        <input type="text" class="form-control my-from" name="emp_phone" value="<?php echo (isset($row['emp_phone'])?$row['emp_phone']:""); ?>" placeholder="Eneter Phone no." >
                                        <!--<i class="fal fa-graduation-cap"></i>-->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Designation</label>
                                        <input type="text" class="form-control my-from" name="emp_designation" value="<?php  echo (isset($row['emp_designation'])?$row['emp_designation']:"");  ?>" placeholder="Eneter Designation">
                                        <i class="fal fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Date Of Joining</label>
                                        <input type="datetime" class="form-control my-from" id="datepicker" name="date_joining" value="<?php  echo (isset($row['emp_doj'])?$row['emp_doj']:"");  ?>" placeholder="Eneter Joining Date" >
                                        <i class="fal fa-calendar-alt"></i>
                                        
                                    </div>
                                </div>
                                
                                <!--<div class="col-lg-4">
                                    <div class="form-group">
										 <label for="pwd">Date Of Relieving</label>&nbsp;</br>
											<input class="form-check-input" type="radio" name="date_relieving" id="hide" checked>
												<label class="form-check-label">
													&nbsp; &nbsp; &nbsp;Currently Working &nbsp;&nbsp;&nbsp;&nbsp;
												</label>
											<input class="form-check-input" type="radio" name="date_relieving" id="show">
												<label class="form-check-label">
													&nbsp;&nbsp;&nbsp;&nbsp; Calender 
												</label>
                                    </div>
								</div>-->
								<?php 
								if($row['current_working']=='1'){
								    $display="none";
								    $display1='';
								}else if($row['current_working']=='0'){
								    $display='';
								    $display1='none';
								}else{
								    $display='';
								    $display1='none';
								}
								
								?>
                                <div class="col-lg-4" style="display:<?php echo $display; ?>">
                                    <div class="form-group">
                                        <label for="pwd">Date Of Relieving</label>
                                        <input type="datetime" class="form-control my-from disableFuturedate"  name="date_relieving" value="<?php  echo (isset($row['emp_dor'])?$row['emp_dor']:"");  ?>" placeholder="Eneter Relieving Date" >
                                        <i class="fal fa-calendar-alt"></i>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-lg-4" style="display:<?php  echo $display1; ?>"><br>
                                    <div class="form-group">
                                        
                                        <label>Current Working</label>  <input type="radio" name="current_working" class="working" id="cur1" value="1" checked>
                                        <!--<label>Last Working Day<label> <input type="radio" name="current_working" class="working" id="cur0" value="0">-->
                                    </div>
                                </div>
                                
                                
                                <!--<div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="pwd">Joining CTC</label>
                                        <input type="datetime" class="form-control my-from" id="Joining_CTC" name="emp_joining_pack" value="<?php  echo (isset($row['emp_joining_pack'])?$row['emp_joining_pack']:"");  ?>" placeholder="Eneter Joining Package CTC" onkeypress="return isNumberKey(event);">
                                        <i class="fal fa-money-bill-alt"></i>
                                        
                                    </div>
                                </div>-->
                                <div class="col-lg-4">
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
                                            
                                            <option value="Cheque" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Cheque')?"selected":"" ?>>Cheque</option>
                                            
                                            <option value="Cash" <?php echo (isset($row['emp_paymode']) && $row['emp_paymode']=='Cash')?"selected":"" ?>>Cash</option>      
                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Net Pay</label>
                             <input type="datetime" class="form-control my-from" name="netpay" value="<?php  echo (isset($row['emp_current_salary'])?$row['emp_current_salary']:"");  ?>" placeholder="Enter Net Pay" onkeypress="return isNumberKey(event);">
                                        <i class="fal fa-money-bill-alt"></i>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pwd">Department</label>
                                        <input type="datetime" class="form-control my-from" name="department" value="<?php  echo (isset($row['emp_department'])?$row['emp_department']:"");  ?>" placeholder="Enter Department">
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
                                                    <input type="text" class="form-control my-from" name="ctc1" value="<?php  echo (isset($row['emp_joining_pack'])?$row['emp_joining_pack']:"");  ?>" placeholder="Enter Joining CTC" onkeypress="return isNumberKey(event);">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">CTC 2</label>
                                                    <input type="text" class="form-control my-from" name="ctc2" value="<?php  echo (isset($row['emp_ctc2'])?$row['emp_ctc2']:"");  ?>" placeholder="Enter  CTC" onkeypress="return isNumberKey(event);">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
											<div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">CTC 3</label>
                                                    <input type="text" class="form-control my-from" id="newctc" name="newctc" value="<?php  echo (isset($row['emp_ctc3'])?$row['emp_ctc3']:"");  ?>" placeholder="Enter Current CTC" onkeypress="return isNumberKey(event);">
                                                    <i class="fal fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">New Designation</label>
                                                    <input type="text" class="form-control my-from" name="newdesignation" value="<?php  echo (isset($row['emp_newdesignation'])?$row['emp_newdesignation']:"");  ?>" placeholder="Enter New Designation" >
                                                    <i class="fal fa-graduation-cap"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Appraisal Date</label>
                                                    <input type="datetime" class="form-control my-from" id="datepicker3" name="appraisaldate" value="<?php  echo (isset($row['emp_appraisaldate'])?$row['emp_appraisaldate']:"");  ?>" placeholder="Enter Appraisal Date">
                                                    <i class="fal fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <!--<div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Appraisal Issue Date</label>
                                                    <input type="datetime" class="form-control my-from" id="datepicker4" name="emp_Issue_appraisaldate" value="<?php // echo (isset($row['emp_Issue_appraisaldate'])?$row['emp_Issue_appraisaldate']:"");  ?>" placeholder="Enter Issue Appraisal Date">
                                                    <i class="fal fa-calendar-alt"></i>
                                                </div>
                                            </div>-->
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Salary Slips Year</label>
                                                    <select class="form-control select-from"  name="slipsyear" >
                                                        <option value="">Select Year</option> 
                                                   	<?php for ($x = 2025; 2000 <= $x; $x--){ ?>
														<option value="<?php echo "$x";?>" <?php if(isset($x) && $x==$row['emp_slipsyear'] ){ echo "selected"; } ?>><?php echo "$x";?></option>	  	
														<?php } ?>
													</select>
												 
                                                </div>
                                            </div>
                                              <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="pwd">Approved</label>
                                                    <select class="form-control select-from" name="status" >
                                                        <option value="">Select Status</option> 
                                                        <option value="0" <?php if(isset($row['status']) && 0==$row['status'] ){ echo "selected"; } ?>>Reject</option>
													
													 
														<option value="1" <?php if(isset($row['status']) && 1==$row['status'] ){ echo "selected"; } ?>>Approved</option>	  	
														 
													</select>
												 
                                                </div>
                                            </div>
                                         <div class="col-lg-9">
                                                <div class="mt-10">
                                                    <ul class="list-calender">
                                                        <?php  //echo "<pre>";print_r(unserialize($row['month_chk']));
                                                       
                                                         $month_chk = unserialize($row['month_chk']);
                                                         $monthkey=[];
                                                        if(!empty($month_chk)){
                                                             
                                                            foreach($month_chk as $key=>$val){
                                                                 $monthkey[$val]=$val;
                                                            }
                                                        }
                                                        $montharray =array('January','February','March','April','May','June','July','August','September','October','November','December');
                                                       
                                                        foreach($montharray as $keym=>$keyv){
                                                          //echo "<pre>";print_r($monthkey);
                                                      
                                                       if(array_key_exists($keyv, $monthkey)){
                                                        ?>
                                                        
                                                       <li><input type="checkbox" value="<?php echo $keyv; ?>"  checked name="month_chk[]" /><?php echo substr($keyv,0,3); ?></li>
                                                   <?php }else{ ?>
                                                   
                                                   <li><input type="checkbox" value="<?php echo $keyv; ?>"  name="month_chk[]" /><?php echo substr($keyv,0,3); ?></li>
                                                   
                                                   <?php } }  ?>
                                                       
                                                     <!--   <li><input type="checkbox" value="February" name="month_chk[]" />Feb</li>
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
														
                                                    </ul>
                                                </div>
											</div>
										</div>	
									</div>
									<div class="download-section mt-3">
										<div class="container">
											<div class="row">
												<div class="col-lg-12 text-center">
												    <input type="hidden" name="update" value="studentUpdate"/>
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


 
 <?php include 'footer.php';?>
 
 
    <script>
       /* $(document).ready(function(){
           
          $("#hide").click(function(){
               alert('test');
            $("#relieving").hide();
          });
          $("#show").click(function(){
            $("#relieving").show();
          });
          
        	$('.end-date').datepicker(
        		{
        			dateFormat: 'yy-mm-dd',							 
        			maxDate:0,						 
        			beforeShow: function() {
        				$(this).datepicker('option', 'minDate', $('#start-date').val());
        				$(this).datepicker('option', 'maxDate', $('.end-date').val());						 
        				if($('#start-date').val() === '') $(this).datepicker('option', 'maxDate', 0); }
        		});
        });*/
    </script>
 
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
         $( function() {
        $( "#datepicker4" ).datepicker();
        
        } );
        </script>
<script>
$(".registraUpdate").submit(function(e){ 
	e.preventDefault();	 
 
	if(!$.fn.registrvalidate(this)){		 
		return false;	
	}   
	var data=$(this).serialize();
		$.ajax({
			 url: "action.php",
			data: data,
			type:"POST",			 
			success:function(response){
			   
		 			 var obj = JSON.parse(response);
				if(obj.status){
                    $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    //$('#successmessage').modal({backdrop:"static",keyboard:false});
                    setTimeout(function(){
                        window.location.href = "https://exps.cromacampus.com/admin/dashboard.php";    
                    }, 3000);
                    
                    $this.find('.valid_error').remove();
				}else{
				$("#successmessage").modal('show');
			
					$("#successmessage .successhtml").html('');
				$('.imgclass').html('<img src="./img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
				$('.failedhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
				$('#successmessage').modal({backdrop:"static",keyboard:false});
				}
			}
		});
});
$.fn.registrvalidate=function(t){
	$(".valid_error").remove(); 
	 
	var status = 0;	 
	
	if($(t).find("select[name=\"emp_company\"]").length==1 && $(t).find("select[name=\"emp_company\"]").val()==""){
		$(t).find("select[name=\"emp_company\"]").after("<div class='valid_error'>Select Company Name.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"name\"]").length==1 && $(t).find("input[name=\"name\"]").val()==""){
		$(t).find("input[name=\"name\"]").after("<div class='valid_error'>Name is mandatory.</div>")
		status = 1;
	}
	
	 if($(t).find("input[name=\"datebirth\"]").length==1 && $(t).find("input[name=\"datebirth\"]").val()==""){
		$(t).find("input[name=\"datebirth\"]").after("<div class='valid_error'>Date of Birth is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"emp_phone\"]").length==1 && $(t).find("input[name=\"emp_phone\"]").val()==""){
		$(t).find("input[name=\"emp_phone\"]").after("<div class='valid_error'>Contact Number is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"address\"]").length==1 && $(t).find("input[name=\"address\"]").val()==""){
		$(t).find("input[name=\"address\"]").after("<div class='valid_error'>Address is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"email\"]").length==1 && $(t).find("input[name=\"email\"]").val()==""){
		$(t).find("input[name=\"email\"]").after("<div class='valid_error'>Email Address is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"highest\"]").length==1 && $(t).find("input[name=\"highest\"]").val()==""){
		$(t).find("input[name=\"highest\"]").after("<div class='valid_error'>Highest qualification is mandatory.</div>")
		status = 1;
	}
	if($(t).find("select[name=\"passing_year\"]").length==1 && $(t).find("select[name=\"passing_year\"]").val()==""){
		$(t).find("select[name=\"passing_year\"]").after("<div class='valid_error'>Qualification Passing Year is mandatory.</div>")
		status = 1;
	} 
	if($(t).find("select[name=\"exp_year\"]").length==1 && $(t).find("select[name=\"exp_year\"]").val()==""){
		$(t).find("select[name=\"exp_year\"]").after("<div class='valid_error'>Experience Year is mandatory.</div>")
		status = 1;
	}
// 	if($(t).find("select[name=\"exp_month\"]").length==1 && $(t).find("select[name=\"exp_month\"]").val()==""){
// 		$(t).find("select[name=\"exp_month\"]").after("<div class='valid_error'>Experience Month is Mandatory.</div>")
// 		status = 1;
// 	}
	if($(t).find("input[name=\"date_joining\"]").length==1 && $(t).find("input[name=\"date_joining\"]").val()==""){
		$(t).find("input[name=\"date_joining\"]").after("<div class='valid_error'>Date Joining is Mandatory.</div>")
		status = 1;
	}
// 	if($(t).find("input[name=\"date_relieving\"]").length==1 && $(t).find("input[name=\"date_relieving\"]").val()==""){
// 		$(t).find("input[name=\"date_relieving\"]").after("<div class='valid_error'>Date Relieving is Mandatory.</div>")
// 		status = 1;
// 	}
	if($(t).find("input[name=\"emp_id\"]").length==1 && $(t).find("input[name=\"emp_id\"]").val()==""){
		$(t).find("input[name=\"emp_id\"]").after("<div class='valid_error'>Employee ID is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"current_salery\"]").length==1 && $(t).find("input[name=\"current_salery\"]").val()==""){
		$(t).find("input[name=\"current_salery\"]").after("<div class='valid_error'>Current Salery is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"annual_package\"]").length==1 && $(t).find("input[name=\"annual_package\"]").val()==""){
		$(t).find("input[name=\"annual_package\"]").after("<div class='valid_error'>Current Salery is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"current_desig\"]").length==1 && $(t).find("input[name=\"current_desig\"]").val()==""){
		$(t).find("input[name=\"current_desig\"]").after("<div class='valid_error'>Current Designation is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"desig_joining\"]").length==1 && $(t).find("input[name=\"desig_joining\"]").val()==""){
		$(t).find("input[name=\"desig_joining\"]").after("<div class='valid_error'>Designation Joining is Mandatory.</div>")
		status = 1;
	}
	
	if($(t).find("input[name=\"emp_joining_pack\"]").length==1 && $(t).find("input[name=\"emp_joining_pack\"]").val()==""){
		$(t).find("input[name=\"emp_joining_pack\"]").after("<div class='valid_error'>Joining package is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"netpay\"]").length==1 && $(t).find("input[name=\"netpay\"]").val()==""){
		$(t).find("input[name=\"netpay\"]").after("<div class='valid_error'>Net pay is Mandatory.</div>")
		status = 1;
	}
	
	if($(t).find("input[name=\"department\"]").length==1 && $(t).find("input[name=\"department\"]").val()==""){
		$(t).find("input[name=\"department\"]").after("<div class='valid_error'>Department is Mandatory.</div>")
		status = 1;
	}
    if($(t).find("input[name=\"ctc1\"]").length==1 && $(t).find("input[name=\"ctc1\"]").val()==""){
		$(t).find("input[name=\"ctc1\"]").after("<div class='valid_error'>ctc 1 is Mandatory.</div>")
		status = 1;
	}
	
	if($(t).find("input[name=\"ctc2\"]").length==1 && $(t).find("input[name=\"ctc2\"]").val()==""){
		$(t).find("input[name=\"ctc2\"]").after("<div class='valid_error'>ctc2 is Mandatory.</div>")
		status = 1;
	}
	
	if($(t).find("input[name=\"newctc\"]").length==1 && $(t).find("input[name=\"newctc\"]").val()==""){
		$(t).find("input[name=\"newctc\"]").after("<div class='valid_error'>New ctc 3 is Mandatory.</div>")
		status = 1;
	}
		if($(t).find("input[name=\"newdesignation\"]").length==1 && $(t).find("input[name=\"newdesignation\"]").val()==""){
		$(t).find("input[name=\"newdesignation\"]").after("<div class='valid_error'>New Designation is Mandatory.</div>")
		status = 1;
	}
	/*
		if($(t).find("input[name=\"appraisaldate\"]").length==1 && $(t).find("input[name=\"appraisaldate\"]").val()==""){
		$(t).find("input[name=\"appraisaldate\"]").after("<div class='valid_error'>Appraisal date is Mandatory.</div>")
		status = 1;
	}
	*/
		if($(t).find("input[name=\"emp_Issue_appraisaldate\"]").length==1 && $(t).find("input[name=\"emp_Issue_appraisaldate\"]").val()==""){
		$(t).find("input[name=\"emp_Issue_appraisaldate\"]").after("<div class='valid_error'>Issue Appraisal date is Mandatory.</div>")
		status = 1;
	}
	
	
	
	if($(t).find("textarea[name=\"brief_work\"]").length==1 && $(t).find("textarea[name=\"brief_work\"]").val()==""){
		$(t).find("textarea[name=\"brief_work\"]").after("<div class='valid_error'> Brief Explanation is Mandatory.</div>")
		status = 1;
	}
		 
	
	if(status){
		return false;
	}
	return true;
}
function isNumberKey(e){
var keyCode = e.keyCode || e.charCode;
if(keyCode>=48&&keyCode<=57)
return true;
else
return false;
}


</script>

<script>
   $(document).ready(function () {
      var currentDate = new Date();
      $('.disableFuturedate').datepicker({
      format: 'dd/mm/yyyy',
      autoclose:true,
      endDate: "currentDate",
      maxDate: currentDate
      }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
      });
      $('.disableFuturedate').keyup(function () {
         if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
         }
      });
   });
</script>


        


    </body>
</html>