<?php	 
	include "config.php";
?>
<?php 
 $id= $_GET['delfooter'];
 
 //echo $id;die;
  $res="SELECT * FROM `companies` where id=$id";
  
  //echo $res;die;
$qry = mysqli_query($con_exp,$res);
 $results = mysqli_fetch_assoc($qry);
// echo "<pre>";print_r($results);die;
if(!empty($results)){
    //echo $results['comp_logo'];die;
    if (file_exists($results['comp_letterhead_footer']))
    {
      //  echo "inner";die;
    unlink($results['comp_letterhead_footer']);
    $resupdate="UPDATE `companies` SET comp_letterhead_footer='' WHERE id=$id" ;
    $qryses = mysqli_query($con_exp,$resupdate);
    }
    
   
    
	echo "Delete successfully wait for<br><br>Redirecting...";
	?>
	<script>
		window.setTimeout(function(){
			window.location.href = '/admin/manage_companies.php';
		},5000);
	</script>
	<?php
  
} 

?>