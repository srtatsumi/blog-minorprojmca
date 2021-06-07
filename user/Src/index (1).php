<?php
session_start();
//  // var_dump($_SESSION); 
// date_default_timezone_set("Asia/Kolkata");
// $last_time= date("Y-m-d H:i:s");
// echo $last_time;
include_once "./includes/config.inc.php";
	$obj2=new Config;
	$sql =$obj2->conn()->query("SELECT blog_id,MAX(Counts) FROM (SELECT blog_id,count(blog_id) as Counts FROM likes Group By blog_id ORDER BY Counts DESC) as T");
	$maxlike=$sql->fetch_assoc();

	var_dump($maxlike['blog_id']);
	$_SESSION['maxlikeid']=$maxlike['blog_id'];

	$sql2=$obj2->conn()->query("SELECT * FROM blog WHERE  blog_id=$maxlike[blog_id]");
	$featured=$sql2->fetch_assoc();
	var_dump($featured);


 ?>