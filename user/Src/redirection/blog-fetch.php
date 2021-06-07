<?php
//fetch.php
// $_POST["post_id"]='210212124221';
// $_POST["user_id"]='2101281';
if(isset($_POST["post_id"]) && isset($_POST["user_id"]))
{
  include('../includes/config.inc.php');
  $rows=new Config;
  $result =$rows->conn()->query("SELECT * FROM blog WHERE blog_id='$_POST[post_id]' ");
  $output = '';

  $obj1=new Config;
  $userliked=$obj1->conn()->query("SELECT * FROM likes WHERE blog_id='$_POST[post_id]' AND liked_by='$_POST[user_id]' ");
  $isliked=$userliked->num_rows;

  $obj2=new Config;
  $totalliked=$obj2 ->conn()->query("SELECT * FROM likes WHERE blog_id='$_POST[post_id]' ");
  $allliked=$totalliked->num_rows;

  


  while($row = $result->fetch_assoc()){
    $obj3=new Config;
    $sql1=$obj3->conn()->query("SELECT * FROM users WHERE user_id='$row[blog_by]'");
    $row1=$sql1->fetch_assoc();
    if($row["blog_covpic"]){
      $output .= '
      <h4>'.$row["blog_title"].'</h4>
      <p><label>Author By - '.$row1["user_name"].'</label></p>
      <p><img src="./Images/Cover_Images/'.$row["blog_covpic"].'" style="width:50%"></p>
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
  // echo $output;
    echo json_encode(array($output, $_POST['post_id'], $isliked, $allliked));

}

?>
