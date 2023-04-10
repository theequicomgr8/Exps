<?php 
$title = 'Record Company'; 
include "config.php";
include 'header.php';?>

		
    <?php 
        if(isset($_POST['search']) ){
            $filtercompany = $_POST['filteremp_company'];
            $select = "SELECT * FROM `emp_records` where status=1 and `emp_company` ='".$filtercompany."'";
           	$result = mysqli_query($con_exp,$select);
          
        }else{
             	$sql = "SELECT * FROM emp_records where status = 1 ORDER BY id ASC";
				$result = mysqli_query($con_exp, $sql);
        }
    ?>        
            
    <div class="part-name" style="display:flex; align-items:center;"> <h2>Record</h2> 
                
        <div class="form-group" style="margin-left:auto; width: 23%; border-radius: 10px; border: none; outline: none;">
            <form method="post">    
                <?php 
    				$sqlc = "SELECT * FROM companies";
    				$sqlqueryc = mysqli_query($con_exp,$sqlc);	?>
                	 
    			<div style="display:flex;">
    			    <select class="form-control my-from" name="filteremp_company" style="border-radius:7px 0 0 7px !important;">
    				<option value="">Select Company</option> 
    				<?php 
    				while($abresult = mysqli_fetch_assoc($sqlqueryc)){  ?>
    						
    				<option value="<?php echo $abresult['comp_name']; ?>"  
    				    <?php if(isset($filtercompany) && $filtercompany==$abresult['comp_name'] ){ echo "selected"; } ?>><?php echo $abresult['comp_name'];?></option>
    				<?php } ?> 
    			</select>
    			<button type="submit" name="search" class="btn btn-info">Search</button>
    			</div>
    		</form>	
        </div>
       
    </div>
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
            <table class="table table-hover table-responsive" id="data-table-dashbaords">
              <thead>
                <tr class="top-table1">
                  <th>SL No.</th>
                  <th>Date</th>
                  <th>Emp ID</th>
                  <th>Name</th>
                  <th>Company </th>
                  <!--<th>Desination </th>-->
                  <!--<th>Annual CTC </th>-->
                  <!--<th>Month CTC </th>-->
                  <th>DOJ</th>
                  <th>DOR</th>
                   <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
			  
			    <?php //$sql = "SELECT * FROM emp_records ";
				//	$sql = "SELECT * FROM emp_records ORDER BY id ASC";
				//	$result = mysqli_query($con_exp, $sql);
						$i = 1;
						while($row = mysqli_fetch_assoc($result)) {
				 
				?>
                <tr>
                   <td><?php echo $row["id"];?> </td>
                   <td><?php echo $row["created_at"];?> </td>
                  <td><?php echo $row['emp_id'];?></td>
                  <td><?php echo $row["emp_name"];?></td>
                  <td><?php echo $row["emp_company"];?></td>
                  <!--<td><?php //echo $row["emp_designation"];?></td>-->
                  <!--<td><?php //echo $row["emp_annual_ctc"];?></td>-->
                  <!--<td><?php //echo $row["emp_monthly_ctc"];?></td>-->
                  <td><?php echo $row["emp_doj"];?></td>
                  <td><?php echo $row["emp_dor"];?></td>    
                  <td class="record_action ">
                      
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-sliders"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter_<?php echo $row["id"];?>">Appraisal</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail_<?php echo $row["id"];?>">Student Detail</a>
                    </div>
                </li>
                
                <!-- Appraisal form Modal-->
                <div class="modal fade" id="exampleModalCenter_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                	<div class="">
							            <?php //echo $row["emp_name"]; ?> &nbsp; &nbsp;<?php //echo $row["emp_phone"]; ?> &nbsp; &nbsp;<?php //echo $row["emp_email"]; ?>
							        </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                           
                            
                            <div class="modal-body">
                                <?php 
                                
                                 
                                 $appsql = "select * from appraisal_records where record_id ='".$row["id"]."' ORDER BY id DESC LIMIT 1"; 
                                 $appresult = mysqli_query($con_exp, $appsql); 
                                 $approw = mysqli_fetch_assoc($appresult);
                                  
                                ?>
                                
                                <form method="post" class="appraSave" autocomplete="off"> 
                                <div class="appraisal-section">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 style="color:#083553;text-align: left;border-bottom: 1px solid;padding: 5px 0;">Appraisal</h4>
                                        </div>
                                    <div class="form-group col-md-6">
										 <input type="hidden" class="form-control" name="id" value="<?php echo $row["id"]; ?>" >  
										 <input type="hidden" class="form-control" name="emp_id" value="<?php echo $row["emp_id"]; ?>" > 
                                       <label for="ctc">CTC 3</label>
                                        <input type="text" class="form-control" name="oldctc" value="<?php if($approw['new_ctc']){ echo $approw['new_ctc']; }else{  echo $row['emp_ctc3']; } ?>" readonly> 
                                    </div>
                                                              
                                    <div class="form-group col-md-6">
                                        <label for="newctc">New CTC</label>
                                        <input type="number" class="form-control" name="newctc" value="<?php echo $approw['new_ctc']; ?>" placeholder="Enter New CTC">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="appraisal">Appraisal Date</label>
                                        <input type="text" class="form-control datepicker" name="appraisaldate" value="<?php if($approw['new_appraisaldate']){ echo $approw['new_appraisaldate']; }else{  echo $row['emp_appraisaldate']; } ?>" placeholder="Appraisal Date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="degination">New Designation</label>
                                        <input type="text" class="form-control" name="newdesignation" value="<?php if($approw['new_designation']){ echo $approw['new_designation']; }else{  echo $row['emp_designation']; } ?>" placeholder="New Designation">
                                    </div>
                                    </div>
                                </div>    
                                <div class="appraisal-section">
                                    <div class="row"> 
                                    <div class="col-12"><h4 style="color:#083553;text-align: left;border-bottom: 1px solid;padding: 5px 0;">Relieving</h4></div>
                                    <div class="form-group col-md-12">
                                        <label for="aproval">Date of Relieving</label>
                                        <input type="text" class="form-control datepicker1" name="new_dor" value="<?php if($approw['new_dor']){ echo $approw['new_dor']; }else{  echo $row['emp_dor']; } ?>" placeholder="Relieving Date">
                                    </div>
                                </div>
                                </div>
                               <div class="appraisal-section">
                                    <div class="row"> 
                                     <div class="col-12"><h4 style="color:#083553;text-align: left;border-bottom: 1px solid;padding: 5px 0;">Salary Slips</h4></div>
                                        <div class="form-group col-md-6">
                                            <label for="pwd">Salary Slips Year</label>
                                            <select class="form-control select-from"  name="new_slipsyear" >
                                                <option value="">Select Year</option> 
                                                <option value="<?php if($approw['new_slipsyear']){ echo $approw['new_slipsyear']; }else{  echo $row['emp_slipsyear']; } ?></option>
												
													<?php for ($x = 2000; $x <= 2023; $x++){ ?>
													<option value="<?php echo "$x";?>" <?php if(isset($x) && $x==$approw['new_slipsyear'] ){ echo "selected"; } ?>><?php echo "$x";?></option>	  	
													<?php } ?>
											</select>
                                        </div>                              
                                    
                                        <div class="form-group col-md-6">
                                            <label for="pwd">Net Pay Amount</label>
                                            <input type="number" class="form-control my-from" name="new_netpay" value="<?php if($approw['new_netpay']){ echo $approw['new_netpay']; }else{  echo $row['emp_netpay']; } ?>" placeholder="Enter Net Pay" onkeypress="return isNumberKey(event);">
                                        </div>
                                        
                                         <div class="form-group col-12">
                                            <ul class="list-calender" style="color:black;">
                                                <?php 
                                                    $month_chk = unserialize($approw['new_month_chk']);
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
                                            </ul>
                                        </div>
                                    </div>  
                               </div>  
                                        <div class="m-auto">
                                    	    <input type="hidden" name="appraAction" value="appraSave"/>
                                            <button type="submit" class="btn btn-primary" name="submit" style="padding:6px 50px !important; background:#083553 !important; color:#fff !important;">Submit</button>
                                        </div>
                                    
                                </form>
                                  
                            </div>
                        </div>
                    </div>
                </div>

                
               
                <div class="modal fade" id="detail_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg " role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
									
                            <div class="modal-body">
							<?php //echo $id = $row["id"]; ?>
							<div class="">
							<?php echo $row["emp_name"]; ?> &nbsp; &nbsp;<?php echo $row["emp_phone"]; ?> &nbsp; &nbsp;<?php echo $row["emp_email"]; ?>
							</div>
							
                                <table class="table table-hover table-responsive" id="data-table-dashbaords">
                                    <thead>
                                        <tr class="top-table1">
                                            <th>Check</th>
                                            <th>CTC</th>
                                            <th>Appraisal Date</th>
                                            <th>Designation</th>
                                            <th>New Dor</th>
                                            <th>New Netpay</th>
                                            <th>Salary Slips</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
											$sqlnew = "SELECT * FROM appraisal_records where record_id = '".$row["id"]."'";
											//echo $sqlnew;  
											 $resultnew = mysqli_query($con_exp, $sqlnew);
											 while($appraisalrow = mysqli_fetch_assoc($resultnew)) {
											//echo "<pre>"; print_r($resultnew); die;  
										?>
                                        <tr>
											<td><input type="radio" name="check" class="check-apprasal" value="<?php echo $appraisalrow["id"];?>"></td>
                                            <td><?php echo $appraisalrow["new_ctc"];?></td>
											<td><?php echo $appraisalrow["new_appraisaldate"];?></td>
											<td><?php echo $appraisalrow["new_designation"];?></td>
											<td><?php echo $appraisalrow["new_dor"];?></td>
											<td><?php echo $appraisalrow["new_netpay"];?></td>
											<td><?php echo $appraisalrow["new_slipsyear"];?></td>
                                        </tr>
										<?php } ?>
                                     </tbody>
								</table>     
									<div class="download-btn-list mt-3">
									<form onsubmit="return excelFormValidation(this)" action="appraisal_pdf.php" method="post">
										<input type="hidden" name="apprasal_id" class="apprasal_id"/>
										<div class="download-section mt-3">
										<div class="container">
											<div class="row">
												<div class="col-lg-6 text-center">
													<input type="radio" name="letterhead" value="letterhead">
													<p class="btn-blue">Download Letterhead</p>
												</div>
												<div class="col-lg-6 text-center">
													<input type="radio" name="letterhead" value="plain">
													<p class=" btn-blue">Download Plain Paper</p>
												</div>
											</div>
										</div>
										</div>
										</br>    
										<div class="row">
											<div class="col-lg-3">
												<div class="letter-download">
												<!--<input type="submit" name="b1" value="Appointment Letter" class="frmbuttn">--> 
												
													<button name="b1" value="Appraisal Letter" class="green btn-letter frmbuttn">Appraisal Letter</button>
												</div>
											</div>
										
											<div class="col-lg-3">
												<div class="letter-download">
												<!--<input type="submit" name="b1" value="Compensation Letter" class="frmbuttn">-->
												   
													<button   name="b1" value="Appointment Letter" class="green btn-letter frmbuttn">Appoint Letter</button>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="letter-download">
												<!--<input type="submit" name="b1" value="Experience Letter" class="frmbuttn">-->
												   
													<button name="b1" value="Experience Letter" class="green btn-letter frmbuttn">Experience Letter</button>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="letter-download">
												<!--<input type="submit" name="b1" value="Salary Slip" class="frmbuttn">-->
												  
													<button  name="b1" value="Salary Slip" class="green btn-letter frmbuttn">Salary Slips</button>
												</div>
											</div>
	<script type="text/javascript">

		function excelFormValidation(thisForm) {	
		 	//alert($('.check-apprasal:checked').val());
			jQuery('.apprasal_id').val($('.check-apprasal:checked').val());

		}
	</script>
	
										</div>
									</form>

									</div>
								</div>
								
							</div>
						</div>
					</div>
					
				</td> 
                  
			</tr>
				<?php } ?>
                 

            
		</tbody>
	</table>

          </div>
            <div class="row" style="margin-top:20px">
            <div class="col-lg-3">
            <form role="form" method="POST" action="record-excel-download.php" >
            
            
            <button type="submit" name="export" value="export" class="btn btn-success  btn-block move-not-interested">Export as Excel</button>
            
            </form>
            </div>
            </div>

        </div>
      </div>
    </div>
  </div>
  
  


  <!-- JS here -->

