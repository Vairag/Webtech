<?php
require_once 'config.php';
if(config())
{
	$username=$_POST['username'];
	$comment=$_POST['comment_text'];
	
	
	if(isset($_POST['attachment_id'])){
		
		$attachment_id=$_POST['attachment_id'];
		// insert user data into database
		$query1 = "INSERT INTO comments (`comment`, `username`, `attachment_id`) VALUES ('".$comment."', '".$username."', '".$attachment_id."')";
		$result=mysql_query($query1);
		
		header("Location:download.php?id=".$attachment_id);
	
	}elseif (isset($_POST['course_id']))
	{
		$course_id=$_POST['course_id'];
		// insert user data into database
		$query1 = "INSERT INTO comments (`comment`, `username`, `course_id`) VALUES ('".$comment."', '".$username."', '".$course_id."')";
		$result=mysql_query($query1);
		 
		header("Location:view-courses.php?course_id=".$course_id);
	}
}


?>