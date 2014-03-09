<?php

$filename="";
if($_FILES['course_image']['name']!="")
{

	if ((($_FILES["course_image"]["type"] == "image/gif")
			|| ($_FILES["course_image"]["type"] == "image/jpg")
			|| ($_FILES["course_image"]["type"] == "image/jpeg")
			|| ($_FILES["course_image"]["type"] == "image/png"))
			&& ($_FILES["course_image"]["size"] < 2097152))  // 2 MB = 2097152 bytes
	{

	 $filename = $_FILES['course_image']['name'];

	 move_uploaded_file($_FILES["course_image"]["tmp_name"], "./upload/".$filename);
	}
	else
	{
		echo "<p>Your file is invalid! Please upload an image file in JPG, PNG or GIF high, which is not larger than 2 MB.</p>
				<p><a href=\"javascript:window.history.back()\">Back</a></p>";
	}
}
 

if($filename=="")
{
	$filepath="upload/default.jpg";
}else
{
	$filepath="upload/".$filename;
}
include("config.php");
if(config())
{
	$university_id=$_POST['uni_id'];
	$university_name="";
	$query2 = "SELECT uni_name FROM  universities where uni_id=".$university_id;
	$result2=mysql_query($query2);
		
	while($row = mysql_fetch_array($result2))
	{
		$university_name=$row['uni_name'];
	}
	// insert user data into database
		
	$query1 = "INSERT INTO  `courses` (`uni_name` ,`uni_id` ,`course_image` ,`field_of_study` ,`course_type`,`course_name` ,`source_link` ,`description` ,`related_links`) VALUES ('".$university_name."', '".$university_id."',  '".$filepath."',  '".mysql_real_escape_string($_POST['field_of_study'])."',  '".mysql_real_escape_string($_POST['course_type'])."',  '".mysql_real_escape_string($_POST['course_name'])."',  '".mysql_real_escape_string($_POST['source_link'])."',  '".mysql_real_escape_string($_POST['description'])."',  '".mysql_real_escape_string($_POST['related_links'])."')";
	$result=mysql_query($query1);
	header("Location:courses.php");
}


?>
