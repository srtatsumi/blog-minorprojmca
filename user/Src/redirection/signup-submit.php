<?php
if (isset($_REQUEST['user_mail']) && isset($_REQUEST['password'])){
	include('../includes/config.inc.php');
	$rows=new Config;
	$row =$rows->conn()->query("SELECT * FROM users");
	$row_cnt=$row->num_rows+1;
	$uid=date("ymd").$row_cnt;
	// echo $uid;

	$result = $rows->signup($uid,$_REQUEST['user_name'],$_REQUEST['user_age'],$_REQUEST['user_mail'],$_REQUEST['password'],$_REQUEST['cpassword']);

	// var_dump($result);
	if($result == 1){
		echo "
		<script>
		alert('Successfully Created an account');
		window.location = '../login.php';
		</script>
		";
	}
	if($result == 2){
		echo "
		<script>
		alert('Password No matched');
		window.location = '../signup.php';
		</script>
		";
	}
	if ($result == 0) {
		echo "
		<script>
		alert('Try Again');
		window.location = '../signup.php';
		</script>
		";
	}
}

?>