<head><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head>
<?php 
	session_start();
	include "../includes/config.inc.php";
	// echo $_SESSION['blog_id'];

	$obj=new Config;

	$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_GET[id]'");
	$row=$sql->fetch_assoc();
	if($row['blog_covpic']){
		$result=$obj->remove_blog($_GET['id'],$row['blog_covpic']);
	}else{
		$result=$obj->remove_blog($_GET['id']);
	}
	
	if($result){
			echo "
			<script>
			alert('Blog has been removed!');
			window.location= '../timeline.php';
			</script>
			";
	}
?>