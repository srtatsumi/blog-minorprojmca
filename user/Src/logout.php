<?php 
	session_start();

	session_destroy();
	echo "<script>
        alert('You have successfully Logged out');
        window.location.href='login.php';
    </script>";
?>