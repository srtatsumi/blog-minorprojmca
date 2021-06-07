<?php 
session_start();
if(empty($_SESSION['user_mail'])){
	header('location:login.php');
	exit();
}
include './includes/config.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

		<!-- Font Awesome CDN -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">


		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

		<!-- Tiny MCE -->
		<script src="https://cdn.tiny.cloud/1/7h1hciaferc0mp1254bxaed6r5va1j1jbm9ph54j2ow478jk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  		<script>
  			tinymce.init({
			  selector: "textarea",
			  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
			  imagetools_cors_hosts: ['picsum.photos'],
			  menubar:false,
			  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap emoticons |  preview| insertfile table link anchor codesample | ltr rtl',
			  toolbar_sticky: true,
			  autosave_ask_before_unload: true,
			  autosave_interval: '30s',
			  autosave_prefix: '{path}{query}-{id}-',
			  autosave_restore_when_empty: false,
			  autosave_retention: '2m',
			  image_advtab: true,
			  link_list: [
			    { title: 'My page 1', value: 'http://www.tinymce.com' },
			    { title: 'My page 2', value: 'http://www.moxiecode.com' }
			  ],
			  image_list: [
			    { title: 'My page 1', value: 'http://www.tinymce.com' },
			    { title: 'My page 2', value: 'http://www.moxiecode.com' }
			  ],
			  image_class_list: [
			    { title: 'None', value: '' },
			    { title: 'Some class', value: 'class-name' }
			  ],
			  importcss_append: true,
			  file_picker_callback: function (callback, value, meta) {
			    /* Provide file and text for the link dialog */
			    if (meta.filetype === 'file') {
			      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
			    }

			    /* Provide image and alt text for the image dialog */
			    if (meta.filetype === 'image') {
			      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
			    }

			    /* Provide alternative source and posted for the media dialog */
			    if (meta.filetype === 'media') {
			      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
			    }
			  },
			  templates: [
			        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
			    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
			    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
			  ],
			  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
			  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
			  height: 585,
			  resize:false,
			  image_caption: true,
			  noneditable_noneditable_class: 'mceNonEditable',
			  toolbar_mode: 'sliding',
			  contextmenu: 'link image imagetools table',
			  encoding: 'html'
			});
  		</script>


		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./Styles/write-blog.css">
		<link rel="stylesheet" type="text/css" href="./Styles/common.css">
		<!-- <script type="text/javascript" src="./Scripts/blog.js"></script> -->
		<link rel="stylesheet" type="text/css" href="./Styles/profile.css">

		
