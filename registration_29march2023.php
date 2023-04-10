<?php
	session_start();
	//include "config.php";
//	error_reporting(0);
?>
<script type="text/javascript">
</script>
<?php 
	$messages = array(
	'err_1'  => '<strong>Does not Insert Data Successfully</strong> ',
	'succ_1' => 'Student Registered Successfully.',
);
?>
<?php
	$con = mysqli_connect("103.53.40.64","cromag8l_fees","cromag8l_fees@23#","cromag8l_fees") or die("Could not connect.");
	$sqly = "SELECT * FROM wp_associate_details where mobile = '".$_SESSION['mobile']."'";
 
	$sqlquery = mysqli_query($con,$sqly);
	$rowyear = mysqli_fetch_assoc($sqlquery);
	$con_exp = mysqli_connect("103.53.40.64","cromag8l_exps","cromag8l_exps","cromag8l_exps") or die("Could not connect.");
	$sqlexp = "SELECT * FROM emp_records where emp_phone = '".$_SESSION['mobile']."'";
	$sqlqueryexp = mysqli_query($con_exp,$sqlexp);
	$row = mysqli_fetch_assoc($sqlqueryexp);
	
?>
   
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Registration</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
       <style>
	   .valid_error{
		   color:red;
		   font-size: 10px;
	   }
	   .mybtn2{
	       margin-right: -186px !important;
	   }
       </style>
    </head>
    <body>

