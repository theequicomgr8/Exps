<?php 
 $title = 'Company List'; 
include "config.php";
include 'header.php';?>

			<div class="add-comapny">
                <a href="#" data-toggle="modal" data-target="#exampleModal">Add Company</a>
            </div>
			 <!-- Add Company Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" class="companySave"  enctype="multipart/form-data">
							        <label for="">Enter Company Name*</label>
							        <input type="text" name="comp_name" class="form-control" placeholder="Enter Company Name">
							        <label for="">Company Abbreviation*</label>
                                    <input type="text" name="comp_abbr" value="" class="form-control" placeholder="Enter Company Abbreviation">
							        <label for="">Choose Logo*</label>
							        <input type="file" name="comp_logo" class="form-control">
                                    <label for="">Company Letter Head Header*</label>
                                    <input type="file" name="comp_letterhead_header" class="form-control">
                                    <label for="">Company Letter Head Footer*</label>
                                    <input type="file" name="comp_letterhead_footer" class="form-control">
                                    </br>
							        <label for="">Company Address-1*</label>
							        <input type="text" name="comp_address" class="form-control" placeholder="Enter Comapny Address -1">
							        <label for="">Company Address-2*</label>
							        <input type="text" name="company_address2" class="form-control" placeholder="Enter Company Address-2">
							        <label for="">HR Manager Name*</label>
							        <input type="text" name="hr_name" class="form-control" placeholder="Enter HR Name">
							        <div class="modal-footer">
								        <input type="hidden" name="action" value="companySave"/>
								        <button type="submit" class="btn btn-primary">Save changes</button>
							        </div>
                                </form>
					        </div>   
                        </div>
                    </div>
                </div>
				<style>
				   .valid_error{
					   color:red;
					   font-size: 12px;
				   }
				</style>
               <!-- Add Company Modal End  -->
			  
			   <!-- Edit Company Modal -->
             
               <!-- Edit Company Modal End  -->

				<div class="part-name"> <h2>Manage Company</h2> </div>

             <!-- Change Password End  -->
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
            <table class="table table-hover table-responsive" id="myTable">
                <thead>
			  <?php  
					//index.php
					$query = "SELECT * FROM companies ORDER BY id DESC";
					$result = mysqli_query($con_exp, $query);
				?>  
                    <tr class="top-table1">
                        <th>Company Name</th>
				        <th>Company Abbreviation</th>
                        <th>Company Address-1</th>
                        <th>Company Address-2</th>
                        <th>Company HR </th>
                        <th> Status </th>
                    </tr>
                </thead>
            <tbody>
					 <?php
						while($row = mysqli_fetch_array($result))
						{
							//echo "<pre>"; print_r($row); die;
						?>
                    <tr>
                        <td><?php echo $row['comp_name']; ?></td>
				        <td><?php echo $row['comp_abbreviation'];?></td>
                        <td><?php echo $row['comp_address']; ?></td>
                        <td><?php echo $row['company_address2']; ?></td>
                        <td><?php echo $row['hr_name']; ?></td>
                        <!--<td><a href="#" data-toggle="modal" data-target="#exampleModalEdit">Edit</a> <!--/ <a href="#">Delete</a>--><!--</td>--> 
                        
				        <td>
				              <a href="edit_manage_companies.php?edit=<?php echo $row['id']; ?>">Edit </a> 
				           <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalEdit_<?php echo $row['id'];?>" >Edit</a>
				        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalstamp_<?php echo $row['id'];?>" >Stamp</a>    
				        <div class="modal fade" id="exampleModalEdit_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" method="post" class="editcompany" enctype="multipart/form-data">
						                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control">
						                        <label for="">Enter Company Name*</label>
                                                <input type="text" name="comp_name" value="<?php echo $row['comp_name']; ?>" required class="form-control" placeholder="Enter Company name">
                                                <label for="">Company Abbreviation*</label>
                                                <input type="text" name="comp_abbr" value="<?php echo $row['comp_abbreviation']; ?>" required class="form-control" placeholder="Enter Company Abbreviation">
                                                <label for="">Choose Logo*</label>
						                        <?php if($row['comp_logo']){  ?>
						                        <img src="/admin/<?php echo $row['comp_logo']; ?>" width="100" height="100"> 
						                        <a href="/admin/deletelogo.php?dellogo=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
                                                <input type="hidden" name="comp_logo" value="<?php echo $row['comp_logo']; ?>" class="form-control">
                                                <?php  }else{ ?>
                                                <input type="file"  name="comp_logo" value="" class="form-control">
                                                <?php  } ?>
						                        </br> 
						                        <!--<label for="">Choose Logo*</label>
						                        <?php // if($row['comp_logo']){  ?>
						                        <img src="./<?php //echo $row['comp_logo']; ?>" width="100" height="100"> 
                                                <input type="file"  name="comp_logo" value="<?php //echo $row['comp_logo']; ?>" class="form-control">
						                        <?php//  }else{ ?>
						                        <input type="file" name="comp_logo" value="" class="form-control">
						                        <?php // } ?>
						                        </br>-->
						                        <!--<label for="">Letter Head Header</label>
						                        <?php if($row['comp_letterhead_header']){  ?>
						                        <img src="/admin/<?php echo $row['comp_letterhead_header']; ?>" width="100" height="100">
						                        <a href="/admin/deleteheader.php?delheader=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
                                                <input type="hidden"  name="comp_letterhead_header" value="<?php echo $row['comp_letterhead_header']; ?>" class="form-control">
						                        <?php  }else{ ?>
						                        <input type="file" name="comp_letterhead_header" value="" class="form-control">
						                        <?php  } ?>
						                        </br>
						                        <label for="">Letter Head Footer</label>
						                        <?php if($row['comp_letterhead_footer']){  ?>
						                        <img src="/admin/<?php echo $row['comp_letterhead_footer']; ?>" width="100" height="100">
						                        <a href="/admin/deletefooter.php?delfooter=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
                                                <input type="hidden"  name="comp_letterhead_footer" value="<?php echo $row['comp_letterhead_footer']; ?>" class="form-control">
						                        <?php  }else{ ?>
						                        <input type="file" name="comp_letterhead_footer" value="" class="form-control">
						                        <?php  } ?>
						                        </br>
                                                <label for="">Company Address-1*</label>
                                                <input type="text" name="comp_address" value="<?php echo $row['comp_address']; ?>" required class="form-control" placeholder="Enter Company Address-1">
                                                <label for="">Company Address-2*</label>
                                                <input type="text" name="company_address2" value="<?php echo $row['company_address2']; ?>" required class="form-control" placeholder="Enter Company Address-2">
                                                <label for="">HR Manager Name*</label>
                                                <input type="text" name="hr_name" value="<?php echo $row['hr_name']; ?>" required class="form-control" placeholder="Enter HR Name">
						                        <div class="modal-footer">
						                            <input type="hidden" name="update" value="editcompany"/>
						                            <button type="submit" class="btn btn-primary">Edit changes</button>
						                        </div>
						                    </form>
					                   </div>   	 
                                    </div>
                                </div>
                            </div>
               <div class="modal fade" id="exampleModalstamp_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Stamp (<?php echo $row['comp_name']; ?>)</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form action="#" method="post" class="addStamp" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $row['id'];?>">
						    <label for="">Edit Company Stamp*</label>
                            <input type="file" name="comp_stamp" value="" required class="form-control" placeholder="">
                       	    <div class="modal-footer">
						        <input type="hidden" name="action" value="addStamp"/>
						        <button type="submit" class="btn btn-primary">Save</button>
						    </div>
						</form>
					</div>   	 
					
					<div class="modal-body">
                       <form action="#" method="post" class="salaryStamp" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $row['id'];?>">
						    <label for="">Edit Salary Slips Stamp*</label>
                            <input type="file" name="salaryslip_stamp" value="" required class="form-control" placeholder="">
                       	    <div class="modal-footer">
						        <input type="hidden" name="action" value="salaryStamp"/>
						        <button type="submit" class="btn btn-primary">Save</button>
						    </div>
						</form>
					</div>   	 
                </div>
                </div>
              </div>-->
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
      $('#myTable').DataTable();
    });
  </script>

