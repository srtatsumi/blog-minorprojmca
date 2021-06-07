<?php
//fetch.php
// $_POST["post_id"]='210212124221';
// $_POST["action"]="unban";
// $_POST["user_id"]='2101281';
// echo $_POST["post_id"];
// echo $_POST["action"];
if(isset($_POST["post_id"]) && isset($_POST["action"]))
{
	include('../includes/config.inc.php');
	$rows=new Config;
	
	if($_POST["action"]=="view"){
		$result =$rows->conn()->query("SELECT * FROM blog WHERE blog_id='$_POST[post_id]' ");
		$output = '';
		while($row = $result->fetch_assoc()){
		    $obj3=new Config;
		    $sql1=$obj3->conn()->query("SELECT * FROM users WHERE user_id='$row[blog_by]'");
		    $row1=$sql1->fetch_assoc();
		    if($row["blog_covpic"]){
		      $output .= '
		      <h4>'.$row["blog_title"].'</h4>
		      <p><label>Author By - '.$row1["user_name"].'</label></p>
		      <p><img src="../../../../../Minor Project SS/user/Src/Images/Cover_Images/'.$row["blog_covpic"].'" style="width:50%"></p>
		      <p>'.$row["blog_content"].'</p>
		      ';
		    }else{
		      $output .= '
		      <h4>'.$row["blog_title"].'</h4>
		      <p><label>Author By - '.$row["blog_by"].'</label></p>
		      <p><img src="./Images/noimage.jpeg" style="width:50%"></p>
		      <p>'.$row["blog_content"].'</p>
		      ';
		    } 
		}
		echo $output;
	}else if($_POST["action"]=="ban"){
		$result =$rows->conn()->query("UPDATE blog SET is_approved=NULL,is_published=NULL,is_banned=1 WHERE blog_id='$_POST[post_id]'");
		$result1=$rows->conn()->query("DELETE FROM likes WHERE blog_id='$_POST[post_id]");
		if($result && $result1){
			$output= "<h3>Banned</h3>";
			echo $output;
		}else{
			$output= "<h3>Error</h3>";
			echo $output;
		}// is_approve and is_published=null, is_banned=1

	}else if($_POST["action"]=="unban"){
		$result =$rows->conn()->query("UPDATE blog SET  is_approved=1,is_published=1,is_banned=NULL WHERE blog_id='$_POST[post_id]'");
		if($result){
			$output= "<h3>Unbanned</h3>";
			echo $output;
		}else{
			echo "<h3>Error</h3>";
			echo $output;
		}// is_approve=1, is_published=1, is_banned=null

	}else if($_POST["action"]=="delete"){
		$result =$rows->conn()->query("UPDATE blog SET  is_approved=0,is_published=0,is_deleted=1 WHERE blog_id='$_POST[post_id]'");
		$result1=$rows->conn()->query("DELETE FROM likes WHERE blog_id='$_POST[post_id]");
		if($result && $result1){
			$output= "<h3>Delete</h3>";
			echo $output;
		}else{
			$output= "<h3>Error</h3>";
			echo $output;
		}// is_approve=0 ,is_published=0, is_deleted=1

	}else if($_POST["action"]=="approve"){
		$result =$rows->conn()->query("UPDATE blog SET  is_approved=1 WHERE blog_id='$_POST[post_id]'");
		if($result){
			$output= "<h3>Approved</h3>";
			echo $output;
		}else{
			$output= "<h3>Error</h3>";
			echo $output;
		}// is_approve=1, is_published=1
	}

}

?>