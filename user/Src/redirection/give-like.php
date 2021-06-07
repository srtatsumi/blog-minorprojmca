<?php
//fetch.php
if(isset($_POST["post_id"]))
{
  include('../includes/config.inc.php');
  $rows=new Config;
  $result =$rows->conn()->query("SELECT * FROM likes WHERE blog_id='$_POST[post_id]' AND liked_by='$_POST[user_id]' ");
  $output = '';
  if(($result->num_rows) > 0)
  	$flag=1;
  else
  	$flag=0;
  $output =$rows->likes($_POST["post_id"],$_POST["user_id"],$flag);

  // echo $output." ".$_POST['post_id'];
  echo json_encode(array($output, $_POST['post_id'],$flag));

}

?>