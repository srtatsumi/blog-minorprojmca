<?php 
session_start();
if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
	include ('../includes/config.inc.php');
	$obj=new Config;
	$mail= $_REQUEST['email'];
	$pass= $_REQUEST['password'];
	$sql =$obj->conn()->query("SELECT * FROM users WHERE user_mail='$mail' AND password='$pass'");
	$row = $sql->fetch_assoc();
	$result = $obj->login($_REQUEST['email'],$_REQUEST['password']);
	if($row['is_banned']!='1' && $row['is_deleted']!='1'){
		if($result)
		{
			$_SESSION['user_id']=$row['user_id'];
			$_SESSION['user_name']=$row['user_name'];
			$_SESSION['user_age']=$row['user_age'];
			$_SESSION['user_mail']=$row['user_mail'];
			$_SESSION['user_phn']=$row['user_phn'];
			$_SESSION['user_pic']=$row['user_pic'];
			$_SESSION['is_banned']=$row['is_banned'];
			$_SESSION['is_deleted']=$row['is_deleted'];
			$_SESSION['is_active']=$row['is_active'];
			echo "
			<script>
			alert('Welcome $_SESSION[user_name] ');
			window.location = '../index.php';
			</script>
			";
		}
		else{
			echo "
			<script>
			alert('Wrong Information Provided');
			window.location = '../login.php';
			</script>
			";
		}
	}else if($row['is_banned']==1){
		echo "
		<script>
		alert('You cannot enter!! You are banned from the platform');
		window.location = '../login.php';
		</script>
		";
	}else if($row['is_deleted']==1){
		echo "
		<script>
		alert('No user found!!');
		window.location = '../login.php';
		</script>
		";
	}
	
}


?>