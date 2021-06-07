<?php 
session_start();
session_destroy();
echo "<script>
        alert('You have successfully Logged out');
        window.location.href='sign-in.php';
    </script>";
?>