<div class="myfrom-center1">
    <div class="container">
        <div class="row form-bg-section2" >
            <div class="col-lg-12">
                <span style="float: right;"><a href="logout.php" class="btn btn-warning" style="padding: 4px 15px;">Logout</a></span>
            </div>
		    <div class="col-lg-9">
                <form id="form"  method="post" class="registraSave" autocomplete="off">
                    <div class="row">
                        <input type="hidden" name="id" readonly value="<?php if(!empty($row['id'])){ echo $row['id']; } ?>">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="pwd">Title</label>
									<select class="form-control select-from" id="title" name="gender">
										<option value="" >Select Title</option>
										<option value="Mr" <?php echo (isset($row['gender']) && $row['gender']=='Mr')?"selected":""?> >Mr.</option>
										<option value="Ms" <?php echo (isset($row['gender']) && $row['gender']=='Ms')?"selected":""?>>Ms.</option>     
									</select>	
								</div>
							</div> 
                            <div class="col-lg-3">
                                
                            <div class="form-group">
                              <label for="email">Full Name</label>
                              <input type="text" class="form-control my-from" id="name"  name="name" readonly1 value="<?php echo $rowyear['name']; ?>">
                            </div>
							</div>
						
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Date of Birth</label>
                                <input type="text" class="form-control my-from disableFuturedate" id="datebirth" placeholder="DD-Month-Year" name="datebirth" value="<?php if(!empty($row['emp_datebirth'])){ echo $row['emp_datebirth']; } ?>">
                               
                              </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="pwd">Contact Number</label>
                            <input type="text" class="form-control my-from" id="contact"  name="phone" readonly onkeypress="return isNumberKey(event);" maxlength="7" value="<?php if(isset($_SESSION['mobile'])){ echo $_SESSION['mobile']; }else { echo (isset($_POST['mobile'])?$_POST['mobile']:""); } ?>">
                          </div>
                          </div>
          
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Address of Correspondence </label>
                               
                                <input type="text" class="form-control my-from" id="addressd" name="address" placeholder="Enter Address" value="<?php if(!empty($row['address'])){ echo $row['address']; } ?>"">
                              </div>
                              </div>
                         
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Email Address</label>
                                <input type="email" class="form-control " id="email"  name="email" readonly1 value="<?php echo $rowyear['email'];?>">
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Highest Qualification </label>
                               
									 
									<input type="text" class="form-control" id="highestd" name="highest" placeholder="Enter Qualification" value="<?php if(!empty($row['emp_highest'])){ echo $row['emp_highest']; } ?>">
									 
								</div>
							</div>  
							<div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Passing Year</label>
									<select name="passing_year" id="passyeard" class="form-control my-from">
										<option value="">Select Year</option>
											<?php  
												for ($x = 2001; $x <= 2022; $x++) {	?>
											<option value="<?php echo $x; ?>" <?php echo (isset($row['emp_passing_year']) && $row['emp_passing_year']==$x)?"selected":""?>><?php echo " $x <br>";?> </option>
											<?php	} ?>		
									</select>
									 
								</div>
							</div>
                              <div class="col-lg-3">
								<div class="form-group">
									<label for="pwd">How Many Year of Experience</label>
									
									<input type="text" class="form-control my-from" name="exp_year" readonly value="<?php echo $rowyear['exp_req'];?>">				
											
									
								</div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
									<label for="pwd">Months of Experience</label>
									<select name="exp_month" class="form-control my-from" id="monthexd">
										<option value="">Select Months</option>
										<?php  
										for ($x = 1; $x <= 11; $x++) {	?>
										<option value="<?php echo $x ;?>" <?php echo (isset($row['emp_exp_month']) && $row['emp_exp_month']==$x)?"selected":""?>><?php echo " $x <br>";?> </option>
										<?php	} ?>			
									</select>
								</div>
                              </div>
							  
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="pwd">Date of Joining </label>
                                          
                                            <input type="datetime" class="form-control my-from disableFuturedate" id="datejoin" placeholder="DD-Month-Year" name="date_joining" value="<?php if(!empty($row['emp_doj'])){ echo $row['emp_doj']; } ?>">
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        
                                        <label>Current Working</label>  <input type="radio" name="current_working" class="working" value="1"  <?php echo $row['current_working']=='1' ? 'checked' : ''  ?>><br>
                                        <label>Last Working Day</label> <input type="radio" name="current_working" class="working" value="0" <?php echo $row['current_working']=='0' ? 'checked' : ''  ?> >
                                    </div>
                                </div>
                                
                                <?php 
                                if($row['current_working']=='0'){
                                    $display='';
                                }else if($row['current_working']=='1'){
                                    $display='none';
                                }else{
                                    $display='none';
                                }
                                
                                ?>
                                
                                <div class="col-lg-3 last_work" style="display:<?php echo $display ?>;">
                                    <div class="form-group">
                                        <label for="pwd">Date of Relieving </label>
                                        
                                        <input type="datetime" class="form-control my-from disableFuturedate" id="datereli"  placeholder="DD-Month-Year" name="date_relieving" value="<?php if(!empty($row['emp_dor'])){ echo $row['emp_dor']; } ?>">
                                    </div>
                                </div>
                    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pwd"> Package at the time of Joining</label>
                                        
                                        <input type="text" class="form-control my-from" name="joining_pack" id="joiningPackd" onkeypress="return isNumberKey(event);" maxlength="7" placeholder="Enter Joining Package" value="<?php if(!empty($row['emp_joining_pack'])){ echo $row['emp_joining_pack']; } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="pwd">Current Month Salary </label>
                                        
                                        <input type="text" class="form-control my-from"  name="current_salary" id="monthSalaryd" onkeypress="return isNumberKey(event);" maxlength="7" onblur="addAannualPackage()" placeholder="Enter Current Month Salary" value="<?php if(!empty($row['emp_current_salary'])){ echo $row['emp_current_salary']; } ?>">
                                    </div>
                                </div>
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Annual Packages </label>
                                
                                <input type="text" class="form-control my-from" name="annual_package" id="annualPackd" placeholder="Enter Annual Package" onkeypress="return isNumberKey(event);" maxlength="7" value="<?php if(!empty($row['emp_annual_package'])){ echo $row['emp_annual_package']; }else if($_POST['annual_package']){ echo $_POST['annual_package']; } ?>" readonly>
                              </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Designation at the Time of Joining</label>
                                <!--<i class="fal fa-graduation-cap"></i>-->

                                <input type="text" class="form-control my-from"  name="desig_joining" id="desiJoiningd" placeholder="Enter Designation Joining" value="<?php if(!empty($row['emp_designation'])){ echo $row['emp_designation']; } ?>">
                              </div>
                              </div>
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Current Designation</label>
                                <!--<i class="fal fa-graduation-cap"></i>-->
                                <input type="text" class="form-control my-from" name="current_desig" id="currentDesid" placeholder="Enter Current Designation" value="<?php if(!empty($row['emp_newdesignation'])){ echo $row['emp_newdesignation']; } ?>">
                              </div>
                              </div>
                              
                              <div class="col-lg-12" style="display:none;">
                                <div class="form-group">
                                    <label for="pwd">Give A Brief Explanation About Your work</label>
                                
                                    <textarea  name="brief_work" cols="100" rows="1" id="briefWorkd" placeholder="Enter Explanation Your work (Optional)"><?php if(!empty($row['emp_brief_work'])){ echo $row['emp_brief_work']; } ?></textarea>
                              </div>
                              </div>

                            </div><br><br>
                            <div class="col-lg-12 text-left">
                              <div class="mybtn mybtn2">
							  <input type="hidden" name="action" value="registraSave" />
                                <button type="submit" class="btn btn-primary" id="registrationsub" name="submit">Submit</button>&nbsp;
                                  
								<a href="javascript:void(0);" class="btn btn-primary previewvalue"  onclick="previewvalue();" data-toggle="modal" data-target="#exampleModal">Preview</a>
								
								
								
                              </div>
                            </div>
                          </form>
                    </div>
               

                <div class="col-lg-3 text-center myheight">
                    <img src="img/registration-form-bg.png" alt="" class="img-fluid">

                </div>
			
                <div class="col-lg-12">
                    <div class="note-form">
                        <h2>Please Read Carefully:</h2>
        <div class="point-notes">
            <ul>
            <strong><li>15 Days Amount of CTC will be paid at the time of Acceptance of resignation / Relieving Letter / Verification.
        </li></strong>
                <li>Please email these Documents at BGC@live.in only any email address, we will not consider.</li>
                <li>To Know the Status of your Experience Letter or any other Query, Please write us at BGC@live.in only, do not call on phone.
                </li>
                <li>Please Fill The Form Carefully, we will Process your Documents Based on the above information, no changes will be done once your documents are ready.
                </li>
                <li>Collect your Experience Letter within 90 Days from the date of Payment else the hard copy of your Document will be destroyed by the company /
                    Croma Campus and no query will be entertained in regards payment /  documents.</li>
        
            </ul>
        </div>
			</div>
           </div>
        </div>


   
