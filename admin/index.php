<?php  

	include "config.php";
?>
<?php 
 
	$messages = array('err_1'  => '<strong>Mobile</strong> Does not exit in database','succ_1' => 'Student Registered Successfully.',);
    $err_code = array();
    $message = '';
    $status = 0;
  
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Admin Login</title>
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
            <div class="form-bg-section box1" style="width:unset;">
                
                <div class="mb-4 text-center fees-heading">
  <h4>Login 
  </h4>
  
              </div>
   
 <?php  // echo $result; die; ?>
				<form action="action.php" method="post">
				<?php if( $status === 1 ): ?>
				<div class="alert alert-danger alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<?php
				foreach( $err_code as $e_code ) {

				if( array_key_exists( $e_code, $messages )  ) {

				$message .= $messages[$e_code] . "<br>";
				}
				}
				echo $message;
				?>
				</div>
				<?php endif ?>	
				<div>
				<input type="text" name="user_name" required="" class="user-id" id="user_login" value="" size="20" 0="off">
				<i class="fal fa-phone-volume"></i><label>Enter your User Name </label>
				</div>
				<div>
				<input type="password" name="user_pass" required="" class="user-id" id="user_login" value="" size="20" 0="off">
				<i class="fal fa-phone-volume"></i><label>Enter your Password </label>
				</div>

				<p class="submit mt-2 mb-0">
				<input type="submit" name="login" id="wp-submit" class="button button-primary button-large" value="Login">
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
    </body>
</html>