</head>
<body>
<?php 
	include("nav.php");
	$obj=new Config;
	$sql =$obj->conn()->query("SELECT * FROM blog WHERE is_draft=1");

	$row=$sql->fetch_assoc();

	if($row and !is_null($row['is_draft']) and $row['is_draft']==1){
		$_SESSION['blog_id']=$row['blog_id'];
?>

<div class="row">
	<div class="col-sm-3">
	 	<!-- The sidebar -->
	    <div class="sidebar " style="user-select: none;">
			<br>
			<form class="blog-sidebar" style="text-align: center;margin-top:30%;" enctype="multipart/form-data"method="post">
				<div class="form-group">
				  	<label for="usr">Add Title</label>
				  	<input type="text" class="form-control" name="title" id="title" style="text-align: center" autocomplete="off" required value="<?php echo $row['blog_title']; ?>" >
				  	<br>
				  	<label for="usr">Select Categories</label>
					<select class="browser-default" id="categories" name="category" required>
						<option value="" disabled selected>Choose your option</option>
						<option value="Backend">Backend</option>
						<option value="Frontend">Frontend</option>
						<option value="Server">Server</option>
					</select>
				 	<br>
					<label for="usr">Add Cover Photo</label><br>
					<?php 
					if($row['blog_covpic']){
						// $_SESSION['fileName']=$row['blog_covpic'];
					?>
					<img src="./Images/Cover_Images/<?php echo $row['blog_covpic'] ?>" style="width: 30%">

					<?php 
						} 
					?>
				  	<input type="file" name="cov_pic" class="form-control" id="coverpic" style="text-align: center">
					<br>
				 	<button name="draft" class="btn btn-primary blue darken-1" style="margin-bottom:10px;margin:25px;" formaction="./redirection/written-draft.php">Save As Draft</button>
					<button name="submit" class="btn btn-primary white" style="margin-bottom:10px;margin:25px;color: Blue" formaction="./redirection/written-blog.php">Publish</button>
					<button name="remove" class="btn btn-primary white" onclick="remove()" style="margin-bottom:10px;margin:25px;color: Blue" formaction="./redirection/remove-draft.php">Remove Draft</button>
				</div>
			<!-- </form> -->
		</div>
	</div>
	<div class="col-sm-9" >
		<div class="editor" style="width:76.5%;">
			<div style="height:75px;font-size: 50px;text-align: center;user-select: none;font-family: 'DM Serif Display', serif;" id="show_title"><?php echo $row['blog_title'] ?></div>
			<!-- <form action="./redirection/written-blog.php"> -->
				<textarea placeholder="Write your amazing blog here!!" name="editor"><?php echo $row['blog_content']; ?></textarea>
			</form>
		</div>
	</div>
</div> 
<?php 
}else{ #if no draft found creates a new blog id
	// $row_cnt=$sql->num_rows+1;
	date_default_timezone_set("Asia/Kolkata");
	$blog_id=date("ymdHis");
	$_SESSION['blog_id']=$blog_id;
	$_SESSION['fileName']=null;
	?>

<div class="row">
	<div class="col-sm-3">
	 	<!-- The sidebar -->
	    <div class="sidebar " style="user-select: none;">
			<br>
			<form class="blog-sidebar" style="text-align: center;margin-top:30%;" enctype="multipart/form-data"method="post">
				<div class="form-group">
				  	<label for="usr">Add Title</label>
				  	<input type="text" class="form-control" name="title" id="title" style="text-align: center" autocomplete="off" required>
				  	<br>
				  	<label for="usr">Select Categories</label>
					<select class="browser-default" id="categories" name="category" required>
						<option value="" disabled selected>Choose your option</option>
						<option value="Backend">Backend</option>
						<option value="Frontend">Frontend</option>
						<option value="Server">Server</option>
					</select>
				 	<br>
					<label for="usr">Add Cover Photo</label><br>
				  	<input type="file" name="cov_pic" class="form-control" id="coverpic" style="text-align: center">
					<br>
					<br>
				 	<button name="draft" class="btn btn-primary blue darken-1" style="margin-bottom:10px;margin:25px;" formaction="./redirection/written-draft.php">Save As Draft</button>
					<button name="submit" class="btn btn-primary white" style="margin-bottom:10px;margin:25px;color: Blue" formaction="./redirection/written-blog.php">Publish</button>
				</div>
			<!-- </form> -->
		</div>
	</div>
	<div class="col-sm-9" >
		<div class="editor" style="width:76.5%;">
			<div style="height:75px;font-size: 50px;text-align: center;user-select: none;font-family: 'DM Serif Display', serif;" id="show_title"></div>
			<!-- <form action="./redirection/written-blog.php"> -->
				<textarea placeholder="Write your amazing blog here!!" name="editor"></textarea>
			</form>
		</div>
	</div>
</div> 

<?php
	}
?>   	
</body>
<script type="text/javascript">
	document.getElementById("title").addEventListener("keyup",title);
	function title(){
		var v=document.getElementById("title").value;
  		document.getElementById("show_title").innerHTML = v;
  		document.getElementById("show_title").style.fontWeight  = "bold";
	}
	function remove(){
		var v=document.getElementById("categories");
		v.removeAttribute("required");		
	}
	function load(){
		// window.location.reload();
		var v=document.getElementById("categories");
		v.addAttribute("required");
	}
</script>
</html>