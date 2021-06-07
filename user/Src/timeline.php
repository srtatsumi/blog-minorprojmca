<?php 
	session_start();
	if(empty($_SESSION['user_mail'])){
		header('location:login.php');
		exit();
	}
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
			.btn-flat{
				white-space: nowrap;
				position: relative;
    			left: -20px;
    			font-size: 1.3rem;
			}
			.btn-flat i{
				font-size: 1.5rem;
			}
			.banned{
				background-color: maroon;
				/*display: inline-block;*/
				position: relative;
				top: 60px;
				left:-10px;
				height: 50px;
				width: 60px;
				border-radius: 100%;
				z-index: 99;
				color: white;
				font-size: 15px;
				padding-top:12px ;
			}
			.unapproved{
				background-color: blue;
				/*display: inline-block;*/
				position: relative;
				top: 60px;
				left:-10px;
				height: 50px;
				width: 100px;
				border-radius: 100%;
				z-index: 99;
				color: white;
				font-size: 15px;
				padding-top:12px ;
			}
			.draft{
				background-color: grey;
				/*display: inline-block;*/
				position: relative;
				top: 60px;
				left:-10px;
				height: 50px;
				width: 100px;
				border-radius: 100%;
				z-index: 99;
				color: white;
				font-size: 15px;
				padding-top:12px ;
			}
		</style>

		
</head>
<body>
<?php 
	include_once("nav.php");
	include_once "./includes/config.inc.php";
 ?>
<div class="container center" >
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
		<h1 style="font-family: 'Lemonada', cursive;">Timeline</h1>
		<a href="write_blog.php" class="btn" style="font-family: Laila;">Write a new Blog!!</a>
		<br>
		<div id="myBtnContainer" style="margin-top: 20px;margin-bottom: 20px">
		  <button class="btn active " onclick="filterSelection('all')" id="all"> Show all</button>
		  <button class="btn " onclick="filterSelection('banned')" id="banned"> Banned</button>
		  <button class="btn " onclick="filterSelection('draft')" id="draft"> Draft</button>
		  <button class="btn " onclick="filterSelection('unapproved')" id="unapproved"> Unapproved</button>
		  <button class="btn " onclick="filterSelection('approved')" id="approved"> Approved</button>
		</div>
	<?php 

		$obj= new Config;
		// echo $_SESSION['user_id'];
		$sql=$obj->conn()->query("SELECT * FROM blog WHERE blog_by='$_SESSION[user_id]' AND (is_deleted=0 or is_deleted IS NULL) ORDER BY lst_updt_time DESC");
		// $rows=$sql->fetch_assoc();
		// var_dump($sql);
		if($sql->num_rows >0){
			while($rows=$sql->fetch_assoc()){
	?>

	<?php if($rows['is_banned']==1 && ($rows['is_deleted']==0 || is_null($rows['is_deleted']))){ ?>
			<div class="banned-card">
				<div class="banned">
					banned
				</div>
				<?php include("./card.php") ?>
			</div>	
	<?php }elseif ($rows['is_draft']==1 && ($rows['is_deleted']==0 || is_null($rows['is_deleted']))) { ?>
			<div class="draft-card">	
				<div class="draft">
					draft
				</div>
				<?php include("./card.php") ?>
			</div>		
	<?php }elseif ($rows['is_approved']!=1 && ($rows['is_deleted']==0 || is_null($rows['is_deleted']))) { ?>
			<div class="unapproved-card">	
				<div class="unapproved">
					unapproved
				</div>
				<?php include("./card.php") ?>
			</div>
	<?php }else{?>
			<div class="other-card">		
				<?php include("./card.php") ?>
			</div>
	<?php
				}
			}
		}
	}
	?>
	
	
</div>

   	
</body>
</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
		 $(document).ready(function(){
			$("#banned").click(function(){
		  		$("div").filter(".banned-card").show();
		  		$("div").filter(".draft-card").hide();
		  		$("div").filter(".unapproved-card").hide();
		  		$("div").filter(".other-card").hide();
		  	})
		  	$("#draft").click(function(){
		  		$("div").filter(".banned-card").hide();
		  		$("div").filter(".draft-card").show();
		  		$("div").filter(".unapproved-card").hide();
		  		$("div").filter(".other-card").hide();
		  	})
		  	$("#unapproved").click(function(){
		  		$("div").filter(".banned-card").hide();
		  		$("div").filter(".draft-card").hide();
		  		$("div").filter(".unapproved-card").show();
		  		$("div").filter(".other-card").hide();
		  	})
		  	$("#approved").click(function(){
		  		$("div").filter(".banned-card").hide();
		  		$("div").filter(".draft-card").hide();
		  		$("div").filter(".unapproved-card").hide();
		  		$("div").filter(".other-card").show();
		  	})
		  	$("#all").click(function(){
		  		$("div").filter(".banned-card").show();
		  		$("div").filter(".draft-card").show();
		  		$("div").filter(".unapproved-card").show();
		  		$("div").filter(".other-card").show();
		  	})
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

            $(".edit").click(function(){
            	var post_id = $(this).attr("id");
            	console.log(post_id);
            	// location.href = "./ex.php";

            });
            $(".delete").click(function(){
            	var post_id = $(this).attr("data-remove-id");
            	console.log(post_id);
            	swal({
				  title: "Do you want to delete the blog?",
				  text: "Once deleted, you will not be able to recover!",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				}).then((willDelete) => {
				  if (willDelete) {
				    swal("Your blog has been deleted!", {
				      icon: "success"
				    }).then(function(){
				    	window.location.href = "./redirection/remove-blog.php?id="+post_id
				    });
				  }
				});
            });
            

		});
		
	 
</script>