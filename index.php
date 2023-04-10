<?php 

  ob_start();
 //error_reporting(0);
   session_start();
//include "config.php";
$messages = array( 'err_1'  => '<strong>Mobile</strong> field cannot be empty','err_2'  => 'Mobile Number does not exist in our database','err_3'  => 'Your certificate has been approved, Please contact to manager','err_4'  => 'Your certificate has been approved, Please contact to manager','err_5'  => 'Your certificate has been approved, Please contact to manager',);
$err_code = array();
$message = '';
?>

  <?php   
     /* if (isset($_POST['sign']) ) {
			$phone = $_POST['phone'];    
            if($phone){
				//echo "mobile number save";
				echo"<script> window.location.href = 'registration.php';</script>";
				$_SESSION['phone'] = $phone; 
			}else{
				echo "error data insert ";
			}       
    }  */
  ?>
  
 
	<?php 
	//error_reporting( ~E_DEPRECATED & ~E_NOTICE);
		if(isset($_POST['sign']))
			{
			    
                if( isset($_POST['mobile']) && !empty($_POST['mobile']) ) {
                $mobile = $_POST['mobile'];
                }else {
                
                $status = 1;
                $err_code[] = 'err_1';
                }
                
                if( !$status ) {
                    $mobile = $_POST['mobile'];
                    //echo "<pre>"; print_r( $_POST['phone']);
                    $con = mysqli_connect("103.53.40.64","cromag8l_fees","cromag8l_fees@123#","cromag8l_fees");
                    $sql = "select * from wp_associate_details where mobile = '$mobile'";
                    //echo $sql; 
                    $query = mysqli_query($con,$sql);
                    $row = mysqli_fetch_assoc($query);
                    $rowcount = mysqli_num_rows($query);
                    if($rowcount > 0){
                        if($row['approved'] =='' || $row['approved']=='No'){
                            // echo "<pre>"; print_r($row); echo "end";die;
                            $con_exp = mysqli_connect("103.53.40.64","cromag8l_exps","cromag8l_exps","cromag8l_exps");
                            $sqle = "select * from  emp_records where emp_phone = '$mobile'" ;
                            $querye = mysqli_query($con_exp,$sqle);
                            $rowe = mysqli_fetch_assoc($querye);
                            $rowcounte = mysqli_num_rows($querye);
                            if($rowcounte > 0){
                                if($rowe['status'] =='0' ){
                                   echo"<script> window.location.href ='registration.php';</script>";
                                    $_SESSION['mobile'] = $mobile;   
                                }else{
                                    $status = 1;
                              $err_code[] = 'err_4';
                                }
                            }else{
                                 echo"<script> window.location.href ='registration.php';</script>";
                                    $_SESSION['mobile'] = $mobile;   
                                
                              //  $status = 1;
                              //$err_code[] = 'err_5';
                            }
                           
                        }else{
                              $status = 1;
                              $err_code[] = 'err_3';
                        }
                    }else{
                   // echo "Your Certificate already Please contect to Manager";
                    $status = 1;
                    $err_code[] = 'err_2';
                    }
                }
			}
	
	
	
	
	?>
 
  
 
  
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Site Title Here</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

    </head>
    <body>
		<div class="myfrom-signin">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-5">
						<div class="form-bg-section box1">
							<div class="mb-4 text-center fees-heading">
								<h4>Sign In </h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div>
									<input type="number" name="mobile" required="" class="user-id" id="user_login" value="" size="20" 0="off">
									<i class="fal fa-phone-volume"></i><label>Enter your Mobile Number </label>
									<?php if( $status === 1 ){ ?>
					<div class="alert alert-danger alert-dismissable" role="alert">
					    <button aria-hidden="true" data-dismiss="alert" class="close" type="button" aria-label="Close">×</button>
					    <?php
						foreach( $err_code as $e_code ) {

							if( array_key_exists( $e_code, $messages )  ) {

								$message .= $messages[$e_code] . "<br>";
							}
						}
						echo $message;
					    ?>
					</div>
					<?php  } ?>
								</div>
								<p class="submit mt-2 mb-0">
									<input type="submit" name="sign" id="wp-submit" class="button button-primary button-large" value="Sign In">		
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- JS here -->

        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/jquery.js"></script>
    </body>
</html>
