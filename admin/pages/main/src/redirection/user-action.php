<?php
if(isset($_POST["user_id"]) && isset($_POST["action"]))
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
		$result =$rows->conn()->query("UPDATE users SET is_banned=1,is_active=0 WHERE user_id='$_POST[user_id]'");
		$result1=$rows->conn()->query("DELETE FROM likes WHERE blog_id IN (SELECT blog_id from blog where blog_by='$_POST[user_id]')");
		$result2=$rows->conn()->query("UPDATE blog SET is_banned=1 WHERE blog_by='$_POST[user_id]'");
		if($result && $result1 && $result2){
			$output= "<h3>Banned</h3>";
			echo $output;
		}else{
			$output= "<h3>Error</h3>";
			echo $output;
		}// is_approve and is_published=null, is_banned=1

	}else if($_POST["action"]=="unban"){
		$result =$rows->conn()->query("UPDATE users SET is_banned=0,is_active=1 WHERE user_id='$_POST[user_id]'");
		$result1=$rows->conn()->query("UPDATE blog SET is_banned=0 WHERE blog_by='$_POST[user_id]' and is_approved=1 and (is_published=1 or is_draft=1) ");
		if($result && $result1){
			$output= "<h3>Unbanned</h3>";
			echo $output;
		}else{
			echo "<h3>Error</h3>";
			echo $output;
		}// is_approve=1, is_published=1, is_banned=null

	}else if($_POST["action"]=="delete"){
		$result =$rows->conn()->query("UPDATE users SET is_deleted=1,is_active=0 WHERE user_id='$_POST[user_id]'");
		$result1=$rows->conn()->query("DELETE FROM likes WHERE blog_id IN (SELECT blog_id from blog where blog_by='$_POST[user_id]')");
		$result2=$rows->conn()->query("UPDATE blog SET is_deleted=1 WHERE blog_by='$_POST[user_id]'");
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