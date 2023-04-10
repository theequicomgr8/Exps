<?php 
 $title = 'Record Company'; 
include "config.php";
include 'header.php';    ?>

			<!--<div class="add-comapny">
                <a href="#" data-toggle="modal" data-target="#exampleModal">Add Company</a>
            </div>-->
    <?php 
        if(isset($_POST['search']) ){
            
            $filtercompany = $_POST['filteremp_company'];
          //  echo $filtercompany; die;
            
            $select = "SELECT * FROM `emp_records` where `emp_company` ='".$filtercompany."'";
     //  echo $select; die;
           	$result = mysqli_query($con_exp,$select);
           	 
          //  echo "<pre>"; print_r($result); die;
        }else{
             	$sql = "SELECT * FROM emp_records ORDER BY id ASC";
				$result = mysqli_query($con_exp, $sql);
        }
    ?>        
            
    <div class="part-name" style="display:flex; align-items:center;"> <h2>Record</h2> 
        <!--<select name="" id="" style="margin-left:auto; padding:5px; width: 15%; border-radius: 10px; border: none; outline: none;">
            <option value="Compnay-1" disable>Select Company</option>
            <option value="Compnay-1">Compnay-1</option>
            <option value="Compnay-1">Compnay-1</option>
            <option value="Compnay-1">Compnay-1</option>
        </select>-->
        
        <div class="form-group" style="margin-left:auto; padding:5px; width: 15%; border-radius: 10px; border: none; outline: none;">
            <form method="post">    
                <?php 
    				$sqlc = "SELECT * FROM companies";
    				$sqlqueryc = mysqli_query($con_exp,$sqlc);	?>
                	 
    			<select class="form-control my-from" name="filteremp_company">
    				<option value="">Select Company</option> 
    				<?php 
    				while($abresult = mysqli_fetch_assoc($sqlqueryc)){  ?>
    						
    				<option value="<?php echo $abresult['comp_name']; ?>"  
    				    <?php if(isset($filtercompany) && $filtercompany==$abresult['comp_name'] ){ echo "selected"; } ?>><?php echo $abresult['comp_name'];?></option>
    				<?php } ?> 
    			</select>
    			<button type="submit" name="search" class="btn btn-info">click</button>
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
						while($row = mysqli_fetch_array($result)) {
				 
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
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#relieving_<?php echo $row["id"];?>">Relieving</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#salary_<?php echo $row["id"];?>">Salary</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail_<?php echo $row["id"];?>">Student Detail</a>
                    </div>
                </li>
                
                <!-- Appraisal form Modal-->
                <div class="modal fade" id="exampleModalCenter_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="recordSave" autocomplete="off">
                                  
                                    <div class="form-group">
                                        <label for="ctc">CTC 3</label>
                                        <input type="text" class="form-control" value="<?php echo $row["emp_ctc3"]; ?>" readonly>
                                          <input type="hidden" class="form-control" name="id" value="<?php echo $row["id"]; ?>" >
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="newctc">New CTC</label>
                                        <input type="number" class="form-control" name="newctc" placeholder="Enter New CTC">
                                    </div>
                                    <div class="form-group">
                                        <label for="appraisal">Appraisal Date</label>
                                        <input type="text" class="form-control datepicker"  name="appraisaldate" placeholder="Appraisal Date">
                                    </div>
                                    <div class="form-group">
                                        <label for="degination">New Designation</label>
                                        <input type="text" class="form-control" name="newdesignation" value="<?php  echo (isset($row['emp_newdesignation'])?$row['emp_newdesignation']:""); ?>" placeholder="New Designation">
                                    </div>
                                    	<input type="hidden" name="recordAction" value="recordSave"/>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="relieving_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                 
                                    <div class="form-group">
                                        <label for="aproval">Date of Relieving</label>
                                        <input type="text" class="form-control" id="datepicker1" name="" placeholder="Relieving Date">
                                    </div>
                                 
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                            </div>
                        </div>
                  </div>
                </div>

                <div class="modal fade" id="salary_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                     <div class="form-group">
                                            <ul class="list-calender" style="color:black;">
                                                <?php 
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
                                                    
                                            </ul>
                                        </div>
								
									
                                        <div class="form-group">
                                            <label for="pwd">Salary Slips Year</label>
                                                <select class="form-control select-from"  name="slipsyear" >
                                                    <option value="">Select Year</option> 
                                                    <option value="<?php echo $row['emp_slipsyear'];?>"><?php echo $row['emp_slipsyear'];?></option>
													
														<?php for ($x = 2000; $x <= 2022; $x++){ ?>
														<option value="<?php echo "$x";?>" <?php if(isset($x) && $x==$row['emp_slipsyear'] ){ echo "selected"; } ?>><?php echo "$x";?></option>	  	
														<?php } ?>
												</select>
                                        </div>
                                  
                                    
                                        <div class="form-group">
                                            <label for="pwd">Net Pay Amount</label>
                                            <input type="number" class="form-control my-from" name="netpay" value="<?php  echo (isset($row['emp_current_salary'])?$row['emp_current_salary']:"");  ?>" placeholder="Enter Net Pay" onkeypress="return isNumberKey(event);">
                                        </div>
                                    
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="detail_<?php echo $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover table-responsive" id="data-table-dashbaords">
                                    <thead>
                                        <tr class="top-table1">
                                          <th>SL No.</th>
                                          <th>Name</th>
                                          <th>Date</th>
                                          <th>New CTC</th>
                                          <th>New Appracsal Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 </td>
                                            <td><?php echo $row["emp_name"];?></td>
                                           <td>16-06-2022 </td>
                                          <td>30000</td>
                                          <td>1-4-2023</td>
                                         
                                         </tr>
                                     </tbody>
                                     </table>     
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
        $( "#datepicker" ).datepicker();
        
        } );
         $( function() {
        $( "#datepicker1" ).datepicker();
        
        } );

            $(".recordSave").submit(function(e){ 
               
        	e.preventDefault();	 
            //alert('test');
         
        	if(!$.fn.registrvalidate(this)){		 
        		return false;	
        	}    
        	//var data=$(this).serialize();
        	  var data=new FormData(this);
        
        		$.ajax({
        			url: "/admin/action.php",
        			data: data,
        			type:"POST",	
        			cache: false,
        			contentType: false,
        			processData: false,			
        			success:function(response){
        				alert(response);
        				 var obj = JSON.parse(response);
        				 		// alert(obj.last_id);
        				if(obj.status){
                            $("#messagemodel").modal();
                          	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
        			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                            $('#successmessage').modal({backdrop:"static",keyboard:false});
        					 //window.location.reload();
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
            	
            	if(status){
            		return false;
            	}
            return true;
            } 
     
     
    });
    
  </script> 
  
  
</body>

</html>