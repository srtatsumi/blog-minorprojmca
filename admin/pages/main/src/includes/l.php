<?php 

include("config.inc.php");
$obj=new Config;
echo $obj->fetch_user("2101281",'user_name');
?><!-- 
SELECT * FROM blog WHERE blog_by=(SELECT user_id FROM users WHERE user_name like '%lorem%') or blog_title Like '%lorem%' or blog_cat like '%lorem%' or blog_content like '%lorem%' -->