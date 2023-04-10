<!DOCTYPE html>
<?php if(isset($_SESSION['id'])){}else{ echo header("location:index.php"); } ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">   
 
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
       </head>
	<style>
		.valid_error{
		   color:red;
		   font-size: 12px;
		}
	</style>

<body class="bg-new">
  <div class="myfrom-center2">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-12">
          <div class="form-bg-section3">
            <!-- <h2 class="mb-3">Data  Table </h2> -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="manage_companies.php">Manage Company</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="record.php">Record</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#passwordmodal">Change Password</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </nav>
            
                <!-- CHange Password Modal -->
              <div class="modal fade" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
						<form method="post" class="changePass">
							<label for="">Old Password*</label>
							<input type="Password" name="currentPassword" class="form-control" placeholder="Enter Old Password">
							<label for="">New Password*</label>
							<input type="Password" name="newPassword" class="form-control" placeholder="Enter New  Password">
							<label for="">Confirm Password*</label>
							<input type="Password" name="confirmPassword" class="form-control" placeholder="Enter Confirm Password">
							<!--<div class="modal-footer">
								<input type="hidden" name="changepwd" value="changePass"/>			
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>-->
							<div class="modal-footer">
								<input type="hidden" name="password" value="changePass"/>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
                       </form>
                    </div>   
                  </div>
                </div>
              </div>
               <!-- Change Password End  -->
 