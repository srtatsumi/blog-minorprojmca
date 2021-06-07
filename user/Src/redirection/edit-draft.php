<head><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head>
<?php
session_start();
include "../includes/config.inc.php";

$obj=new Config;
$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[edit_blog_id]'");
$row=$sql->fetch_assoc();
// var_dump($_SESSION);
// echo "<br>";
// var_dump($_REQUEST);

if($row['blog_covpic']!=null){ //published before
	// var_dump($row['blog_covpic']);
	if (file_exists("../Images/Cover_Images/$row[blog_covpic]")) {
		$rows=1;
    	$result=$obj->save_draft($_SESSION['edit_blog_id'],$_REQUEST['title'],$_REQUEST['category'],$row['blog_covpic'],$_REQUEST['editor'],$_SESSION['user_id'],$rows);
    	var_dump($result);
    	if($result){
    		echo "
			<script>
			alert('Draft has been saved');
			window.location = '../timeline.php';
			</script>
			";
    	}else{
    		echo "
			<script>
			alert('Blog cannot be published. ');
			window.history.back();
			</script>
			";
    	}
    }else{
    	echo "
		<script>
		alert('Cannot saved draft');
		// window.location = '../edit_blog.php?id=$_SESSION[edit_blog_id]';
		</script>
		";
    }
}

?>