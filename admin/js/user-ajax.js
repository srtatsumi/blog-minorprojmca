$(document).ready(function(){
	function post_action(user_id,user_action){
		$.ajax({
		  url:"./redirection/user-action.php",
		  method:"POST",
		  data:{user_id:user_id,action:user_action},
		  success:function(data){
		  		// var result = $.parseJSON(data);
		  		console.log(data);
			   	$('.modal-body').html(data);
		  }
		});
	}
	// $(".view").click(function(){
 // 		var user_id = $(this).attr("id");
 // 		// var user_id = $(this).attr("data-user-id");
	// 	console.log(user_id);
	// 	post_action(user_id,'view');
	// 	// swal("Hello world!");

 // 	});
 	$(".unban").click(function(){
 		var user_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(user_id);
		post_action(user_id,'unban');
 	});
 	$(".ban").click(function(){
 		var user_id = $(this).attr("id");
 		// var user_id = $(this).attr("data-user-id");
		console.log(user_id);
		post_action(user_id,'ban');
 	});
 	// $(".approve").click(function(){
 	// 	var user_id = $(this).attr("id");
 	// 	// var user_id = $(this).attr("data-user-id");
		// console.log(user_id);
		// post_action(user_id,'approve');
 	// });
 	$(".delete").click(function(){
 		if(confirm("Do you want to delete?")){
 			var user_id = $(this).attr("id");
	 		// var user_id = $(this).attr("data-user-id");
			console.log(user_id);
			post_action(user_id,'delete');
 		}else{
 			location.reload(true);
 		}
 	});
 	$(".close-btn").click(function(){
 		location.reload(true);
 	});
});
		
