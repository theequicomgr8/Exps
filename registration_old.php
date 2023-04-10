<?php
	session_start();
	///include "config.php";
	error_reporting(0);
?>
<?php

	$phone	= $_SESSION['phone'];
	//echo $phone;
	//if(!$_SESSION['phone'])	
{?>
<script type="text/javascript">

//window.location = "index.php";

</script>
<?php } ?>

<?php 
	$messages = array(

	'err_1'  => '<strong>Does not Insert Data Successfully</strong> ',
	 
	'succ_1' => 'Student Registered Successfully.',
);
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
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
       <style>
	   .valid_error{
		   color:red;
		   font-size: 10px;
	   }
       </style>
    </head>
    <body>

<div class="myfrom-center1">
<div class="container">
    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messagemodel">
  Launch demo modal
</button>-->
    <div class="row form-bg-section2">
		<div class="col-lg-9">
                        <form id="form"  method="post" class="registraSave" autocomplete="off">
                            <div class="row">
                                
                                <div class="col-lg-3">
							<div class="form-group">
                            <label for="pwd">Title</label>
								<select class="form-control select-from" id="" name="gender">
									<option value="">Select Title</option>
                                    <option value="Mr." <?php echo (isset($row['gender']) && $row['gender']=='Mr')?"selected":""?> >Mr.</option>
                                    <option value="Ms." <?php echo (isset($row['gender']) && $row['gender']=='Ms.')?"selected":""?>>Ms.</option>     
                                </select>	
                            </div>
                        </div> 
                            <div class="col-lg-3">
                            <div class="form-group">
                              <label for="email">Full Name</label>
                              <i class="fal fa-user"></i>
                              <input type="text" class="form-control my-from" id="name"  name="name" value="<?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; }else { echo (isset($_POST['name'])?$_POST['name']:""); } ?>" style="padding: 0px 0px 3px 18px !important;
                              ">
                            </div>
                        </div>
						
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Date of Birth</label>
                                <i class="fal fa-calendar-alt"></i>
                                <input type="datetime" class="form-control my-from" id="datepicker" placeholder="DD-Month-Year" name="datebirth">
                              </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="pwd">Contact Number</label>
                            <i class="fal fa-phone-volume"></i>
                            <input type="number" class="form-control my-from" id="contact"  name="phone" readonly value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone']; }else { echo (isset($_POST['phone'])?$_POST['phone']:""); } ?>">
                          </div>
                          </div>
          
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pwd">Address of Correspondence </label>
                                <i class="fal fa-address-book"></i>
                                <input type="text" class="form-control my-from" id="address" name="address" value="<?php  echo (isset($_POST['address'])?$_POST['address']:"");  ?>">
                              </div>
                              </div>
                         
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Email Address</label>
                                <i class="fal fa-envelope-open-text"></i>
                                <input type="email" class="form-control my-from" id="email"  name="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; }else { echo (isset($_POST['email'])?$_POST['email']:""); } ?>">
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Highest Qu </label>
                               
									 
									<input type="text" class="form-control" id="pwd" name="highest" >
									 
								</div>
							</div>  
							<div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Passing Year</label>
									<select name="passing_year" class="form-control my-from">
										<option value="">Year</option>
											<?php  
												for ($x = 2001; $x <= 2022; $x++) {	?>
											<option><?php echo " $x  <br>";?> </option>
											<?php	} ?>		
									</select>
									 
								</div>
							</div>
                              <div class="col-lg-3">
								<div class="form-group">
									<label for="pwd">How Many Year of Experience</label>
									<select name="exp_year" class="form-control my-from">
										<option value="">Year</option>
										<?php  
											for ($x = 0; $x <= 22; $x++) {	?>
										<option><?php echo " $x <br>";?> </option>
										<?php	} ?> 									
									</select>
								</div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
									<label for="pwd">Months of Experience</label>
									<select name="exp_month" class="form-control my-from">
										<option value="">Months</option>
										<?php  
										for ($x = 1; $x <= 12; $x++) {	?>
										<option><?php echo " $x <br>";?> </option>
										<?php	} ?>			
									</select>
								</div>
                              </div>
							  
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Date of Joining </label>
                                <i class="fal fa-calendar-alt"></i>
                                <input type="datetime" class="form-control my-from" id="datepicker2" placeholder="DD-Month-Year" name="date_joining" value="">
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Date of Relieving </label>
                                <i class="fal fa-calendar-alt"></i>
                                <input type="datetime" class="form-control my-from" id="datepicker3" placeholder="DD-Month-Year" name="date_relieving" >
                              </div>
                              </div>
                    
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd"> Joining Package</label>
                                <i class="fal fa-money-bill-alt"></i>
                                <input type="number" class="form-control my-from" name="joining_pack" >
                              </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Current Month Salary </label>
                                <i class="fal fa-money-bill-alt"></i>
                                <input type="number" class="form-control my-from"  name="current_salary" value="<?php echo $row['salary'];?>">
                              </div>
                              </div>
                         
                              <div class="col-lg-3">
                                <div class="form-group">
                                <label for="pwd">Annual Package </label>
                                <i class="fal fa-money-bill-alt"></i>
                                <input type="number" class="form-control my-from" name="annual_package" value="">
                              </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Current Designation</label>
                                <i class="fal fa-graduation-cap"></i>
                                <input type="text" class="form-control my-from" name="current_desig" value="">
                              </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                <label for="pwd">Designation at the Time of Joining</label>
                                <i class="fal fa-graduation-cap"></i>

                                <input type="text" class="form-control my-from"  name="desig_joining" value="">
                              </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                <label for="pwd">Give A Brief Explanation About Your work</label>
                               <textarea  name="brief_work" cols="100" rows="1"></textarea>
                              </div>
                              </div>

                            </div>
                            <div class="col-lg-12 text-center">
                              <div class="mybtn mybtn2">
							  <input type="hidden" name="action" value="registraSave" />
                                <button type="submit" class="btn btn-primary" id="registrationsub" name="submit" >Submit</button>
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
                <li>Please email these Documents at BGC@live.in only any email address, we will not consider.</li>
                <li>To Know the Status of your Experience Letter or any other Query, Please write us at BGC@live.in only, do not call on phone.
                </li>
                <li>Please Fill The Form Carefully, we will Process your Documents Based on the above information, no changes will be done once your documents are ready.
                </li>
                <li>Collect your Experience Letter within 90 Days from the date of Payment else the hard copy of your Document will be destroyed by the company /
                    Croma Campus and no query will be entertained in regards payment /  documents.</li>
        <li>15 Days Amount of CTC will be paid at the time of Acceptance of resignation / Relieving Letter / Verification.
        </li>
            </ul>
        </div>
			</div>
           </div>
        </div>


   
