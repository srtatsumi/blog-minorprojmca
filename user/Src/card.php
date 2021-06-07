<div class="card">
    <div class="row no-gutters card-row">
        <div class="col-sm-6 card-image" >
        	<?php if($rows['blog_covpic']){ ?>
				<img src="./Images/Cover_Images/<?php echo $rows['blog_covpic']; ?>" class="cover-img" alt="<?php echo $rows['blog_title']; ?>">
        	<?php }else{ ?>
				<img src="./Images/noimage.jpeg ?>" class="cover-img" alt="<?php echo $rows['blog_title']; ?>">
        	<?php } ?>
        </div>
        <div class="col-sm-6 card-note">
        	<div class="card-body" style="text-align: left;">
        		<div class="row card-head">
        			<div class="col-sm-6 card-head-left">
        					<?php 
								$sql1=$obj->conn()->query("SELECT * FROM users WHERE user_id='$rows[blog_by]'");
        						$users=$sql1->fetch_assoc();
        						if(!$users['user_pic']){ ?>
        							<i class="fas fa-user-circle fa-3x" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        							<a href="#">	
			        					<span style="color:blue;"> <?php  echo $users['user_name']; ?> </span>
			        				</a>
        					<?php }else{ ?>
        							<img src="./Images/Profile_Images/<?php echo $users['user_pic']; ?>" class="pimg">
        							<a href="#">	
			        					<span style="color:blue;position: relative;top: 0px"> <?php  echo $users['user_name']; ?> </span>
			        				</a>
        					<?php } ?>
        				
        				
        			</div>
        			<div class="col-sm-6 card-head-right" style="text-align: right;">
        				<span class="text-muted" style="text-transform: uppercase;"><?php echo $rows['blog_cat']; ?></span><br>

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
        		<div class="card-main">
        			<div class="row card-top">
        				<div class="col-sm-9">
        					<h5 class="card-title" style="font-family: 'DM Serif Display', serif;">
        						<?php
        						if(strlen($rows['blog_title'])>16)
        							echo substr($rows['blog_title'],0,13)."..."; 
        						else
        							echo substr($rows['blog_title'],0,16); 
        						?>
        					</h5>
        				</div>
        			</div>
        			<div class="row card-middle" style="height: 121px">
        				<div class="col-sm-12" >
        					<div class="card-text">
        						<?php
        						if(strlen($rows['blog_content'])>265)
        							echo substr($rows['blog_content'],0,265)."..."; 
        						else
        							echo substr($rows['blog_content'],0,265); 
        						?>
        						
        					</div>
        				</div>
        			</div>
        			
		        	<div class="card-readmore">
						<div class="row section">
						  <div class="col" style="text-align: right;">
						    <!-- Modal Trigger -->
							<a href="" class="view" style="color:blue" data-bs-toggle="modal" data-bs-target="#readMoreModal" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>" >
								Read More
								<i class="fas fa-arrow-right"></i>
							</a>
						  </div>
						</div>
						<div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								
								<div class="modal-content" style="text-align: center;">
									<div class="modal-body">
										
									</div>
									<div class="modal-footer">
										<a class="btn-flat like2" style="color:black;position: relative;right:70%" id="" data-user-id="<?php echo $_SESSION['user_id']  ?>">
											<i class="fas fa-heart"></i>
											<small class="text-muted" id="likenum">0</small>
										</a>
										<!-- <a class="btn-flat" style="color:black;" id="" data-user-id="<?php echo $_SESSION['user_id']  ?>">
											<i class="fas fa-pen"></i>
										</a> -->
										<button type="button" class="btn btn-secondary" id="close-btn" data-bs-dismiss="modal">Close</button>
									</div>
								</div>								
							</div>
						</div>
		          	</div>
        		</div>	
                <div class="row card-footer" id="card-footer">
    				<div class="col-sm-2">
							<?php 
							$obj1= new Config;
							$result =$obj1->conn()->query("SELECT * FROM likes WHERE blog_id='$rows[blog_id]' ");
							$row=$result->num_rows;
							$userliked=$obj1->conn()->query("SELECT * FROM likes WHERE blog_id='$rows[blog_id]' AND liked_by='$_SESSION[user_id]' ");
							$isliked=$userliked->num_rows;
							if($isliked==1){ ?>
								<a class="btn-flat like" style="color:red;" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>">
							<?php }else{ ?>
								<a class="btn-flat like" style="color:black;" id="<?php echo $rows['blog_id'] ?>" data-user-id="<?php echo $_SESSION['user_id']  ?>">
							<?php }?>
							<i class="fas fa-heart"></i>
							<small class="text-muted" id="likenum"><?php echo $row ?></small>
						</a>
					</div>
    				<div class="col-sm-2 ">
    					<!-- <a href="" style="color:black;">
    						<span><i class="fas fa-comment-alt"></i></span>
    						<small class="text-muted">0</small>
    					</a> -->
    				</div>
    				<div class="col-sm-4"></div>
    				<div class="col-sm-2 " style="text-align: right;position: relative;left: 25px">
    					<a class="btn-flat edit" href="edit_blog.php?id=<?php echo $rows['blog_id'] ?>" style="color:black;" id="<?php echo $rows['blog_id'] ?>">
    						<span><i class="fas fa-pen"></i></span>
    					</a>
    				</div>
    				<div class="col-sm-2 " style="text-align: right;position: relative;left: 25px">
    					<!-- <a class="btn-flat delete" style="color:black;" href="./redirection/remove-blog.php?id=<?php echo $rows['blog_id'] ?>" id="<?php echo $rows['blog_id'] ?>"> -->
    					<a class="btn-flat delete" style="color:black;" data-remove-id="<?php echo $rows['blog_id'] ?>">
    						<span><i class="fas fa-trash"></i></span>
    					</a>
    				</div>
				</div>
            </div>
            
        </div>
    </div>
</div>