</div>
</div>
 

<script>
function previewvalue(){
  $('#titled').val($('#title option:selected').val());
  $('#dob').val($('#datebirth').val());
  $('#address').val($('#addressd').val());
  $('#highest').val($('#highestd').val());
  $('#passyear').val($('#passyeard option:selected').val());
  $('#monthex').val($('#monthexd').val());
  $('#dojoining').val($('#datejoin').val());
  $('#dorelieving').val($('#datereli').val());
  $('#joiningPack').val($('#joiningPackd').val());
  $('#monthSalary').val($('#monthSalaryd').val());
  $('#annualPack').val($('#annualPackd').val());
  $('#currentDesi').val($('#currentDesid').val());
  $('#desiJoining').val($('#desiJoiningd').val());
  $('#briefWork').val($('#briefWorkd').val());
  
  var work=$('input[name="current_working"]:checked').attr('value');
  if(work==0){
    $("#cur0").attr('checked', true);
    $("#cur1").attr('checked', false);
    $("#reliving").show();
  }else if(work==1){
    $("#cur1").attr('checked', true);
    $("#cur0").attr('checked', false);
    $("#reliving").hide();
  }else{
    $("#cur0").attr('checked', false);
    $("#cur1").attr('checked', false);
  }
  
  
  
  
  
  
  
  
 
}
/* $('.previewvalue').on('click', function() {
   var add= $('#address').val($('.registraSave').find("input[name=\"name\"]"));
alert(add);
}); */
 
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog my-model-bg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
      style="position: absolute;top: 9px;right: 5px;font-size: 28px;font-weight: 400;z-index: 1;background-color: #ddd;width: 25px;color: #000000;opacity: 1;text-shadow:none;
          height: 25px;
                    ius: 50%; "> 
            <span aria-hidden="true">×</span>
          </button>
      <div class="modal-body padding-none">
        <div class="">
          <div class="">
              <div class="row form-bg-section2">
      
                          <div class="col-lg-12">
                                  <h4 class="req-he">Data Preview</h4>
                                  <form id="form"  method="post" class="registraSave" autocomplete="off">
                            <div class="row">
							<div class="col-lg-3">
								<div class="form-group">
								<label for="pwd">Title</label>
									<input type="text" readonly id="titled" class="form-control">
									<!--<select class="form-control select-from" id="titled" name="gender">
										<option value="">Select Title</option>
										<option value="Mr." <?php echo (isset($row['gender']) && $row['gender']=='Mr')?"selected":""?> >Mr.</option>
										<option value="Ms." <?php echo (isset($row['gender']) && $row['gender']=='Ms.')?"selected":""?>>Ms.</option>     
									</select>-->
								</div>
							</div> 
                            <div class="col-lg-3">
								<div class="form-group">
								  <label for="email">Full Name</label>
								  <input type="text" class="form-control my-from" id="name"  name="name" readonly value="<?php echo $rowyear['name']; ?>">
								</div>
							</div>
						
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Date of Birth</label>
								<input type="text" id="dob" readonly class="form-control">
                             
								
                              </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="pwd">Contact Number</label>
                            <!--<i class="fal fa-phone-volume"></i>-->
                            <input type="number" class="form-control my-from" id="contact"  name="phone" readonly value="<?php if(isset($_SESSION['mobile'])){ echo $_SESSION['mobile']; }else { echo (isset($_POST['mobile'])?$_POST['mobile']:""); } ?>">
                          </div>
                          </div>
          
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Address of Corres... </label>
                                <!--<i class="fal fa-address-book"></i>-->
                                <input type="text" class="form-control my-from" id="address" name="address" readonly placeholder="Enter Address" value="<?php  echo (isset($_POST['address'])?$_POST['address']:"");  ?>">
                              </div>
                              </div>
                         
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Email Address</label>
                                <input type="email" class="form-control " id="email"  name="email" readonly value="<?php echo $rowyear['email'];?>">
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Highest Qualification </label>
                               
									 
									<input type="text" class="form-control" id="highest" name="highest" readonly placeholder="Enter Qualification" >
									 
								</div>
							</div>  
							<div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Passing Year</label>
									<input type="text" id="passyear" readonly class="form-control">
									<!--<select name="passing_year" id="passyeard" class="form-control my-from">
										<option value="">Year</option>
											<?php  
												for ($x = 2001; $x <= 2022; $x++) {	?>
											<option><?php echo " $x <br>";?> </option>
											<?php	} ?>		
									</select>-->
									 
								</div>
							</div>
                              <div class="col-lg-3">
								<div class="form-group">
									<label for="pwd">Year of Exp..</label>
									
									<input type="text" class="form-control my-from" name="exp_year" readonly value="<?php echo $rowyear['exp_req']; ?>">				
											
										
									
									
									<!--<select name="exp_year" class="form-control my-from">
										<option value="">Year</option>
										<?php  
											//for ($x = 0; $x <= 22; $x++) {	?>
										<option><?php// echo " $x <br>";?> </option>
										<?php	//} ?> 									
									</select>-->
								</div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
									<label for="pwd">Months of Exp..</label>
										<input type="text" id="monthex" readonly class="form-control">
									<!--<select name="exp_month" class="form-control my-from" id="monthexd">
										<option value="">Months</option>
										<?php  
										for ($x = 1; $x <= 12; $x++) {	?>
										<option><?php echo " $x Months<br>";?> </option>
										<?php	} ?>			
									</select>-->
								</div>
                              </div>
							  
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Date of Joining </label>
                                <!--<i class="fal fa-calendar-alt"></i>-->
                                <input type="text" class="form-control my-from" id="dojoining" placeholder="DD-Month-Year" name="date_joining" readonly>
                              </div>
                              </div>
                              <div class="col-lg-3" id="reliving">
                                <div class="form-group">
                                <label for="pwd">Date of Relieving </label>
                                <!--<i class="fal fa-calendar-alt"></i>-->
                                <input type="text" class="form-control my-from" id="dorelieving" placeholder="DD-Month-Year" name="date_relieving" readonly >
                              </div>
                              </div>
                              
                              <div class="col-lg-3">
                                    <div class="form-group">
                                        
                                        <label>Current Working</label>  <input type="radio" name="current_working" class="working" id="cur1" value="1">
                                        <label>Last Working Day<label> <input type="radio" name="current_working" class="working" id="cur0" value="0">
                                    </div>
                                </div>
                    
                              <div class="col-lg-5">
                                <div class="form-group">
                                <label for="pwd"> Package at the time of Joining</label>
                                <!--<i class="fal fa-money-bill-alt"></i>-->
                                <input type="text" class="form-control my-from" name="joining_pack" id="joiningPack" placeholder="Enter Joining Package" readonly>
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Month Salary </label>
                                <!--<i class="fal fa-money-bill-alt"></i>-->
                                <input type="text" class="form-control my-from"  name="current_salary" id="monthSalary" placeholder="Enter Current Month Salary " readonly value="<?php echo $row['salary'];?>">
                              </div>
                              </div>
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Annual Package </label>
                                <!--<i class="fal fa-money-bill-alt"></i>-->
                                <input type="number" class="form-control my-from" name="annual_package" id="annualPack" readonly placeholder="Enter Annual Package" value="<?php if($_POST['annual_package']){ echo $_POST['annual_package']; }else{ echo $row['annual_package']; } ?>" >
                              </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Designation at the Time of Joining</label>
                                <!--<i class="fal fa-graduation-cap"></i>-->

                                <input type="text" class="form-control my-from"  name="desig_joining" id="desiJoining" readonly placeholder="Enter Designation Joining">
                              </div>
                              </div>
                              
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Current Designation</label>
                                <!--<i class="fal fa-graduation-cap"></i>-->
                                <input type="text" class="form-control my-from" name="current_desig" id="currentDesi" readonly placeholder="Enter Current Designation">
                              </div>
                              </div>
                              
                              <div class="col-lg-12" style="display:none;">
                                <div class="form-group">
                                <label for="pwd">Give A Brief Explanation About Your work</label>
                               <textarea  name="brief_work" cols="100" rows="1" id="briefWork" placeholder="Enter Explanation Your work (Optional)" readonly class="form-control"></textarea>
                              </div>
                              </div>

                            </div>
                             <div class="col-lg-12 text-center">
                                        <div class="mybtn3 mb-3">
                                        <button type="" class="btn btn-primary mr-2" data-dismiss="modal">Edit</button>
          
                                          <button type="button" class="btn btn-primary " data-dismiss="modal" data-target="#exampleModalfinished">Close</button>
										  	
                                        </div>
                                      </div>
                          </form>
                              </div>
                         
          
                          <!-- <div class="col-lg-3 text-center myheight">
                              <img src="img/registration-form-bg.png" alt="" class="img-fluid">
          
                          </div> -->
                          <div class="col-lg-12">
                              <div class="note-form note-form2">
                                  <h2>Please Read Carefully:</h2>
									  <div class="point-notes point-notes2">
										  <ul>
										  <strong><li>15 Days Amount of CTC will be paid at the time of Acceptance of resignation / Relieving Letter / Verification.
											</li></strong>
											  <li>Please email these Documents at BGC@live.in only any email address, we will not consider.</li>
											  <li>To Know the Status of your Experience Letter or any other Query, Please write us at BGC@live.in only, do not call on phone.
											  </li>
											  <li>Please Fill The Form Carefully, we will Process your Documents Based on the above information, no changes will be done once your documents are ready.
											  </li>
											  <li>Collect your Experience Letter within 90 Days from the date of Payment else the hard copy of your Document will be destroyed by the company /
												  Croma Campus and no query will be entertained in regards payment /  documents.</li>
											
										  </ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div id="messagemodel" class="modal fade" role="dialog"  tabindex="-1"><div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
					</button><div class="imgclass"></div><div class="successhtml"></div><div class="failedhtml"></div>
						<button type="button" class="btn btn-primary clickok" data-dismiss="modal" style="margin-left: 40%;" >Ok</button>
	    
	    </div></div></div></div>

		<!-- JS here -->

        <script src="js/bootstrap.min.js"></script>
  
    </body>
	<style>
  .error {
    color: red;
  }