<?php include 'footer.php';?>
 
  <script>
    $(document).ready(function () {
       $('#data-table-dashbaords').DataTable({
      //  columnDefs: [ { type: 'ID', 'targets': [0] } ],
        order: [[ 0, 'desc' ]],
        "lengthMenu": [
        [10,50,100,250,500],
        ['10','50','100','250','500']
        ],
        
        });
        
          $( function() {
        $( ".datepicker" ).datepicker();
        
        } );
         $( function() {
        $( ".datepicker1" ).datepicker();
        
        } ); 

			//********Add Appraisal Records*********
			
            $(".appraSave").submit(function(e){    
        	e.preventDefault();	 
        	if(!$.fn.registrvalidate(this)){		 
        		return false;	
        	}    
        	  var data=new FormData(this);
        		$.ajax({
					url: "./action.php",
        			data: data,
        			type:"POST",	
        			cache: false,
        			contentType: false,
        			processData: false,			
        			success:function(response){
        				var obj = JSON.parse(response);
        			 
        				if(obj.status){
                            $("#successmessage").modal();
                  	        $('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	        $('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                            $('#successmessage').modal({backdrop:"static",keyboard:false});
					        $("button").click(function(){
						        location.reload(true);
					        });
                            $this.find('.valid_error').remove();
        				}else{
        					    $("#messagemodel").modal('show');
        					    $('.imgclass').html('<img src="img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
        					    $('.failedhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
        					    $('#messagemodel').modal({backdrop:"static",keyboard:false});
        				    }
        			}
        		});
	        });
	        
	        
	        
 
           $.fn.registrvalidate=function(t){
            	$(".valid_error").remove(); 
            	 
            	var status = 0;	 
            	if($(t).find("input[name=\"newctc\"]").length==1 && $(t).find("input[name=\"newctc\"]").val()==""){
            		$(t).find("input[name=\"newctc\"]").after("<div class='valid_error'>New ctc is mandatory.</div>")
            		status = 1;
            	}
            	if($(t).find("input[name=\"appraisaldate\"]").length==1 && $(t).find("input[name=\"appraisaldate\"]").val()==""){
            		$(t).find("input[name=\"appraisaldate\"]").after("<div class='valid_error'>Appraisal Date is mandatory.</div>")
            		status = 1;
            	}
            	 if($(t).find("input[name=\"newdesignation\"]").length==1 && $(t).find("input[name=\"newdesignation\"]").val()==""){
            		$(t).find("input[name=\"newdesignation\"]").after("<div class='valid_error'>New Designation is mandatory.</div>")
            		status = 1;
            	}
            	 if($(t).find("select[name=\"new_slipsyear\"]").length==1 && $(t).find("input[name=\"new_slipsyear\"]").val()==""){
            		$(t).find("select[name=\"new_slipsyear\"]").after("<div class='valid_error'>New Designation is mandatory.</div>")
            		status = 1;
            	}
            	if($(t).find("select[name=\"new_slipsyear\"]").length==1 && $(t).find("select[name=\"new_slipsyear\"]").val()==""){
		            $(t).find("select[name=\"new_slipsyear\"]").after("<div class='valid_error'>New Slips Year is Mandatory.</div>")
		            status = 1;
	            }
            	
            	if(status){
            		return false;
            	}
            return true;
            } 
			
	
	 
     
    });
    
  </script> 
  
  
</body>

</html>