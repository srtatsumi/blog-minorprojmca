<?php
session_start();
//echo '$_SESSION['user_mail']';
if(!empty($_SESSION['user_mail'])){
	header('location:index.php');
	exit();
}
?>
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
				margin-top: 5%
			}
			[type="checkbox"].filled-in:checked+span:not(.lever):after{
				background-color: #0000e6;
			}
			.waves-effect.waves-blue .waves-ripple {
				background-color: rgba(30, 136, 229, 0.7);
			}
			input[type=email]:not(.browser):focus:not([readonly])+label{
				color:#d7e2f2;
				
			}
			input[type=email]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #d7e2f2;
				box-shadow: 0 1px 0 0 #d7e2f2;
			}
			input[type=email]:not(.browser-default){
				border-bottom: 1px solid black;
			}
			input[type=password]:not(.browser):focus:not([readonly])+label{
				color:#d7e2f2;
				
			}
			input[type=password]:not(.browser):focus:not([readonly]){
				border-bottom:2px solid #d7e2f2;
				box-shadow: 0 1px 0 0 #d7e2f2;

			}
			input[type=password]:not(.browser-default){
				border-bottom: 1px solid black;
			}
		</style>
	</head>
	<body style="background-color: #d7e2f2">
		<div class="container " style="box-shadow: 0px 4px 47px -1px #0005;padding: 0px">

			<div class="row" style="background-image:linear-gradient(to right,white 0%,blue 100%), url('./Images/19007.jpg');
			background-repeat: no-repeat;
			background-size:100% 100%;background-blend-mode: soft-light;">
				<div class="col-sm" >
					<div style="font-family: Laila;font-style: normal;font-weight: 300;font-size: 25px;position: relative;top:4%;">Writeurthought.com</div>
					<h2 style="color: #000080"><b>LOGIN</b></h2>
					<h1 style="font-size: 20px;color: grey">Welcome back! Please login to your account.</h1>
					<form class="col s12" action="./redirection/login-verify.php">
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" name="email" class="validate">
								<label for="email" style="color: blue">Email ID</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name="password" class="validate">
								<label for="password" style="color: blue">Password</label>
							</div>
						</div>
						<div class="d-flex">
							<!-- <label style="margin-top: 7px;">
								<input type="checkbox" class="filled-in blue" checked="checked" />
								<span style="color: blue">Remember Me</span>
							</label>
							<a href="forgot.php" class="waves-effect waves-blue btn-flat ml-auto" style="text-transform: initial;margin-top: -1px; color: blue; text-decoration: none">Forgot Password?</a> -->
						</div>
						<br>
						<button class="btn btn-primary blue darken-1" name="submit" style="margin-bottom:10px ">Login</button>
						<button class="btn btn-light blue darken-1" style="margin-bottom:10px " formaction="./signup.php">Signup</button>
					</form>
				</div>
				<div class="col-sm">
					<div class="d-flex justify-content-center" style="position: relative;top:3%;left:35%">
						<a href="index.php" style="color: black;background-color: transparent;text-decoration: none;">
							<i class="fas fa-home" style="font-size: 50px"></i>
						</a>
					</div>
					<div style="width:100%;margin-top: 45px">
						<img src="./Images/login.png" style="width: 100%">
					</div>
				</div>
			</div>
			
		</body>
	</html>