<!doctype html>
<?php 
 $title = 'Edit Student Company'; 
	//session_start();
	include "config.php";
 
	if(isset($_GET['dellogo']) ){
		$id= $_GET['dellogo']; 
		$res="SELECT * FROM `companies` where id=$id"; 
		$qry = mysqli_query($con_exp,$res);
		$results = mysqli_fetch_assoc($qry);
		if(!empty($results)){ 
			if (file_exists($results['comp_logo']))
			{
				unlink($results['comp_logo']);
				$resupdate="UPDATE `companies` SET comp_logo='' WHERE id=$id" ;
				$qryses = mysqli_query($con_exp,$resupdate);
				if($qryses){
					header("location:/admin/edit_manage_companies.php?edit=".$id);
				}
			}else{
				header('location:/admin/edit_manage_companies.php?edit='.$id);
			}
		}
	}
 
 
 
	if(isset($_GET['delheader']) ){
		$id= $_GET['delheader']; 
		$res="SELECT * FROM `companies` where id=$id"; 
		$qry = mysqli_query($con_exp,$res);
		$results = mysqli_fetch_assoc($qry);
		if(!empty($results)){ 
			if (file_exists($results['comp_letterhead_header']))
			{
				unlink($results['comp_letterhead_header']);
				$resupdate="UPDATE `companies` SET comp_letterhead_header='' WHERE id=$id" ;
				$qryses = mysqli_query($con_exp,$resupdate);
				if($qryses){
					header("location:/admin/edit_manage_companies.php?edit=".$id);
				}
			}else{
				header('location:/admin/edit_manage_companies.php?edit='.$id);
			}
		}
	}
 
 
	if(isset($_GET['delfooter']) ){
		$id= $_GET['delfooter']; 
		$res="SELECT * FROM `companies` where id=$id"; 
		$qry = mysqli_query($con_exp,$res);
		$results = mysqli_fetch_assoc($qry);
		if(!empty($results)){ 
			if (file_exists($results['comp_letterhead_footer']))
			{    
				unlink($results['comp_letterhead_footer']);
				$resupdate="UPDATE `companies` SET comp_letterhead_footer='' WHERE id=$id" ;
				$qryses = mysqli_query($con_exp,$resupdate);
				if($qryses){
					header("location:/admin/edit_manage_companies.php?edit=".$id);
				}
			}else{
				header('location:/admin/edit_manage_companies.php?edit='.$id);
			}
		}
	}
	
	if(isset($_GET['cstamp']) ){
		$id= $_GET['cstamp']; 
		$res="SELECT * FROM `companies` where id=$id"; 
		$qry = mysqli_query($con_exp,$res);
		$results = mysqli_fetch_assoc($qry);
		if(!empty($results)){ 
			if (file_exists($results['comp_stamp']))
			{    
				unlink($results['comp_stamp']);
				$resupdate="UPDATE `companies` SET comp_stamp='' WHERE id=$id" ;
				$qryses = mysqli_query($con_exp,$resupdate);
				if($qryses){
					header("location:/admin/edit_manage_companies.php?edit=".$id);
				}
			}else{
				header('location:/admin/edit_manage_companies.php?edit='.$id);
			}
		}
	}
	
	if(isset($_GET['stamp']) ){
		$id= $_GET['stamp']; 
		$res="SELECT * FROM `companies` where id=$id"; 
		$qry = mysqli_query($con_exp,$res);
		$results = mysqli_fetch_assoc($qry);
		if(!empty($results)){ 
			if (file_exists($results['salaryslip_stamp']))
			{    
				unlink($results['salaryslip_stamp']);
				$resupdate="UPDATE `companies` SET salaryslip_stamp='' WHERE id=$id" ;
				$qryses = mysqli_query($con_exp,$resupdate);
				if($qryses){
					header("location:/admin/edit_manage_companies.php?edit=".$id);
				}
			}else{
				header('location:/admin/edit_manage_companies.php?edit='.$id);
			}
		}
	}
	
?>


	<?php include 'header.php';?>
	
    
        <div class="myfrom-center">
            <div class="container form-bg-section">
               
				 <?php  
				 
				 if(isset($_GET['edit'])){
				 $id = $_GET['edit'];
				 }else{
					$id=""; 
				 }
				 //echo $id; die;
					$record = "SELECT * FROM companies WHERE id='".$id."'";
					//echo $record;		
					$result = mysqli_query($con_exp, $record);
					
					//echo "<pre>"; print_r($result); die;
		 
				
			/* 	$query = "SELECT * from new_record where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result); */


