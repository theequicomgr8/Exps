<?php session_start(); 
 ob_start();
?>
<?php
	
	if(!$_SESSION['username'])
	
{?>
<script type="text/javascript">

window.location = "index.php";

</script>
<?php } ?>
<?php include "config.php"; ?>

<?php
/* $query="SELECT   cc_posts.* FROM cc_posts  INNER JOIN cc_postmeta ON ( cc_posts.ID = cc_postmeta.post_id ) WHERE 1=1  AND ( 
  cc_postmeta.meta_key = 'course_select'
) AND cc_posts.post_type = 'course_pdf' AND (cc_posts.post_status = 'publish' OR cc_posts.post_status = 'acf-disabled' OR cc_posts.post_status = 'private') GROUP BY cc_posts.ID ORDER BY cc_posts.post_date DESC"; */

//$query= "select * from cc_posts where `post_type`='certifications'";
$qry = mysqli_query($conn,"select * from cc_posts where `post_type`='courses' OR `post_type`='certifications' ");
//$qry = mysqli_query($conn,$query);
//$qry = mysqli_query($conn,$query);
$args = [
	"post_type"=>"course_pdf",
	"posts_per_page"=>-1,
	   'meta_query' => array(
		array(
			'key' => 'course_select',
			//'value' => sprintf(':"%s";',$post->ID),
			'compare' => 'LIKE',
		)
	)   
];
//$result = mysqli_fetch_assoc($qry);
?>
<table>
<?php
$i=1;
while($row = mysqli_fetch_array($qry))	
{
	$i++;
	
	?>

<tr style="background: #ccc; font-size:14px;">

<td><?php echo $row['ID']; ?></td>
<td><?php echo $row['post_title']; ?></td>
 
</tr>
<?php } 
?>
</table>
<?php 
//echo "<pre>";print_r($result);
$directory = 'uploads/';
if(isset($_POST['create_company']))
{

	$comp_name = $_POST['comp_name'];
	$comp_address = $_POST['comp_address'];
        $comp_address2 = $_POST['comp_address2'];
        $hr_name = $_POST['hr_name'];
	//$comp_phone = $_POST['comp_phone'];
        //$comp_mob= $_POST['comp_mob'];
	//$comp_website = $_POST['comp_website'];
	//$city_postalcode = $_POST['city_postalcode'];
	//$state_country = $_POST['state_country'];
	//$job_title = $_POST['job_title'];
	//$candi_email = $_POST['candidate_email'];
	//$department = $_POST['department'];
	//$manager_name = $_POST['manager_name'];
	//$manager_job_title = $_POST['manager_job_title'];
	//$manager_phone = $_POST['manager_phone'];
	//$manager_email = $_POST['manager_email'];
	
	//$hr_phone = $_POST['hr_phone'];
	//$hr_email = $_POST['hr_email'];
	//$comp_strength = $_POST['comp_strength'];
	//$hirerchary_comp = $_POST['hirerchary_comp'];
	//$proj_running = $_POST['proj_comp'];
	//$notice_period = $_POST['notice_period'];
	//$reporting_contact = $_POST['reporting_contact'];
	//$colleague_name = $_POST['colleague_name'];
	//$comp_technology = $_POST['comp_technology'];
	//$about_comp = $_POST['about_comp'];
        //$comp_domain = $_POST['comp_domain'];
	
	if($_FILES['comp_logo']['tmp_name'] != '')
	{
		$temp_name = $_FILES['comp_logo']['tmp_name'];
		$act_name = $_FILES['comp_logo']['name'];
		$img = uniqid(). '_' .$act_name;
		$dirupload = $directory.$img;
                move_uploaded_file($temp_name, $dirupload);
		$videos = $img;
		
        }

$qry = mysqli_query($con,"INSERT INTO companies(comp_name,comp_logo,comp_address,company_address2,hr_name,created_at) VALUES('".$comp_name."','".$videos."','".$comp_address."','".$comp_address2."','".$hr_name."','".date('d-m-Y')."')");
	
	//$qry = mysql_query("INSERT INTO companies(comp_name,comp_logo,comp_address,comp_phone,comp_mob,comp_website,city_postalcode,state_country,job_title,candi_email,department,manager_name,manager_job_title,manager_phone,manager_email,hr_name,hr_phone,hr_email,comp_strength,hirerchary_comp,proj_running,notice_period,reporting_contact,colleague_name,comp_technology,comp_domain,about_comp,created_at) VALUES('".$comp_name."','".$videos."','".$comp_address."','".$comp_phone."','".$comp_mob."','".$comp_website."','".$city_postalcode."','".$state_country."','".$job_title."','".$candi_email."','".$department."','".$manager_name."','".$manager_job_title."','".$manager_phone."','".$manager_email."','".$hr_name."','".$hr_phone."','".$hr_email."','".$comp_strength."','".$hirerchary_comp."','".$proj_running."','".$notice_period."','".$reporting_contact."','".$colleague_name."','".$comp_technology."','".$comp_domain."','".$about_comp."','".date('d-m-Y')."')");


	
	if($qry)
	{
		header("location: add-company.php?msg=success");
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css"  href="css/style.css" /> 
<title>:: Croma Campus Application ::</title>


</head>

<body>
<div id="wrapper">

<div id="header">
<a href="dashboard.php" title="Dashboard"><img src="images/Logo.png" alt="" border="0" id="logo"></a>
<div id="right-section"><a href="#">Add New Company</a> | <a href="logout.php">Logout</a></div> 
</div>

<div id="mainpage">
<div style="float:right; margin-top:10px;"><a href="manage-companies.php">Manage Companies</a></div>
<br>
<center>
<h2>Create Company</h2>
</center>

<div id="expform">
<br>
<span style="color:#0C0; text-align:center; font-size: 17px;"><?php if(isset($_REQUEST['msg'])) { echo "Company has been successfully created."; } ?></span>
<br><br>
<form method="post" action="" enctype="multipart/form-data" id="frmid">

Company Name<br />
<input type="text" name="comp_name" class="frmfld" />
<br />

Company Logo<br />
<input type="file" name="comp_logo" class="frmfld" />
<br />

Company Address1<br />
<input type="text" name="comp_address" class="frmfld" />
<br />

Company Address2<br />
<input type="text" name="comp_address2" class="frmfld" />
<br />

<!--Company Phone No.<br />
<input type="text" name="comp_phone" class="frmfld" />
<br />

Company Mobile No.<br />
<input type="text" name="comp_mob" class="frmfld" />
<br />


Company Website<br />
<input type="text" name="comp_website" class="frmfld"  />
<br />

City & Postal Code<br />
<input type="text" name="city_postalcode" class="frmfld"  />
<br />

State & Country<br />
<input type="text" name="state_country" class="frmfld" />
<br />

Job Title<br />
<input type="text" name="job_title" class="frmfld" />
<br />

Candidate Email Address<br />
<input type="text" name="candidate_email" class="frmfld" />
<br />

Department<br />
<input type="text" name="department" class="frmfld" />
<br />

Manager Name<br />
<input type="text" name="manager_name" class="frmfld" />
<br />

Manager Job Title<br />
<input type="text" name="manager_job_title" class="frmfld" />
<br />

Manager Phone No.<br />
<input type="text" name="manager_phone" class="frmfld" />
<br />

Manager E-Mail Id<br />
<input type="text" name="manager_email" class="frmfld" />
<br />-->

HR Manager Name<br />
<input type="text" name="hr_name" class="frmfld" />
<br />

<!-- HR Manager Phone No.<br />
<input type="text" name="hr_phone" class="frmfld" />
<br />

HR Manager E-Mail Id<br />
<input type="text" name="hr_email" class="frmfld" />
<br />

Company Strength<br />
<input type="text" name="comp_strength" class="frmfld" />
<br />

Hirerchary in your Company<br />
<input type="text" name="hirerchary_comp" class="frmfld" />
<br />

Projects running in your Company<br />
<input type="text" name="proj_comp" class="frmfld" />
<br />

Notice Period<br />
<input type="text" name="notice_period" class="frmfld" />
<br />

Reporting Point of Contact<br />
<input type="text" name="reporting_contact" class="frmfld" />
<br />

Name of the colleague working with you.<br />
<input type="text" name="colleague_name" class="frmfld" />
<br />

On which Technology Company is working?<br />
<input type="text" name="comp_technology" class="frmfld" />
<br />

Company Domain<br />
<input type="text" name="comp_domain" class="frmfld" />
<br />

About Company<br />
<input type="text" name="about_comp" class="frmfld" />
<br />-->


<br />

<input type="submit" name="create_company" id="create_company" class="frmbuttn" value="Create Company" />





</form>

</div>
</div>
</div>
</body>
</html>