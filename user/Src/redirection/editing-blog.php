<head><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head>
<?php 
session_start();
include '../includes/config.inc.php';
	// var_dump($_REQUEST['editor']);
// echo $_REQUEST['title'];
// echo $_REQUEST['category'];
// echo $_REQUEST['editor'];

if(!empty($_FILES['cov_pic']['name'])){
	$fileName      = $_FILES['cov_pic']['name'];
	$fileExtension = pathinfo($_FILES["cov_pic"]["name"], PATHINFO_EXTENSION);
	$fileType      = $_FILES['cov_pic']['type'];
	$fileSize      = $_FILES['cov_pic']['size']; //bytes
	$fileTmp       = $_FILES['cov_pic']['tmp_name'];
	if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png'){
		if($fileSize <= 1000 * 1000){
			#Creating a folder if not created
            if (!file_exists("../Images/Cover_Images")) {
            	mkdir("../Images/Cover_Images");
            }
            $obj=new Config;

			$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[edit_blog_id]'");

			$row=$sql->fetch_assoc();
			// var_dump($row);
			if($row){ #published before,then wants to edit,$sql returns something
				var_dump(is_null($row['blog_covpic']));
				if(is_null($row['blog_covpic'])){# the pic is never uploaded; the blog_covpic field is NULL
					$fileName=$obj->img_upld($_SESSION['edit_blog_id'],'Cover_Images',$fileExtension,$fileTmp);
					$result=$obj->publish_blog($_SESSION['edit_blog_id'],$_REQUEST['title'],$_REQUEST['category'],$fileName,$_REQUEST['editor'],$_SESSION['user_id'],$row);
					if($result){
						// echo "Cov pic was null, now saved as draft before,then wants to publish,returns something";
						echo "
						<script>
						alert('Your Blog has been edited and published!');
						window.location = '../timeline.php';
						</script>
						";
					}else{
						// echo 'Blog cannot be published. ';
						echo "
						<script>
						alert('Blog cannot be published.');
						window.location = '../write_blog.php';
						</script>
						";
					}
				}else{#pic will uploaded again; the blog_covpic is not NULL
					$tbdname=$row['blog_covpic'];#tbd-tobedeleted file name
	            	
	            	$fileName=$row['blog_covpic'];
	            	$fileName=$obj->img_reupld($tbdname,$fileName,'Cover_Images',$fileTmp);
	            	$result=$obj->publish_blog($_SESSION['edit_blog_id'],$_REQUEST['title'],$_REQUEST['category'],$fileName,$_REQUEST['editor'],$_SESSION['user_id'],$row);
	            	if($result){
	            		// echo "Cov pic was not null, now saved as draft before,then wants to publish,returns something";
	            		echo "
						<script>
						alert('Your Blog has been edited and published!');
						window.location = '../timeline.php';
						</script>
						";
	            	}else{
	            		// echo 'Blog cannot be published. ';
	            		echo "
						<script>
						alert('Blog cannot be published.');
						window.location = '../write_blog.php';
						</script>
						";
	            	}
				}
			}else{#never saved as draft,publishing without draft, $row cannot return the value
				$fileName=$obj->img_upld($_SESSION['blog_id'],'Cover_Images',$fileExtension,$fileTmp);
				$result=$obj->publish_blog($_SESSION['blog_id'],$_REQUEST['title'],$_REQUEST['category'],$fileName,$_REQUEST['editor'],$_SESSION['user_id']);
				if($result){
					// echo 'Your Blog has been published! Waiting for admin approval ';
					echo "
					<script>
					alert('Your Blog has been edited and published!');
					window.location = '../timeline.php';
					</script>
					";
				}else{
					// echo 'Blog cannot be published. ';
					echo "
					<script>
					alert('Blog cannot be published. ');
					window.location = '../write_blog.php';
					</script>
					";
				}
			}

		}else{
    		echo "
			<script>
			alert('Image is too large to Upload !Max Size:1MB');
			window.location= '../write_blog.php';
			</script>
			";
    	}
	}else{
    	echo "
		<script>
		alert('Only Image Files are Acceptable ');
		window.location = '../write_blog.php';
		</script>
		";
    }
}else{
	$obj=new Config;
	$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[edit_blog_id]'");
	$row=$sql->fetch_assoc();
	var_dump($row['blog_covpic']);
	if (file_exists("../Images/Cover_Images/$row[blog_covpic]")) {
		$rows=1;
    	$result=$obj->publish_blog($_SESSION['edit_blog_id'],$_REQUEST['title'],$_REQUEST['category'],null,$_REQUEST['editor'],$_SESSION['user_id'],$rows);
    	var_dump($result);
    	if($result){
    		echo "
			<script>
			alert('Your Blog has been edited and published!');
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
		alert('Cannot publish without image');
		// window.location = '../edit_blog.php?id=$_SESSION[edit_blog_id]';
		window.history.back();
		</script>
		";
    }
}



?>