</style>
</html>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/custom.js"></script>
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
<script>
  $(document).ready(function () {
    
	$('#registrationsub').on('click', function(){
		
	var name= $('#name').val();
	var datebirth= $('#datepicker').val();
	var contact= $('#contact').val();
	var address= $('#address').val();
	//alert('address');
	/*var email= $('#email').val();
	var highest= $('#highest').val();
	var passing_year= $('#passing_year').val();
	var exp_year= $('#exp_year').val();
	var exp_month= $('#exp_month').val();
	var date_joining= $('#date_joining').val();
	var date_relieving= $('#date_relieving').val();
	var joining_pack= $('#joining_pack').val();
	var current_salery= $('#current_salery').val();
	var annual_package= $('#annual_package').val();
	var current_desig= $('#current_desig').val();
	var desig_joining= $('#desig_joining').val();
	var brief_work= $('#brief_work').val(); */
	//alert(name);
	$('#pre_name').val(name);
	 $('#pre_datebirth').val(datebirth);
	$('#pre_contact').val(contact);
	$('#pre_address').val(address);
	/*$('#pre_email').val(email);
	$('#pre_highest').val(highest);
	$('#pre_passing_year').val(passing_year);
	$('#pre_exp_year').val(exp_year);
	$('#pre_exp_month').val(exp_month);
	$('#pre_date_joining').val(date_joining);
	$('#pre_date_relieving').val(date_relieving);
	$('#pre_joining_pack').val(joining_pack);
	$('#pre_current_salery').val(current_salery);
	$('#pre_annual_package').val(annual_package);
	$('#pre_current_desig').val(current_desig);
	$('#pre_desig_joining').val(desig_joining);
	$('#pre_brief_work').val(brief_work); */
	
	});
	
  });
