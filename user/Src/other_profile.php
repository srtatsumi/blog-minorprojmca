<?php

session_start();
include('./includes/config.inc.php');

$obj=new Config;

$sql=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_GET[id]'");
$row=$sql->fetch_assoc();
// var_dump($row);
$profile['user_name']= $row["user_name"];
$profile['user_age']= $row["user_age"];
$profile['user_mail']= $row["user_mail"];
$profile['user_phn']= $row["user_phn"];

// this session variable is initialised because after updation the new values will be put to the session varible instead of the old values
 ?>
<!DOCTYPE html>
<html>
<head>
		<!-- Bootstrap -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!-- Bootstrap -->


		<!--Materialize Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<!-- Materialize Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

		<!-- Font Awesome CDN -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">


		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">


		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="./Styles/common.css">
		<link rel="stylesheet" type="text/css" href="./Styles/profile.css">
</head>
<body>
	<!-- nav bar starts -->
	<nav style="background-color: white; position:sticky; top:0;z-index: 999;">
		<div class = "nav-wrapper black navi">   
		    <a href="index.php">Writeurthought.com</a>
		    <ul id="nav-mobile" class="right hide-on-med-and-down">
		        <!-- <li> <a href="index.php">Home</a></li> -->
		        <li>
		        	<div class="dropdown">
					  <i class="fas fa-align-justify" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
					  <div class="dropdown-menu black" aria-labelledby="dropdownMenuButton" >
					  	<a href="index.php" class="dropdown-item">Blog</a>
					    <!-- <a onclick="myFunction()" class="dropdown-item" href="#section2">Edit Profile</a>
					    <a href="redirection/remove-pic.php" class="dropdown-item">Remove Profile Pic.</a> -->
					  </div>
					</div>
		        </li>
		    </ul>
		</div>
	</nav>
	<!-- nav bar ends -->

	<section id="section1">
		<div class="container" style="background-color: #E8E8E8">
			<div style="position: absolute;top:50%;left: 50%;transform: translate(-50%, -50%);">
				<div class="profile_pic">
					<img src="
					<?php 
						if(is_null($row['user_pic'])){
							echo "./Images/avatar.png";
						}else{
							echo "./Images/Profile_Images/".$row['user_pic'];
							// var_dump($row['user_pic']);
						}
					?>
					" alt="Avatar" style="width:200px;">
				</div>
				<hr style="background-color: #000000">
				<div style="text-align: center;">
					<label>Name: <?php echo $profile['user_name'] ?> </label>
					<br>
					<label>Age: <?php echo $profile['user_age'] ?> </label>
					<br>
					<label>Mail: <?php echo $profile['user_mail'] ?> </label>
					<br>
					<label>Phone: <?php
						if(is_null($profile['user_phn'])){
							echo 'NO PHONE NUMBER';
						}else{
							echo $profile['user_phn'];
						}
					  ?> </label>
				</div>
			</div>
		</div>
	</section>
<!-- <script type="text/javascript">
	function myFunction() {
		var sec1 = document.getElementById("section1");
		var sec2 = document.getElementById("section2");
		if (sec2.style.display === "none") {
		  sec2.style.display = "block";
		  sec1.style.display = "none";
		} else {
		  sec2.style.display = "none";
		  sec1.style.display = "block";
		}
	}
 
</script> -->
</body>
</html>