?>
				
				
				 <?php
						while($row = mysqli_fetch_assoc($result))
						{
							
						?>
                <div class="row">
				<div class="col-lg-12">
                    <?php //echo "<pre>"; print_r($row); die;?> 
                        <form action="#" method="post" class="editCompany" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control">
							<div class="row">
								<div class="col-sm-6">
									<label for="">Enter Company Name*</label>
									<input type="text" name="comp_name" value="<?php echo $row['comp_name']; ?>" required class="form-control" placeholder="Enter Company name">
								</div>
								<div class="col-lg-6">
									<label for="">Company Abbreviation*</label>
									<input type="text" name="comp_abbr" value="<?php echo $row['comp_abbreviation']; ?>" required class="form-control" placeholder="Enter Company Abbreviation">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<label for="">Choose Logo*</label>
									 
									<?php if($row['comp_logo']){  ?>
									<img src="../admin/<?php echo $row['comp_logo']; ?>" width="100" height="100" > 
									<a href="edit_manage_companies.php?dellogo=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete"><i class="fa fa-trash" style="color:red;"></i></a>
									<input type="hidden" name="comp_logo" value="<?php echo $row['comp_logo']; ?>" class="form-control">
									<?php  }else{ ?>
									<input type="file"  name="comp_logo" value="" class="form-control">
									<?php  } ?>
								</div>
								<div class="col-lg-6">	
									<label for="">Letter Head Header</label>
									<?php if($row['comp_letterhead_header']){  ?>
									<img src="../admin/<?php echo $row['comp_letterhead_header']; ?>" width="100" height="100">
									<a href="../admin/edit_manage_companies.php?delheader=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" ><i class="fa fa-trash" style="color:red;"></i></a>
									<input type="hidden"  name="comp_letterhead_header" value="<?php echo $row['comp_letterhead_header']; ?>" class="form-control">
									<?php  }else{ ?>
									<input type="file" name="comp_letterhead_header" value="" class="form-control">
									<?php } ?>
								</div>
								</div>
								<div class="row">
								<div class="col-lg-6">		
									<label for="">Letter Head Footer</label>
									<?php  
								 
									if($row['comp_letterhead_footer']){  ?>
									<img src="../admin/<?php echo $row['comp_letterhead_footer']; ?>" width="100" height="100">
									<a href="../admin/edit_manage_companies.php?delfooter=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
									<input type="hidden"  name="comp_letterhead_footer" value="<?php echo $row['comp_letterhead_footer']; ?>" class="form-control">
									<?php }else{ ?>
									<input type="file" name="comp_letterhead_footer" value="" class="form-control">
									<?php } ?>	
								 
							 </div>
						
								<div class="col-lg-6">
									<label for="">Company Stamp*</label>
									<?php if($row['comp_stamp']){  ?>
									<img src="../admin/<?php echo $row['comp_stamp']; ?>" width="100" height="100"> 
									<a href="../admin/edit_manage_companies.php?cstamp=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
									<input type="hidden" name="comp_stamp" value="<?php echo $row['comp_stamp']; ?>" class="form-control">
									<?php }else{ ?>
									<input type="file"  name="comp_stamp"  class="form-control">
									<?php } ?>
									
								</div>
								</div>
									<div class="row">
								<div class="col-lg-12">	
									<label for="">Salary Slips Stamp</label>
									<?php if($row['salaryslip_stamp']){  ?>
									<img src="../admin/<?php echo $row['salaryslip_stamp']; ?>" width="100" height="100">
									<a href="../admin/edit_manage_companies.php?stamp=<?php echo $row['id']; ?>" class="btn btn-inverse btn-circle m-b-5 delete" target="_blank"><i class="fa fa-trash" style="color:red;"></i></a>
									<input type="hidden"  name="salaryslip_stamp" value="<?php echo $row['salaryslip_stamp']; ?>" class="form-control">
									<?php }else{ ?>
									<input type="file" name="salaryslip_stamp" class="form-control">
									<?php } ?>
								</div>			
							</div>
							<div class="row">
								<div class="col-lg-4">	
									<label for="">Company Address-1*</label>
									<input type="text" name="comp_address" value="<?php echo $row['comp_address']; ?>" required class="form-control" placeholder="Enter Company Address-1">
								</div>
								<div class="col-lg-4">
									<label for="">Company Address-2*</label>
									<input type="text" name="company_address2" value="<?php echo $row['company_address2']; ?>" required class="form-control" placeholder="Enter Company Address-2">
								</div>
								<div class="col-lg-4">	
									<label for="">HR Manager Name*</label>
									<input type="text" name="hr_name" value="<?php echo $row['hr_name']; ?>" required class="form-control" placeholder="Enter HR Name">
								</div>
							</div>
						    <div class="modal-footer">
								<input type="hidden" name="companyUpdate" value="editcompany"/>
								<button type="submit" class="btn btn-primary">Edit changes</button>
							</div>
						</form>
                    </div>
                    </div>
                   
                
				 <?php } ?>
            </div>
        </div>
	


 
 <?php include 'footer.php';?>
 

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
	  
	$(".editCompany").submit(function(e){ 
 
	e.preventDefault();	 
 
	if(!$.fn.registrvalidate(this)){		 
		return false;	
	}   
	//var data=$(this).serialize();
	
	 var data=new FormData(this);
		$.ajax({
			 url: "action.php",
			data: data,
			type:"POST",	
			cache: false,
			contentType: false,
			processData: false,				
			success:function(response){ 
		 			 var obj = JSON.parse(response);
					 
					 //alert(obj.status);
				if(obj.status){
                    $("#successmessage").modal();
                  	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                    $('#successmessage').modal({backdrop:"static",keyboard:false});
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
	
	
	if($(t).find("input[name=\"comp_name\"]").length==1 && $(t).find("input[name=\"comp_name\"]").val()==""){
		$(t).find("input[name=\"comp_name\"]").after("<div class='valid_error'>Company Name is mandatory.</div>")
		status = 1;
	}
	
	 if($(t).find("input[name=\"comp_abbr\"]").length==1 && $(t).find("input[name=\"comp_abbr\"]").val()==""){
		$(t).find("input[name=\"comp_abbr\"]").after("<div class='valid_error'>Company Abbreviation mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"comp_logo\"]").length==1 && $(t).find("input[name=\"comp_logo\"]").val()==""){
		$(t).find("input[name=\"comp_logo\"]").after("<div class='valid_error'>Company Logo is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"comp_letterhead_header\"]").length==1 && $(t).find("input[name=\"comp_letterhead_header\"]").val()==""){
		$(t).find("input[name=\"comp_letterhead_header\"]").after("<div class='valid_error'>Company header is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"comp_letterhead_footer\"]").length==1 && $(t).find("input[name=\"comp_letterhead_footer\"]").val()==""){
		$(t).find("input[name=\"comp_letterhead_footer\"]").after("<div class='valid_error'>Company Footer is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"comp_stamp\"]").length==1 && $(t).find("input[name=\"comp_stamp\"]").val()==""){
		$(t).find("input[name=\"comp_stamp\"]").after("<div class='valid_error'>Company Stamp is mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"salaryslip_stamp\"]").length==1 && $(t).find("input[name=\"salaryslip_stamp\"]").val()==""){
		$(t).find("input[name=\"salaryslip_stamp\"]").after("<div class='valid_error'>Company salary slip stamp is mandatory.</div>")
		status = 1;
	} 
	
	if($(t).find("input[name=\"comp_address\"]").length==1 && $(t).find("input[name=\"comp_address\"]").val()==""){
		$(t).find("input[name=\"comp_address\"]").after("<div class='valid_error'>Company Address is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"company_address2\"]").length==1 && $(t).find("input[name=\"company_address2\"]").val()==""){
		$(t).find("input[name=\"company_address2\"]").after("<div class='valid_error'>Company Address2 is Mandatory.</div>")
		status = 1;
	}
	if($(t).find("input[name=\"hr_name\"]").length==1 && $(t).find("input[name=\"hr_name\"]").val()==""){
		$(t).find("input[name=\"hr_name\"]").after("<div class='valid_error'>HR Name is Mandatory.</div>")
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