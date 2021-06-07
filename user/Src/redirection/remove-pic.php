<?php 
session_start();
include('../includes/config.inc.php');

$obj=new Config;

$sql=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
$row=$sql->fetch_assoc();

// echo $row['user_pic'];
$id=$row['user_id'];
$pic=$row['user_pic'];

if(!is_null($row['user_pic'])){
	$result=$obj->remove_pic($id,$pic);
	if($result){
		if(file_exists("../Images/Profile_Images/".$pic)){
			unlink("../Images/Profile_Images/".$pic);
		}
		echo "
		<script>
		alert('Your Profile Pic has been deleted successfully');
		window.location = '../profile.php';
		</script>
		";
	}else{
		echo "
		<script>
		alert('Some error occured.');
		window.location = '../profile.php';
		</script>
		";
	}
}else{
	echo "
	<script>
	alert('Your Profile Pic has already been deleted.');
	window.location = '../profile.php';
	</script>
	";
}


?>