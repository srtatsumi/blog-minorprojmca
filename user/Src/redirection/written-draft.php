<head><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head>
<?php
session_start();
include "../includes/config.inc.php";

$obj=new Config;
$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[blog_id]'");
$row=$sql->fetch_assoc();
// var_dump($_SESSION['blog_id']);
// echo "<br>";
// var_dump($_REQUEST);
 if($row==null){ //never drafted before
 	$covpic=null;
	$result=$obj->save_draft($_SESSION['blog_id'],$_REQUEST['title'],$_REQUEST['category'],$covpic,$_REQUEST['editor'],$_SESSION['user_id']);
	var_dump($result);
	if($result){
		echo "
		<script>
		alert('You post is saved as draft!  Images will not been saved in drafts');
		window.location= '../timeline.php';
		// swal('Your post is saved as draft!', 'Images will not been saved in drafts', 'success').then(window.location= '../timeline.php');
		</script>
		";
 	}else{
		echo "
		<script>
		alert('Error in saving draft');
		window.location= '../write_blog.php';
		</script>
		";
	}
}else{
	$covpic=null;
	$result=$obj->save_draft($_SESSION['blog_id'],$_REQUEST['title'],$_REQUEST['category'],$covpic,$_REQUEST['editor'],$_SESSION['user_id'],'1');
	var_dump($result);
	if($result){
		echo "
		<script>
		alert('You post is saved as draft!  Images will not been saved in drafts');
		window.location= '../timeline.php';
		// swal('Your post is saved as draft!', 'Images will not been saved in drafts', 'success').then(window.location= '../timeline.php');
		</script>
		";
 	}else{
		echo "
		<script>
		alert('Error in saving draft');
		window.location= '../write_blog.php';
		</script>
		";
	}
}

?>