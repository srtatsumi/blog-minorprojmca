<?php 
// SELECT * FROM blog WHERE blog_title LIKE '%$_SESSION[search]%' OR blog_cat LIKE '%$_SESSION[search]%' OR blog_content LIKE '%$_SESSION[search]%' OR blog_by IN (SELECT user_id FROM users WHERE user_name like '%$_SESSION[search]%') AND (is_banned IS NULL or is_banned='0') AND (is_deleted IS NULL or is_deleted='0') AND is_approved='1' ORDER BY lst_updt_time DESC
	session_start();
	if(empty($_SESSION['user_mail'])){
		header('location:login.php');
		exit();
	}
	$_SESSION['search']=$_REQUEST['search'];
?>
<!DOCTYPE html>
<html>
<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

		<!-- Bootstrap CDN -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

		<!-- Font Awesome CDN -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">


		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

		<!-- Google Font -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./Styles/timeline.css">
		<link rel="stylesheet" type="text/css" href="./Styles/common.css">
		
		<style type="text/css">
			.btn-large:hover{
				background-color: transparent;
			}
			.btn-flat{
				white-space: nowrap;
				position: relative;
    			left: -20px;
    			font-size: 1.3rem;
			}

		</style>
		
</head>
<body>
<?php 
	include("nav.php");
	include_once "./includes/config.inc.php";
 ?>
 <?php 
	$user=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
	$check=$user->fetch_assoc();
	$_SESSION['is_active']=$check['is_active'];
	$_SESSION['is_banned']=$check['is_banned'];
	$_SESSION['is_deleted']=$check['is_deleted'];
	if($_SESSION['is_active']==0 && $_SESSION['is_banned']==1){ ?>
		<div class="banned_div"><h3>You have been Banned!! Wait for 3 days to get unbanned!!</h3></div>
	<?php }elseif ($_SESSION['is_active']==0 && $_SESSION['is_deleted']==1) { ?>
		<div class="banned_div"><h3>You have been deleted!!</h3></div>
	<?php }else{?>
	<div class="container center" >
		
		<!-- <a href="write_blog.php" class="btn" style="font-family: Laila;">Write a new Blog!!</a> -->
			
		<h3 style="font-family: 'Lemonada', cursive;">Searched Results</h3>
		<hr>
		<div class="row" id="vcard">
		  	<?php
				$obj= new Config;
				// echo $_SESSION['user_id'];
				$sql=$obj->conn()->query("SELECT * FROM blog WHERE (blog_title LIKE '%$_SESSION[search]%' OR blog_cat LIKE '%$_SESSION[search]%' OR blog_content LIKE '%$_SESSION[search]%' OR blog_by IN (SELECT user_id FROM users WHERE user_name like '%$_SESSION[search]%')) AND (is_banned IS NULL or is_banned='0') AND (is_deleted IS NULL or is_deleted='0') AND is_approved='1' ORDER BY lst_updt_time DESC");
				// $rows=$sql->fetch_assoc();
				// var_dump($sql);
				if($sql->num_rows >0){
					while($rows=$sql->fetch_assoc()){
					// for($rows=$sql->fetch_assoc(); $sql->num_rows=4;){
			?>
				    <div class="col-sm-6">
				      	<div class="card">
					        <div class="card-image" style="width: 100%">
					          <?php if($rows['blog_covpic']){ ?>
								<img src="./Images/Cover_Images/<?php echo $rows['blog_covpic']; ?>" alt="<?php echo $rows['blog_title']; ?>" style="width:96%; height: 300px">
				        	<?php }else{ ?>
								<img src="./Images/noimage.jpeg ?>" alt="<?php echo $rows['blog_title']; ?>" style="width:96%">
				        	<?php } ?>	          
					        </div>
					        <div class="card-content vcard-body">
					        	<div class="row">
					        		<div class="col-sm-4">
					        			<small class="text-muted" style="text-transform: uppercase;"> <?php echo $rows['blog_cat']; ?></small>
					        		</div>
					        		<div class="col-sm-8">
					        			<?php 
				        					date_default_timezone_set("Asia/Kolkata");
											$curr_time= date("Y-m-d H:i:s");
											//echo $last_time.'<br>';

											$lst_updt_time = new DateTime( $rows['lst_updt_time']);
											$time_diff = $lst_updt_time->diff(new DateTime($curr_time));
											$minutes = $time_diff->days * 24 * 60;
											$minutes += $time_diff->h * 60;
											$minutes += $time_diff->i;

											if($minutes < 60){
												$time=$minutes.' min ago';
											}else if(((($minutes/60)/24)/7)>=100){
												$time =date("d M Y",strtotime($rows['lst_updt_time']));
											}else if((($minutes/60)/24)>=7){
												$time=intval((($minutes/60)/24)/7)."wk ago";
											}else if(($minutes/60) >= 24){
												$time=intval(($minutes/60)/24)."d ago";
											}else if($minutes >= 60){
												$time=intval($minutes/60)."hr ago";
											}		
				        				?>
					        			<small class="text-muted">Last updated <?php echo $time ; ?></small>
					        		</div>
					        	</div>
					        	<span class="card-title" style="font-family: 'DM Serif Display', serif;">
					        		<?php echo $rows['blog_title']; ?>
					        	</span>
					          	<p class="vcard-note">
					          		<?php
							          	// 		echo "I am a very simple card. I am good at containing small bits of information.
							          	// I am convenient because I require little markup to use effectively...";
										if(strlen($rows['blog_content'])>100)
											echo substr($rows['blog_content'],0,100)."..."; 
										else
											echo substr($rows['blog_content'],0,100); 
									?>
					          	</p>
					          	
								<div>
									<div class="row section">
									  <div class="col">
									    <!-- Modal Trigger -->
										<a href="" class="view" style="color:blue" data-bs-toggle="modal" data-bs-target="#readMoreModal" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>" >
											Read More
											<i class="fas fa-arrow-right"></i>
										</a>
									  </div>
									</div>
									<div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											
											<div class="modal-content">
												<div class="modal-body">
													
												</div>
												<div class="modal-footer">
													<a class="btn-flat btn-large like2" style="color:black;position: relative;right:70%" id="" data-user-id="<?php echo $_SESSION['user_id']  ?>">
														<i class="fas fa-heart"></i>
														<small class="text-muted" id="likenum">0</small>
													</a>
													<button type="button" class="btn btn-secondary" id="close-btn" data-bs-dismiss="modal">Close</button>
												</div>
											</div>								
										</div>
									</div>
					          	</div>


					        </div>
					        <div class="card-action" id="vcard-footer">
					          <div class="row">
					          	<div class="col-sm-6 vpdiv">
						          		<?php 
						          		if($_SESSION['user_id']==$rows['blog_by']){ ?>
									<a href="./profile.php" >
					          			<?php }else{ ?>
					          		<a href="./other_profile.php?id=<?php echo $rows['blog_by'] ?> " >	
						          		<?php }
						          		?>
				    					<?php 
										$sql1=$obj->conn()->query("SELECT * FROM users WHERE user_id='$rows[blog_by]'");
										$users=$sql1->fetch_assoc(); ?>

										<?php	
										if(!$users['user_pic']){ ?>
												<i class="fas fa-user-circle fa-2x" id="profile" ></i>
					        					<span style="color:blue;"> <?php  echo $users['user_name']; ?> </span>
										<?php 
										}else{ ?>
												<img src="./Images/Profile_Images/<?php echo $users['user_pic']; ?>" class="vpimg">
					        					<span style="color:blue;position: relative;top: 0px;"><?php  echo $users['user_name']; ?> </span>
										<?php
										} ?>
									</a>
					          	</div>
					          	<div class="col-sm-2">
									<!-- <a class="btn-flat btn-large" style="color:black;">
										<i class="fas fa-heart"></i>
										<small class="text-muted">0</small>
									</a> -->
								</div>
								<div class="col-sm-2">
									<!-- <a class="btn-flat btn-large" style="color:black;">
										<i class="fas fa-comment-alt"></i>
										<small class="text-muted">0</small>
									</a> -->
								</div>
								<!-- <div class="col-sm-2">
									<a class="btn-flat btn-large" style="color:black;">
										<i class="fas fa-share-alt"></i>
										<small class="text-muted">0</small>
									</a>
								</div> -->
								<div class="col-sm-2">
										<?php 
										$obj1= new Config;
										$result =$obj1->conn()->query("SELECT * FROM likes WHERE blog_id='$rows[blog_id]' ");
										$row=$result->num_rows;
										$userliked=$obj1->conn()->query("SELECT * FROM likes WHERE blog_id='$rows[blog_id]' AND liked_by='$_SESSION[user_id]' ");
										$isliked=$userliked->num_rows;
										if($isliked==1){ ?>
											<a class="btn-flat btn-large like" style="color:red;" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>">
										<?php }else{ ?>
											<a class="btn-flat btn-large like" style="color:black;" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>">
										<?php }?>
										<i class="fas fa-heart"></i>
										<small class="text-muted" id="likenum"><?php echo $row ?></small>
									</a>
								</div>
					          </div>
					        </div>
				      	</div>
				    </div>
			<?php }
			}else{ ?>
				<h5 style="font-family: 'Lemonada', cursive;">No Results Found!!</h5>
			<?php }
		 ?>
		</div>
	</div>
	<?php } ?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script type="text/javascript">
		 $(document).ready(function(){

			function fetch_post_data(post_id,user_id){
				$.ajax({
				  url:"./redirection/blog-fetch.php",
				  method:"POST",
				  data:{post_id:post_id,user_id:user_id},
				  success:function(data){
				  		var result = $.parseJSON(data);
				  		// console.log(result[2]);
					   	$('.modal-body').html(result[0]);
					   	$(".like2").attr('id', result[1]);
					   	if(result[2]==1){
					   		$(".like2").attr('style', 'color:red;position: relative;right:70%');
					   		$(".like2").find("#likenum").html(result[3]);
					   		
					   	}
					   	else if(result[2]==0){	
					   		$(".like2").attr('style', 'color:black;position: relative;right:70%');
					   		$(".like2").find("#likenum").html(result[3]);
					   	}
				  }
				});
			}
			$(".view").click(function(){
		 		var post_id = $(this).attr("id");
		 		var user_id = $(this).attr("data-user-id");
				// console.log(post_id);
				fetch_post_data(post_id,user_id);
		 	});


			function give_like(post_id,user_id){
				var x=null;
				$.ajax({
				  url:"./redirection/give-like.php",
				  method:"POST",
				  async:false,
				  data:{post_id:post_id,user_id:user_id},
				  success:function(data){
				  	var result = $.parseJSON(data);
				  	if (result[0]==1 && result[2]==0) {
				  		x="liked";
				  	}else if(result[0]==1 && result[2]==1){
				  		x="unliked";
				  	}				  	
				 }
				});
				return x;
				
			}
		 	$(".like").click(function(){
		 		var post_id = $(this).attr("id");
		 		var user_id = $(this).attr("data-user-id");
				var y=give_like(post_id,user_id);
				if(y=='liked'){
					$(this).attr('style', 'color:red');
					var liked=$(this).find('#likenum').html();
					liked++;
					$(this).find('#likenum').html(liked);
				}	
				else if (y=='unliked'){
					$(this).attr('style', 'color:black');
					var liked=$(this).find('#likenum').html();
					liked--;
					$(this).find('#likenum').html(liked);
				}	
		 	});
		 	$(".like2").click(function(){
		 		var post_id = $(this).attr("id");
		 		var user_id = $(this).attr("data-user-id");
				var y=give_like(post_id,user_id);
				if(y=='liked'){
					$(this).attr('style', 'color:red;position: relative;right:70%');
					var liked=$(this).find('#likenum').html();
					liked++;
					$(this).find('#likenum').html(liked);
				}
				else if (y=='unliked'){
					$(this).attr('style', 'color:black;position: relative;right:70%');
					var liked=$(this).find('#likenum').html();
					liked--;
					$(this).find('#likenum').html(liked);
				}
		 	});
		 	$('#close-btn').click(function(){
	            location.reload(true);
            });
		});
		
	 
</script>
</body>

</html>