<?php 
	session_start();
include '../includes/config.inc.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// var_dump($_FILES);

	
	// echo $_SESSION['user_id'];

	$name=$_REQUEST["user_name"];
	$age=$_REQUEST["user_age"];
	$mail=$_REQUEST["user_mail"];
	$phn=$_REQUEST["user_phn"];
	$id=$_SESSION['user_id'];

	$fileName      = $_FILES['user_pic']['name'];
    $fileExtension = pathinfo($_FILES["user_pic"]["name"], PATHINFO_EXTENSION);
    $fileType      = $_FILES['user_pic']['type'];
    $fileSize      = $_FILES['user_pic']['size']; //bytes
    $fileTmp       = $_FILES['user_pic']['tmp_name'];

    if(!empty($fileName)){    
	    if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png'){
	    	if($fileSize <= 1000 * 1000){
	    		#Creating a folder if not created
	            if (!file_exists("../Images/Profile_Images")) {
	                mkdir("../Images/Profile_Images");
	            }

	            $obj=new Config;
				$sql =$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
				$row=$sql->fetch_assoc();
				// var_dump($row['user_pic']);
	            if(is_null($row['user_pic'])){#if the pic is never uploaded; the userpic is NULL
	            
	                $fileName=$obj->img_upld($_SESSION['user_id'],'Profile_Images',$fileExtension,$fileTmp);
	                $result=$obj->update_profile($id,$name,$age,$mail,$phn,$fileName);
	                if($result){
	                	echo "
						<script>
						alert('Your Profile has been updated ');
						window.location = '../profile.php';
						</script>
						";
	                }else{
	                	echo "
						<script>
						alert('Profile Updation Error ');
						window.location = '../profile.php';
						</script>
						";
	                }
	            }else{#if pic is uploaded again; the userpic is not NULL
	            	$tbdname=$row['user_pic'];#tbd-tobedeleted file name
	            	
	            	$fileName=$row['user_pic'];

	            	$fileName=$obj->img_reupld($tbdname,$fileName,'Profile_Images',$fileTmp);

                    $result=$obj->update_profile($id,$name,$age,$mail,$phn,$fileName);
                    if($result){
	                	echo "
						<script>
						alert('Your Profile has been updated ');
						window.location = '../profile.php';
						</script>
						";
	                }else{
	                	echo "
						<script>
						alert('Profile Updation Error ');
						window.location = '../profile.php';
						</script>
						";
	                }
	            }
	    	}else{
	    		echo "
				<script>
				alert('Image is too large to Upload !Max Size:1MB');
				window.location= '../profile.php#section2';
				</script>
				";
	    	}
	    }else{
	    	echo "
			<script>
			alert('Only Image Files are Acceptable ');
			window.location = '../profile.php#section2';
			</script>
			";
	    }
	}else{
		$obj=new Config;
		$result=$obj->update_profile($id,$name,$age,$mail,$phn);
		if($result){
        	echo "
			<script>
			alert('Your Profile has been updated ');
			window.location = '../profile.php';
			</script>
			";
        }else{
        	echo "
			<script>
			alert('Profile Updation Error ');
			window.location = '../profile.php';
			</script>
			";
        }
	}

}
?>