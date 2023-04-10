<?php
 $title = 'Dashboard Certificate'; 
include "config.php";
include 'header.php';?>


			<!--<div class="add-comapny">
                <a href="#" data-toggle="modal" data-target="#exampleModal">Add Company</a>
            </div>-->
        <div class="part-name"> <h2>Dashboard</h2> </div>
            
            <!-- <div class="add-company">
              <a href="#">Add New Company</a>
            </div> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data-table-dashbaords">
                            <thead>
                                <tr>
                                    <th>ID s</th>
                                    <th>EMP ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Designation </th>
                                    <th>Compay Name </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                			<?php //$sql = "SELECT * FROM emp_records where status=0 order by des";
                				$sql = "SELECT * FROM emp_records ORDER BY id DESC";
                				$result = mysqli_query($con_exp, $sql);
                				while ($row = mysqli_fetch_assoc($result)) {
                			?>
                                <tr>
                                    <td><?php echo $row["id"];?> </td>
                                    <td><?php echo $row["emp_id"];?> </td>
                                    <td><?php echo $row["emp_name"];?> </td>
                                    <td><?php echo $row["emp_phone"];?></td>
                                    <td><?php echo $row["emp_designation"];?></td>
                                    <td><?php echo $row["emp_company"];?></td>
                                    <td>
                                      <?php if($row["status"]=='0'){ ?>
                				        <a href="edit_student_company.php?edit=<?php echo $row['id']; ?>"><span><i class="fas fa-dot-circle red"></i></span> </a> 
                				        <?php  }else{ ?>
                				        <a href="edit_student_company.php?edit=<?php echo $row['id']; ?>"><span><i class="fas fa-dot-circle green"></i></span> </a> 
                				  
                				        <?php } ?>
                				        <?php if($row["status"]=='1'){ ?>
                				        <a href="student_company.php?detail=<?php echo $row['id']; ?>"><span><i class="fas fa-arrow-alt-circle-right red"></i></span></a>
                				        <?php } ?>&nbsp;
                				         <!--<?php if($row["status"]=='1'){ ?>
                				        <a href="student_company.php?detail=<?php echo $row['id']; ?>"><span><i class="fa fa-trash red"></i></span></a>
                				        <?php } ?>-->
                				      
                				    </td>
                				        <!--<td><a href="index.php?edit=<?php //echo $row['id']; ?>" class="edit_btn" >Edit</a></td>
                				        <td><a href="server.php?del=<?php //echo $row['id']; ?>" class="del_btn">Delete</a></td>-->
                                </tr>
                				<?php } ?>
                
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row" style="margin-top:20px">
                    <div class="col-lg-3">
                    <form role="form" method="POST" action="dashboard-excel-download.php" >
                    
                   
                    <button type="submit" name="export" value="export" class="btn btn-success  btn-block move-not-interested">Export as Excel</button>
                    
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 

  <!-- Footer -->
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
        
        
        var deleteRow = function(id){
            alert("asdf");
            $.ajax({    
                type: "GET",
                url: "action.php", 
                data:data,            
			    type:"POST",                  
                success: function(response){   
                   	 var obj = JSON.parse(response);
				    if(obj.status){
                        $("#successmessage").modal();
                      	$('.imgclass').html('<img src="./img/Thanks_Reaching_Us.jpg" style="width: 96%;text-align: center;margin: auto;display: block;">');			
    			    	$('.successhtml').html("<p class='text-center' style='color:green'>"+obj.msg+"</p>");	
                        $('#successmessage').modal({backdrop:"static",keyboard:false});
                        $this.find('.valid_error').remove();
    				}else{
        				$("#successmessage").modal('show');
        				$('.imgclass').html('<img src="./img/message_alert.png" style="width: 96%;text-align: center;margin: auto;display: block;">');			
        				$('.failedhtml').html("<p class='text-center' style='color:red'>"+obj.msg+"</p>");	
        				$('#successmessage').modal({backdrop:"static",keyboard:false});
    				}
			    }
            });
        };
        
     
    });
  </script>
  
  
</body>

</html>