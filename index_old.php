<?php 
	//include "config.php";
   ob_start();
   session_start();

?>

  <?php   
    if (isset($_POST['sign']) ) {
			$phone = $_POST['phone'];    
            if($phone){
				//echo "mobile number save";
				echo"<script> window.location.href = 'registration.php';</script>";
				$_SESSION['phone'] = $phone; 
			}else{
				echo "error data insert ";
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
							<form action="" method="POST">
								<div>
									<input type="number" name="phone" required="" class="user-id" id="user_login" value="" size="20" 0="off">
									<i class="fal fa-phone-volume"></i><label>Enter your Mobile Number </label>
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
    </body>
</html>