<script>
 $(".companySave").submit(function(e){ 
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
				//alert(response);
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
	if($(t).find("input[name=\"comp_name\"]").length==1 && $(t).find("input[name=\"comp_name\"]").val()==""){
		$(t).find("input[name=\"comp_name\"]").after("<div class='valid_error'>Company Name is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"comp_abbr\"]").length==1 && $(t).find("input[name=\"comp_abbr\"]").val()==""){
		$(t).find("input[name=\"comp_abbr\"]").after("<div class='valid_error'>Company Name is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"comp_logo\"]").length==1 && $(t).find("input[name=\"comp_logo\"]").val()==""){
		$(t).find("input[name=\"comp_logo\"]").after("<div class='valid_error'>Company logo is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"comp_letterhead\"]").length==1 && $(t).find("input[name=\"comp_letterhead\"]").val()==""){
		$(t).find("input[name=\"comp_letterhead\"]").after("<div class='valid_error'>Company logo is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"comp_address\"]").length==1 && $(t).find("input[name=\"comp_address\"]").val()==""){
		$(t).find("input[name=\"comp_address\"]").after("<div class='valid_error'>Company Address 1 is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"company_address2\"]").length==1 && $(t).find("input[name=\"company_address2\"]").val()==""){
		$(t).find("input[name=\"company_address2\"]").after("<div class='valid_error'>Company Address 2 is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"hr_name\"]").length==1 && $(t).find("input[name=\"hr_name\"]").val()==""){
		$(t).find("input[name=\"hr_name\"]").after("<div class='valid_error'>HR Manager Name is mandatory.</div>")
		status = 1;
	}
	
	if(status){
		return false;
	}
	return true;
}	


  $(".editcompany").submit(function(e){ 
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
				//alert(response);
			//	return false;
				 var obj = JSON.parse(response);
				 		// alert(obj.last_id);
				if(obj.status){
				    
				       $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    $this.find('.valid_error').remove();
                  	}else{
				  	$this.find('.valid_error').remove();
					
					  $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
			    	$('.failedhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    
				}
			}
		});
	});
	
	 $(".addStamp").submit(function(e){ 
	e.preventDefault();	 
	//alert('test');
 
	/*if(!$.fn.registrvalidate(this)){		 
		return false;	
	}*/    
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
				//alert(response);
			//	return false;
				 var obj = JSON.parse(response);
				 		// alert(obj.last_id);
				if(obj.status){
				    
				       $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    $this.find('.valid_error').remove();
                  	}else{
				  	$this.find('.valid_error').remove();
					
					  $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
			    	$('.failedhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    
				}
			}
		});
	});
 
 
    $(".salaryStamp").submit(function(e){ 
	e.preventDefault();	 
	
	  var data=new FormData(this);

		$.ajax({
			url: "/admin/action.php",
			data: data,
			type:"POST",	
			cache: false,
			contentType: false,
			processData: false,			
			success:function(response){
				//alert(response);
			//	return false;
				 var obj = JSON.parse(response);
				 		// alert(obj.last_id);
				if(obj.status){
				    
				       $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    $this.find('.valid_error').remove();
                  	}else{
				  	$this.find('.valid_error').remove();
					
					$("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
			    	$('.failedhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
                    
				}
			}
		});
	});

</script>

</body>
</html>