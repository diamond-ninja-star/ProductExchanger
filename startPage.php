<?php
$check=session_status();
if($check==PHP_SESSION_ACTIVE)
{
    session_unset();
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>ProdutExchanger</title>
	<!-- ONLINE -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- OFFLINE -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- FAVICON -->
	<link rel="icon" type="image/ico" href="assets/images/faviconLogoMain2.1.ico"/>
</head>

<body style="color: white ; background-color: #000000 ; ">
	<!-- ONLINE -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- OFFLINE -->
	<script src="assets/bootstrap/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<h1 align="center">
        WELCOME TO <span style="color: orange">Product</span><span style="color: lightblue">Exchanger</span>
    </h1>
	
		<br>
	</div>

	<div class="container">
		<h2 align="center">
        OUR SERVICES
    </h2>
	
		<br>
		<div class="row">
			<div class="col-sm-6" style="text-align: center">
				<img class="center-block img-rounded img-responsive" src="assets/images/buy.png" style="background-color: red">
				<h3 align="center">BUY</h3>
				<p align="center">BUY FROM OUR ADs</p>
			</div>
			<div class="col-sm-6" style="text-align: center">
				<img class="center-block img-rounded img-responsive" src="assets/images/sell.png" style="background-color: blue">
				<h3 align="center">SELL</h3>
				<p align="center">POST YOUR OWN ADs</p>
			</div>
		</div>
	</div>
	<br>

	<div class="container " style="text-align: center">
		<h4 align="center ">PLEASE SIGN IN OR SIGN UP TO CONTINUE</h4>
	</div>
	<br>

	<div class="container " style=" text-align: center ">
		<button type="submit" class="btn btn-success btn-lg " name="signInSI " onclick="location='signinPage.php'">
        SIGN IN
    </button>
	
	</div>
	<br>

	<div class="container " style="text-align: center ">
		<button type="submit" class="btn btn-primary btn-lg " name="signUpSU " onclick="location='signupPage.php'">
        SIGN UP
    </button>
	
	</div>
	<br>

</body>

</html>