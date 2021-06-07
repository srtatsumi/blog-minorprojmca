<head><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head>
<?php 
	session_start();
	include "../includes/config.inc.php";
	// echo $_SESSION['blog_id'];

	$obj=new Config;

	$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[blog_id]'");
	$row=$sql->fetch_assoc();
	// var_dump();

	$result=$obj->remove_draft($_SESSION['blog_id']);
	if($result){
			echo "
			<script>
			alert('Draft has been removed!');
			window.location= '../write_blog.php';
			</script>
			";
	}
?>