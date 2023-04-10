<?php 
 $title = 'Delete'; 
include 'header.php';?>
<?php 
	//session_start();
	include "config.php";
?>
<?php 
	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		//echo $id; 
		$delete = mysqli_query($con_exp, "DELETE FROM emp_records WHERE id=$id");
		if($delete){
			echo "delete succ.";
			//header('location: datatable.php');
			echo "<script> window.location.href = 'datatable.php';</script>";
		}else{
			echo "delete data error.";
		}
		//$_SESSION['message'] = "Address deleted!"; 
		
	}
?>