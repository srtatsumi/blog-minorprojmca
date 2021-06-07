<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<!-- Font Awesome CDN -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<style type="text/css">
			.container{
				margin-top: 2%
			}
			[type="checkbox"].filled-in:checked+span:not(.lever):after{
				background-color: 	#e00606;
			}
			.waves-effect.waves-red .waves-ripple {
				background-color: rgb(224, 6, 6);
			}
			input[type=text]:not(.browser):focus:not([readonly])+label{
				color: #e00606;
			}
			input[type=text]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #e00606;
				box-shadow: 0 1px 0 0 #e00606;
			}
			input[type=text]:not(.browser-default){
				border-bottom: 1px solid black;
			}
			input[type=age]:not(.browser):focus:not([readonly])+label{
				color:#e00606;
			}
			input[type=age]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #e00606;
				box-shadow: 0 1px 0 0 #e00606;
			}
			input[type=text]:not(.browser-default){
				border-bottom: 1px solid black;
			}
			input[type=email]:not(.browser):focus:not([readonly])+label{
				color:#e00606;
			}
			input[type=email]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #e00606;
				box-shadow: 0 1px 0 0 #e00606;
			}
			input[type=email]:not(.browser-default){
				border-bottom: 1px solid black;
			}
			input[type=password]:not(.browser):focus:not([readonly])+label{
				color:#e00606;
			}
			input[type=password]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #e00606;
				box-shadow: 0 1px 0 0 #e00606;
			}
			input[type=password]:not(.browser-default){
				border-bottom: 1px solid black;
			}
			input[type=confirmpassword]:not(.browser):focus:not([readonly])+label{
				color:#e00606;
			}
			input[type=confirmpassword]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #e00606;
				box-shadow: 0 1px 0 0 #e00606;
			}
			input[type=confirmpassword]:not(.browser-default){
				border-bottom: 1px solid black;
			}


			.row{
				margin-bottom: -10px; 
			}
		</style>
	</head>
	<body style="background-color: #66ffb3">
		<div class="container " style="box-shadow: 0px 4px 47px -1px #0005;padding: 0px">
			<div class="row" style="background-image:linear-gradient(to right,white 0%,red 0%), url('./Images/10730.jpg');
			background-repeat: no-repeat;
			background-size:100% 100%;background-blend-mode: soft-light;">
				<div class="col-sm">
					<div style="font-family: Laila;font-style: normal;font-weight: 300;font-size: 25px;position: relative;top:4%;">Writeurthought.com</div>
					<h2 style="color: #e00606"><b>SIGNUP</b></h2>
					<h1 style="font-size: 20px;color: black">Register with us to share your beautiful thoughts!</h1>
					<form class="col s12" action="./redirection/signup-submit.php">
						<div class="row">
							<div class="input-field col s12">
								<input id="name" name="user_name" type="text" class="validate">
								<label for="name" style="color: black">Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="age" name="user_age" type="text" class="validate">
								<label for="age" style="color: black">Age</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="emailaddress" type="email" name="user_mail" class="validate">
								<label for="emailaddress" style="color: black">Email Address</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name="password" class="validate">
								<label for="password" style="color: black">Password</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="confirmpassword" type="password" name="cpassword" class="validate">
								<label for="confirmpassword" style="color: black">Confirm Password</label>
							</div>
						</div>
						<br>
						<button class="btn btn-primary red" style="margin-bottom:10px " >Signup</button>
						<button class="btn btn-light red" style="margin-bottom:10px " formaction="login.php">Login</button>
					</form>
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center" style="position: relative;top:3%;left:35%">
						<a href="index.php" style="color: black;background-color: transparent;text-decoration: none;">
							<i class="fas fa-home" style="font-size: 50px"></i>
						</a>
					</div>
					<div style="width:100%;margin-top: 45px">
						<img src="./Images/signup.png" style="width: 100%">
					</div>
				</div>
			</div>
		</body>
	</html>