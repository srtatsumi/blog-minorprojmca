<?php 
include('connection.inc.php');

class Config extends Conn{
	public function conn(){
		return $this->conn;
	}
	public function login($email,$pass){
		$query = mysqli_query($this->conn,"SELECT * FROM users WHERE user_mail = '$email' and password = '$pass'");
		if(mysqli_num_rows($query) > 0)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function fetch_user($id,$field){
		$a=$field;
		$sql=$this->conn()->query("SELECT * FROM users WHERE user_id='$id'");
		$row=$sql->fetch_assoc();
		return($row[$field]);
	}
	public function signup($id,$name,$age,$email,$pass,$cpass)
	{
		if($pass === $cpass)
		{
			$this->query = mysqli_query($this->conn,"INSERT INTO users (user_id,user_name,user_age,user_mail,password,user_phn,user_pic,is_active,is_banned,is_deleted) values('$id','$name',$age,'$email','$pass',NULL,NULL,'1','0','0')");
			if($this->query)
			{
				return 1;
			}
			else{
				return 0;
			}
		}
		else
		{
			return 2;
		}
	}
	public function update_profile($id,$name,$age,$mail,$phn,$pic=null){
		if($pic!=null){
			$query =$this->conn->query("UPDATE users SET user_name='$name',user_age='$age',user_mail='$mail',user_phn='$phn',user_pic='$pic' WHERE user_id='$id' ");
		}else{
			$query =$this->conn->query("UPDATE users SET user_name='$name',user_age='$age',user_mail='$mail',user_phn='$phn' WHERE user_id='$id' ");
		}
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}

	public function remove_pic($id,$pic){
		$query =$this->conn->query("UPDATE users SET user_pic=NULL WHERE user_id='$id'");
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	

	public function img_upld($imgfname,$location,$fileExtension,$fileTmp){
		#change the user given filename using userid
    	$fileName = $imgfname . "." . $fileExtension;

    	#To upload the file
        move_uploaded_file($fileTmp, "../Images/$location/" . $fileName);

        return $fileName;
	}

	public function img_reupld($tbdname,$fileName,$location,$fileTmp){
		if(file_exists("../Images/$location/".$tbdname)){
    		unlink("../Images/$location/".$tbdname);
    	}
    	#To upload the file
        move_uploaded_file($fileTmp, "../Images/$location/" . $fileName);

        return $fileName;
	}

	public function publish_blog($blog_id,$title,$category,$covpic,$content,$blog_by,$flag=null){
		date_default_timezone_set("Asia/Kolkata");
		$last_time= date("Y-m-d H:i:s");
		if($flag){
			if($covpic!=null){
				$query =$this->conn->query("UPDATE blog SET blog_title='$title',blog_cat='$category',blog_covpic='$covpic',blog_content='$content',blog_by='$blog_by',is_draft='0',is_published='1',lst_updt_time='$last_time' WHERE blog_id='$blog_id'");
			}else{
				$query =$this->conn->query("UPDATE blog SET blog_title='$title',blog_cat='$category',blog_content='$content',blog_by='$blog_by',is_draft='0',is_published='1',lst_updt_time='$last_time' WHERE blog_id='$blog_id'");
			}
			
		}else{
			$query =$this->conn->query("INSERT into blog (blog_id,blog_title,blog_cat,blog_covpic,blog_content,blog_by,is_published) VALUES('$blog_id','$title','$category','$covpic','$content','$blog_by','1')");
		}
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function remove_blog($blog_id,$tbdname=null){
		$query =$this->conn->query("UPDATE blog SET is_published='0', is_deleted='1' WHERE blog_id='$blog_id'");
		$sql=$this->conn->query("DELETE FROM likes WHERE blog_id='$blog_id'");
		// if(!is_null($tbdname) && file_exists("../Images/Cover_Images/".$tbdname)){
  //   		unlink("../Images/Cover_Images/".$tbdname);
  //   	}
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}

	
	
	public function save_draft($blog_id,$title,$category,$covpic,$content,$blog_by,$flag=null){
		if($flag){
			if($covpic==null){
				$query =$this->conn->query("UPDATE blog SET blog_title='$title',blog_cat='$category',blog_content='$content',blog_by='$blog_by',blog_covpic=null,is_draft='1' WHERE blog_id='$blog_id'");

			}else{
				$query =$this->conn->query("UPDATE blog SET blog_title='$title',blog_cat='$category',blog_content='$content',blog_by='$blog_by',is_draft='1',is_published=null WHERE blog_id='$blog_id'");
	
			}
		}else{
			$query =$this->conn->query("INSERT into blog (blog_id,blog_title,blog_cat,blog_covpic,blog_content,blog_by,is_draft) VALUES('$blog_id','$title','$category',null,'$content','$blog_by','1')");
		}
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}

	public function remove_draft($blog_id,$tbdname=null){	
		$query =$this->conn->query("DELETE from blog WHERE blog_id='$blog_id'");
		if(!is_null($tbdname) && file_exists("../Images/Cover_Images/".$tbdname)){
    		unlink("../Images/Cover_Images/".$tbdname);
    	}
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}


	public function likes($blogid,$userid,$flag){
		if(isset($blogid) && isset($userid)){
			if ($flag==0) {
				$this->query = mysqli_query($this->conn,"INSERT INTO likes (blog_id,liked_by,is_liked) values('$blogid','$userid','1')");
				if($this->query)
				{
					return 1;
				}
				else{
					return 0;
				}
			}else{
				$this->query = mysqli_query($this->conn,"DELETE FROM likes WHERE liked_by='$userid' AND blog_id='$blogid' ");
				if($this->query)
				{
					return 1;
				}
				else{
					return 0;
				}
			}
		}
		else
		{
			return 2;
		}
	}






}	
					
?>