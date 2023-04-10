 
 		 <div id="successmessage" class="modal fade" role="dialog" data-backdrop="static"><div class="modal-dialog"><div class="modal-content">
<div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
</button> <div class="imgclass"></div><div class="successhtml"></div> <div class="failedhtml"></div>
<div class="nit-form">
</div>
<button type="submit" class="closeok btn btn-success" style="width:40%;margin-left: 30%;">Ok</button>
</div>

</div></div></div>	   
	
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="js/main.js"></script>

  <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>-->

  
	
    <div class="modal fade" id="messagemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <div class="imgclass"></div>
    <div class="successhtml"></div>
     <div class="failedhtml"></div>
    </div>
    
    </div>
    </div>
    </div>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62b6ae187b967b1179966dbd/1g6cpg44c';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
$(document).ready(function () {
  $(".changePass").submit(function(e){ 
	e.preventDefault();	 
	 
	if(!$.fn.passvalidate(this)){
		return false;	
	}   
	var data=$(this).serialize();
	  //var data=new FormData(this);
		$.ajax({
			url: "/admin/action.php",
			data: data,
			type:"POST",	
			//cache: false,
			//contentType: false,
			//processData: false,			
			success:function(response){
			    var obj = JSON.parse(response);
				if(obj.status==true){
                $("#successmessage").modal('show');
                $("#exampleModal").modal();
                $('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 100%;text-align: center;margin: auto;display: block;">');					
                $('.successhtml').html("<p class='text-center' style='font-weight: 600;'>Successfully Password changed.</p>");
                $('#successmessage').modal({backdrop:"static",keyboard:false});
				$this.find('.valid_error').remove(); 					
				}else{
				   
				$("#successmessage").modal('show');
				$('.imgclass').html('<img src="./img/message_alert.png" style="width: 50%;text-align: center;margin: auto;display: block;">');			
				$('.failedhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
				$('#successmessage').modal({backdrop:"static",keyboard:false});
				}
			}
		});
	});

 
$.fn.passvalidate=function(t){
	$(".valid_error").remove(); 
	 
	var status = 0;	 
	if($(t).find("input[name=\"currentPassword\"]").length==1 && $(t).find("input[name=\"currentPassword\"]").val()==""){
		$(t).find("input[name=\"currentPassword\"]").after("<div class='valid_error'>Old Password is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"newPassword\"]").length==1 && $(t).find("input[name=\"newPassword\"]").val()==""){
		$(t).find("input[name=\"newPassword\"]").after("<div class='valid_error'>New Password is mandatory.</div>")
		status = 1;
	}
	 if($(t).find("input[name=\"confirmPassword\"]").length==1 && $(t).find("input[name=\"confirmPassword\"]").val()==""){
		$(t).find("input[name=\"confirmPassword\"]").after("<div class='valid_error'>Repeat Password is mandatory.</div>")
		status = 1;
	}
	
	if(status){
		return false;
	}
	return true;
}	
});


$(".closeok").click(function(){
location.reload(true);
});
</script>