</script>
<script>
 
$(".registraSave").submit(function(e){ 
	e.preventDefault();	 
 
	if(!$.fn.registrvalidate(this)){		 
		return false;	
	}   
	var data=$(this).serialize();
		$.ajax({	
		 
			url: "/action.php",
		 
			data: data,
			type:"POST",			 
			success:function(response){
				//alert(response);
				 var obj = JSON.parse(response);
				 		// alert(obj.last_id);
				if(obj.status){
				    
                    $("#messagemodel").modal();
                  	$('.imgclass').html('<img src="/img/Thanks_Reaching_Us.jpg" style="width: 50%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
			    	//window.location.href = "https://exps.cromacampus.com/success.php";
                    $('#messagemodel').modal({backdrop:"static",keyboard:false});
                    $this.find('.valid_error').remove();
                    window.location.reload();
                    
				}else{
				$("#messagemodel").modal('show');
				$('.imgclass').html('<img src="./message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
				$('.failedhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
				$('#messagemodel').modal({backdrop:"static",keyboard:false});
				}
			}
		});
});


$.fn.registrvalidate=function(t){
	$(".valid_error").remove(); 
	 
	var status = 0;	 
	if($(t).find("input[name=\"name\"]").length==1 && $(t).find("input[name=\"name\"]").val()==""){
		$(t).find("input[name=\"name\"]").after("<div class='valid_error'>Name is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"datebirth\"]").length==1 && $(t).find("input[name=\"datebirth\"]").val()==""){
		$(t).find("input[name=\"datebirth\"]").after("<div class='valid_error'>Date of Birth is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"phone\"]").length==1 && $(t).find("input[name=\"phone\"]").val()==""){
		$(t).find("input[name=\"phone\"]").after("<div class='valid_error'>Contact Number is mandatory.</div>")
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
	if($(t).find("select[name=\"exp_month\"]").length==1 && $(t).find("select[name=\"exp_month\"]").val()==""){
		$(t).find("select[name=\"exp_month\"]").after("<div class='valid_error'>Experience Month is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"date_joining\"]").length==1 && $(t).find("input[name=\"date_joining\"]").val()==""){
		$(t).find("input[name=\"date_joining\"]").after("<div class='valid_error'>Date Joining is Mandatory.</div>")
		status = 1;
	}

	if($(t).find("input[name=\"joining_pack\"]").length==1 && $(t).find("input[name=\"joining_pack\"]").val()==""){
		$(t).find("input[name=\"joining_pack\"]").after("<div class='valid_error'>Joining Packages is Mandatory.</div>")
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
		
		
		
function addAannualPackage() { 
		var monthSalaryd = parseInt($('#monthSalaryd').val());		
		var total_annual = parseInt(((monthSalaryd*12)));	
		var total_ten_avrage = parseInt(((total_annual*10)/100));	
		var gstamount = $('#annualPackd').val(total_annual+total_ten_avrage);	
}

</script>

<script>
 

$(document).on('click', '.clickok', function(){  window.location.reload();	 });
   $(document).ready(function () {
      var currentDate = new Date();
      $('.disableFuturedate').datepicker({
      format: 'dd-mm-yyyy',
    //   showButtonPanel: true,
    changeMonth: true,
    changeYear: true,
    showOtherMonths: true,
    yearRange: "-50:+00",
    selectOtherMonths: true,
      autoclose:true,
     // endDate: "currentDate",
      maxDate: 0
      }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
      });
     /* $('.disableFuturedate').keyup(function () {
         if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
         }
      });
      */
      
      
   });
</script>
