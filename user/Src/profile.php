<?php

session_start();
include('./includes/config.inc.php');

if(empty($_SESSION['user_mail'])){
		header('location:login.php');
		exit();
	}

$obj=new Config;

$sql=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
$row=$sql->fetch_assoc();
$_SESSION['user_name']= $row["user_name"];
$_SESSION['user_age']= $row["user_age"];
$_SESSION['user_mail']= $row["user_mail"];
$_SESSION['user_phn']= $row["user_phn"];

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
					    <a onclick="myFunction()" class="dropdown-item" href="#section2">Edit Profile</a>
					    <a href="redirection/remove-pic.php" class="dropdown-item">Remove Profile Pic.</a>
					  </div>
					</div>
		        </li>
		    </ul>
		</div>
	</nav>
	<!-- nav bar ends -->
	<?php 
	$user=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
	$check=$user->fetch_assoc();
	$_SESSION['is_active']=$check['is_active'];
	$_SESSION['is_banned']=$check['is_banned'];
	$_SESSION['is_deleted']=$check['is_deleted'];
	if($_SESSION['is_active']==0 && $_SESSION['is_banned']==1){ ?>
		<div class="banned_div"><h3>You have been Banned!! Wait for 3 days to get unbanned!!</h3></div>
	<?php }elseif ($_SESSION['is_active']==0 && $_SESSION['is_deleted']==1) { ?>
		<div class="banned_div"><h3>You have been deleted!!</h3></div>
	<?php }else{?>
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
						<label>Name: <?php echo $_SESSION['user_name'] ?> </label>
						<br>
						<label>Age: <?php echo $_SESSION['user_age'] ?> </label>
						<br>
						<label>Mail: <?php echo $_SESSION['user_mail'] ?> </label>
						<br>
						<label>Phone: <?php
							if(is_null($_SESSION['user_phn'])){
								echo 'NO PHONE NUMBER';
							}else{
								echo $_SESSION['user_phn'];
							}
						  ?> </label>
					</div>
				</div>
			</div>
		</section>
		<section id="section2" style="display: none;">
			<div class="container" style="background-color: #E8E8E8">
				<div class="column" style="margin-left: 30%;">
					<div class="col-sm-8">
						<img src="
						<?php 
							if(is_null($row['user_pic'])){
								echo "./Images/avatar2r.png";
							}else{
								echo "./Images/Profile_Images/".$row['user_pic'];
							}
						?>" alt="Avatar" style="width:200px;">
						<br>
						<form class="col s12" enctype="multipart/form-data" method="post">
							<input type="file" id="myfile" name="user_pic" accept="image/*" style="margin-left: -4%">
							<div class="input-field col s12" style="margin-left: -10%">
								<input id="text" type="text" class="validate" name="user_name" value="<?php echo $_SESSION['user_name'] ?>">
								<label for="text" style="color: black">USER NAME</label>
							</div>
							<div class="input-field col s12" style="margin-left: -10%">
								<input id="email" type="email" class="validate" name="user_mail" value="<?php echo $_SESSION['user_mail'] ?>">
								<label for="email" style="color: black">EMAIL ID</label>
							</div>
							<div class="input-field col s12" style="margin-left: -10%">
								<input id="number" type="number" class="validate" name="user_age" value="<?php echo $_SESSION['user_age'] ?>">
								<label for="text" style="color: black">AGE</label>
							</div>
							<div class="input-field col s12" style="margin-left: -10%">
								<input id="number" type="number" class="validate" name="user_phn" value="<?php
									if(is_null($_SESSION['user_phn'])){
										?>0000000000<?php
									}else{
										echo $_SESSION['user_phn'];
									}
								  ?>">
								<label for="text" style="color: black">PHONE NUMBER</label>
							</div>
							<br>
							<div align="center">
								<button class="btn btn-outline-dark" style="background-color: black;margin-right: 35%" formaction="./redirection/profile-update.php">SAVE</button>
		  					</div>
	  					</form>
	  				</div>
	  			</div>
		</section>
	<?php }?>
<script type="text/javascript">
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
 
</script>
</body>
</html>