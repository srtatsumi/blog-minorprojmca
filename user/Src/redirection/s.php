<?php 
session_start();
include '../includes/config.inc.php';
	// var_dump($_REQUEST['editor']);
echo $_REQUEST['title'];
echo $_REQUEST['category'];
echo $_REQUEST['editor'];

$fileName      = $_FILES['cov_pic']['name'];
$fileExtension = pathinfo($_FILES["cov_pic"]["name"], PATHINFO_EXTENSION);
$fileType      = $_FILES['cov_pic']['type'];
$fileSize      = $_FILES['cov_pic']['size']; //bytes
$fileTmp       = $_FILES['cov_pic']['tmp_name'];
$cov_pic=$fileName;

if(!empty($fileName)){
	if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png'){
    	if($fileSize <= 1000 * 1000){
    		#Creating a folder if not created
            if (!file_exists("../Images/Cover_Images")) {
            	mkdir("../Images/Cover_Images");
            }

            $obj=new Config;

			$sql =$obj->conn()->query("SELECT * FROM blog WHERE blog_id='$_SESSION[blog_id]'");

			$row=$sql->fetch_assoc();
			// var_dump($row['user_pic']);
			
			if($sql){ #saved as draft before,then wants to publish,
				if(is_null($row['blog_covpic'])){# the pic is never uploaded; the blog_covpic field is NULL
	            	$fileName=$obj->img_upld($cov_pic,'Cover_Images',$fileExtension,$fileTmp);

	                $result=$obj->publish_blog($_SESSION[blog_id],$_REQUEST['title'],$_REQUEST['category'],$fileName,$_REQUEST['editor'],$_SESSION[user_id],$sql);
	                
	                if($result){
	                	echo 'Your Blog has been published! Waiting for admin to approve it. ';
	     				//echo "
						// <script>
						// alert('Your Blog has been published! Waiting for admin to approve it. ');
						// window.location = '../blog.php';
						// </script>
						// ";
	                }else{
	                	echo 'Blog cannot be published. ';
	     				//	echo "
						// <script>
						// alert('Blog cannot be published. ');
						// window.location = '../write_blog.php';
						// </script>
						// ";
	                }
	            }else{#pic will uploaded again; the blog_covpic is not NULL
	            	$tbdname=$row['blog_covpic'];#tbd-tobedeleted file name
	            	
	            	$fileName=$row['blog_covpic'];



	            	$fileName=$obj->img_reupld($tbdname,$fileName,'Profile_Images',$fileTmp);
	            
	                $result=$obj->publish_blog($_SESSION['blog_id'],$_REQUEST['title'],$_REQUEST['category'],$fileName,$_REQUEST['editor'],$_SESSION['user_id'],$sql);
	                if($result){
	                	echo 'Your Blog has been published! Waiting for admin to approve it. ';
	     				//echo "
						// <script>
						// alert('Your Blog has been published! Waiting for admin to approve it. ');
						// window.location = '../blog.php';
						// </script>
						// ";
	                }else{
	                	echo 'Blog cannot be published. ';
	     				//echo "
						// <script>
						// alert('Blog cannot be published. ');
						// window.location = '../write_blog.php';
						// </script>
						// ";
	                }
	            }
			}else{ #never saved as draft,publishing without draft cannot return the value
				$fileName=$obj->img_upld($cov_pic,'Cover_Images',$fileExtension,$fileTmp);

                $result=$obj->publish_blog($_SESSION['blog_id'],$_REQUEST['title'],$_REQUEST['category'],$cov_pic,$_REQUEST['editor'],$_SESSION['user_id']);
                if($result){
                	echo 'Your Blog has been published! Waiting for admin to approve it. ';
     				//echo "
					// <script>
					// alert('Your Blog has been published! Waiting for admin to approve it. ');
					// window.location = '../blog.php';
					// </script>
					// ";
                }else{
                	echo 'Blog cannot be published. ';
     				//            	echo "
					// <script>
					// alert('Blog cannot be published. ');
					// window.location = '../write_blog.php';
					// </script>
					// ";
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
	echo ('You Cannot Publish Blog without Cover Pic ');
	// echo "
	// <script>
	// alert('You Cannot Publish Blog without Cover Pic ');
	// window.location = '../write_blog.php';
	// </script>
	// ";				
}

?>