

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Thanku</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<style>
			.bg-thankyou
			{
				background-image: url(img/thbackground.svg);

				background-size: 100%;
			}
			.center-content {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}
.details-thankyou > h2
{
	font-size: 32px;
    margin: 20px 0px;
    font-weight: 700;
}
.details-thankyou > p{
font-size: 15px;
color: #363636;

}
.btn-pink-gradient
{
	background: linear-gradient(45deg,#F10594,#0299E9);
    color: #fff;
    border: none;
	transition: 0.5s;
    padding: 7px 28px;
}
.btn-pink-gradient:hover
{
	color: #fff;
	background: linear-gradient(45deg,#0299E9,#F10594);
}
.details-thankyou >span {
    display: block;
    font-size: 15px;
    padding-top: 60px;
    color: #949494;
}
		</style>
    </head>
    <body class="bg-thankyou">

		<section class="thankyou-page-section center-content">

			<div class="container">
					<div class="details-thankyou">
                      <img src="img/message.svg" alt="message" class="img-fluid">
					  <h2>Thank you for Submitting!</h2>
					  <p>Your request has been successfully submitted<br>
						You can track your request after 24 Hours.</p>
					  <a href="logout.php" class="btn btn-pink-gradient"><img src="img/arrowbtn-th.svg" class="img-fluid mr-1">Logout</a>
					  <span>if you have any issues <strong style="color: #363636;">contact us.</strong></span>


					</div>


			</div>

		</section>

		<!-- JS here -->

        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