</div>
</div>





<!-- pop up form  -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog my-model-bg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="
      position: absolute;
      top: 9px;
      right: 5px;
      font-size: 28px;
      font-weight: 400;
      z-index: 1;
      background-color: #ddd;
      width: 25px;
      color: #000000;
      opacity: 1;
      text-shadow: none;
      height: 25px;
      border-radius: 50%;
  ">
            <span aria-hidden="true">×</span>
          </button>
      <div class="modal-body padding-none">
        <div class="">
          <div class="">
              <div class="row form-bg-section2">
          
                          <div class="col-lg-12">
                                  <h4 class="req-he">Data Preview</h4>
                                  <form action="datatable.php">
                                      <div class="row">
                                      <div class="col-lg-6">
                                      <div class="form-group">
                                        <label for="email">Full Name</label>
                                        <i class="fal fa-user"></i>
										
                                        <input type="text" class="form-control my-from" id="pre_name"  name="name" value="<?php  echo (isset($_POST['name'])?$_POST['name']:"");  ?>" style="padding: 0px 0px 3px 18px !important; 
                                        ">
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="pwd">Date of Birth</label>
                                          <i class="fal fa-calendar-alt"></i>
                                          <input type="datetime" class="form-control my-from" id="pre_datepicker" placeholder="DD-Month-Year" name="datebirth" value="<?php  echo (isset($_POST['datebirth'])?$_POST['datebirth']:""); ?>">
                                        </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                      <label for="pwd">Contact Number</label>
                                      <i class="fal fa-phone-volume"></i>
                                      <input type="number" class="form-control my-from" id="pre_phone" name="phone" value="<?php  echo (isset($_POST['phone'])?$_POST['phone']:"");  ?>">
                                    </div>
                                    </div>
                    
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="pwd">Address of Correspondence </label>
                                          <i class="fal fa-address-book"></i>
                                          <input type="text" class="form-control my-from" id="pre_address" name="address" value="<?php  echo (isset($_POST['address'])?$_POST['address']:"");  ?>">
                                        </div>
                                        </div>
                                   
                                   
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Email Address</label>
                                          <i class="fal fa-envelope-open-text"></i>
                                          <input type="email" class="form-control my-from" id="pre_email"  name="email" value="<?php  echo (isset($_POST['email'])?$_POST['email']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Highest Qu & Passing Year</label>
                                          <i class="fal fa-graduation-cap"></i>
                                          <div class="my-from form-2" style="padding:0px 0px 0px 21px !important">
                                            <input type="text" class="form-control my-from2" id="pre_highest" name="highest" value="<?php  echo (isset($_POST['highest'])?$_POST['highest']:""); ?>">
											<select  id="pre_passing_year" name="passing_year" class="my-from">
												<option value="<?php  echo (isset($_POST['passing_year'])?$_POST['passing_year']:""); ?>">Year</option>
											<?php  
												for ($x = 2001; $x <= 2022; $x++) {	?>
													<option><?php echo " $x Year <br>";?> </option>
											<?php	} ?>
											</select>
                                      
                                      <!--<select name="passing_year">
                                          <option value="">Year</option>
                                          <option>2001 Year</option>
                                          <option>2002 Year</option>
                                          <option>2003 Year</option>
                                          <option>2004 Year</option>
                                          <option>2005 Year</option>
                                          <option>2006 Year</option>
                                          <option>2007 Year</option>
                                          <option>2008 Year</option>
                                          <option>2009 Year</option>
                                          <option>2010 Year</option>
                                          <option>2011 Year</option>
                                          <option>2012 Year</option>
                                          <option>2013 Year</option>
                                          <option>2014 Year</option>
                                          <option>2015 Year</option>
                                          <option>2016 Year</option>
                                          <option>2017 Year</option>
                                          <option>2018 Year</option>
                                          <option>2019 Year</option>
                                          <option>2020 Year</option>
                                          <option>2021 Year</option>
                                      </select>-->
                                      </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">How Many Year of Experience Required</label><br>
                                          <i class="fal fa-calendar-alt"></i>
                                          <div class="my-from">
										  
										<select id="pre_exp_year" name="exp_year" class="form-control my-from">
											<option value="value="<?php  echo (isset($_POST['exp_year'])?$_POST['exp_year']:"");  ?>"">Year</option>
											<?php  
												for ($x = 0; $x <= 22; $x++) {	?>
											<option><?php echo " $x Year <br>";?> </option>
											<?php	} ?> 									
										</select>
          
                                      <!--<select name="exp_year">
                                          <option value="">Year</option>
                                          <option>1 Year</option>
                                          <option>2 Year</option>
                                          <option>3 Year</option>
                                          <option>4 Year</option>
                                          <option>5 Year</option>
                                          <option>6 Year</option>
                                          <option>7 Year</option>
                                          <option>8 Year</option>
                                          <option>9 Year</option>
                                          <option>10 Year</option>
                                          <option>11 Year</option>
                                          <option>12 Year</option>
                                      </select>-->
										<select id="pre_exp_month" name="exp_month" class="form-control my-from">
											<option value="value="<?php  echo (isset($_POST['exp_month'])?$_POST['exp_month']:"");  ?>"">Months</option>
											<?php  
											for ($x = 1; $x <= 12; $x++) {	?>
											<option><?php echo " $x Months <br>";?> </option>
											<?php	} ?>			
										</select>
                                          <!--<select name="exp_month">
                                            <option value="">Months</option>
                                            <option>1 Months</option>
                                            <option>2 Months</option>
                                            <option>3 Months</option>
                                            <option>4 Months</option>
                                            <option>5 Months</option>
                                            <option>6 Months</option>
                                            <option>7 Months</option>
                                            <option>8 Months</option>
                                            <option>9 Months</option>
                                            <option>10 Months</option>
                                            <option>11 Months</option>
          
                                        </select>-->
                                    
                                  </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Date of Joining </label>
                                          <i class="fal fa-calendar-alt"></i>
                                          <input type="datetime" class="form-control my-from" id="pre_date_joining" placeholder="DD-Month-Year" name="date_joining" value="<?php  echo (isset($_POST['date_joining'])?$_POST['date_joining']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Date of Relieving </label>
                                          <i class="fal fa-calendar-alt"></i>
                                          <input type="datetime" class="form-control my-from" id="pre_date_relieving" placeholder="DD-Month-Year" name="date_relieving" value="<?php  echo (isset($_POST['date_relieving'])?$_POST['date_relieving']:"");  ?>">
                                        </div>
                                        </div>
                              
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd"> Joining Package</label>
                                          <i class="fal fa-money-bill-alt"></i>
                                          <input type="number" class="form-control my-from" id="pre_joining_pack"  name="joining_pack" value="<?php  echo (isset($_POST['joining_pack'])?$_POST['joining_pack']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Current Month Salery </label>
                                          <i class="fal fa-money-bill-alt"></i>
                                          <input type="number" class="form-control my-from" id="pre_current_salery"  name="current_salery" value="<?php  echo (isset($_POST['current_salery'])?$_POST['current_salery']:""); ?>">
                                        </div>
                                        </div>
                                   
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Annual Package </label>
                                          <i class="fal fa-money-bill-alt"></i>
                                          <input type="number" class="form-control my-from" id="pre_annual_package"  name="annual_package" value="<?php  echo (isset($_POST['annual_package'])?$_POST['annual_package']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Current Designation</label>
                                          <i class="fal fa-graduation-cap"></i>
                                          <input type="text" class="form-control my-from" id="pre_current_desig" name="current_desig" value="<?php  echo (isset($_POST['current_desig'])?$_POST['current_desig']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="form-group">
                                          <label for="pwd">Designation at the Time of Joining</label>
                                          <i class="fal fa-graduation-cap"></i>
          
                                          <input type="text" class="form-control my-from" id="pre_desig_joining" name="desig_joining" value="<?php  echo (isset($_POST['desig_joining'])?$_POST['desig_joining']:"");  ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="form-group">
                                          <label for="pwd">Give A Brief Explanation About Your work</label>
                                         <textarea  id="pre_brief_work" name="brief_work" cols="100" rows="1" style="height: 80px;"><?php  echo (isset($_POST['brief_work'])?$_POST['brief_work']:"");  ?></textarea>
                                        </div>
                                        </div>
          
                                      </div>
                                      <div class="col-lg-12 text-center">
                                        <div class="mybtn3 mb-3">
                                        <button type="" class="btn btn-primary mr-2">Edit</button>
          
                                          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalfinished">Finished</button>
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
											  <li>Please email these Documents at BGC@live.in only any email address, we will not consider.</li>
											  <li>To Know the Status of your Experience Letter or any other Query, Please write us at BGC@live.in only, do not call on phone.
											  </li>
											  <li>Please Fill The Form Carefully, we will Process your Documents Based on the above information, no changes will be done once your documents are ready.
											  </li>
											  <li>Collect your Experience Letter within 90 Days from the date of Payment else the hard copy of your Document will be destroyed by the company /
												  Croma Campus and no query will be entertained in regards payment /  documents.</li>
											<li>15 Days Amount of CTC will be paid at the time of Acceptance of resignation / Relieving Letter / Verification.
											</li>
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
	     <button type="button" class="btn btn-primary clickok" style="margin-left: 40%;" >Ok</button>
	    
	    </div></div></div></div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
		<!-- JS here -->

       
  
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
 	$('.clickok').on('click', function(){
 	     
 	     window.location.href="https://exp.xapotechsystems.com/";
 	});
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
			 url: "action.php",
			data: data,
			type:"POST",			 
			success:function(response){
		 
				 var obj = JSON.parse(response);
				if(obj.status){
                    $("#messagemodel").modal();
                  	$('.imgclass').html('<img src="./message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
                    $('#messagemodel').modal({backdrop:"static",keyboard:false});
                    $this.find('.valid_error').remove();
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
	if($(t).find("input[name=\"date_relieving\"]").length==1 && $(t).find("input[name=\"date_relieving\"]").val()==""){
		$(t).find("input[name=\"date_relieving\"]").after("<div class='valid_error'>Date Relieving is Mandatory.</div>")
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
	if($(t).find("textarea[name=\"brief_work\"]").length==1 && $(t).find("textarea[name=\"brief_work\"]").val()==""){
		$(t).find("textarea[name=\"brief_work\"]").after("<div class='valid_error'> Brief Explanation is Mandatory.</div>")
		status = 1;
	}
		 
	
	if(status){
		return false;
	}
	return true;
}

</script>