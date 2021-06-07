$(document).ready(function(){
	function post_action(post_id,post_action){
		$.ajax({
		  url:"./redirection/post-action.php",
		  method:"POST",
		  data:{post_id:post_id,action:post_action},
		  success:function(data){
		  		// var result = $.parseJSON(data);
		  		console.log(data);
			   	$('.modal-body').html(data);
		  }
		});
	}
	$(".view").click(function(){
 		var post_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(post_id);
		post_action(post_id,'view');
		// swal("Hello world!");

 	});
 	$(".unban").click(function(){
 		var post_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(post_id);
		post_action(post_id,'unban');
 	});
 	$(".ban").click(function(){
 		var post_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(post_id);
		post_action(post_id,'ban');
 	});
 	$(".approve").click(function(){
 		var post_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(post_id);
		post_action(post_id,'approve');
 	});
 	$(".delete").click(function(){
 		if(confirm("Do you want to delete?")){
 			var post_id = $(this).attr("id");
	 		// var user_id = $(this).attr("data-user-id");
			console.log(post_id);
			post_action(post_id,'delete');
 		}else{
 			location.reload(true);
 		}
 	});
 	$(".close-btn").click(function(){
 		location.reload(true);
 	});
});
		
