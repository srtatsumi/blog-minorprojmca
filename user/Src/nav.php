<head>
	<style type="text/css">
		.navpimg {
		  border-radius: 50%;
		  /*width:10%;*/
		  height: 64px;
		}
	</style>
</head>
<!-- nav bar starts -->
<nav style="background-color: white; position:sticky; top:0;z-index: 999;">
	<div class = "nav-wrapper black navi">   
	    <a href="index.php">Writeurthought.com</a>
	    <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li> 
	        	<form action="./search.php" method="POST" >
			        <div class="input-field">
			          <input id="search" onkeyup="search()" type="search" name='search' required autocomplete="off" formaction="./redirection/search.php">
			          <label class="label-icon" for="search"><i class="fas fa-search"></i></label>
			          <i class="material-icons"><i class="fas fa-times"></i></i>
			       	</div>
		      	</form>
	        </li>
	        <li> <a href="index.php" >Blog</a></li>
	        <li> <a href="timeline.php" >Timeline</a></li>
	        <li>
	        	<div class="dropdown">
	        		<?php 
	        			include_once "./includes/config.inc.php";
	        			$obj= new Config;
	        			$sql1=$obj->conn()->query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
	        			$users=$sql1->fetch_assoc();
	        			if(!$users['user_pic']){
	        		?>
				  			<i class="fas fa-user-circle fa-2x" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
				  	<?php }else{ ?>
							<img src="./Images/Profile_Images/<?php echo $users['user_pic']; ?>" class="navpimg dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
					<?php } ?>
				  <div class="dropdown-menu black" aria-labelledby="dropdownMenuButton" >
				    <a class="dropdown-item" href="profile.php">Profile</a>
				    <a class="dropdown-item" href="logout.php">Logout</a>
				  </div>
				</div>
	        </li>
	    </ul>
	</div>
</nav>
<!-- nav bar ends -->