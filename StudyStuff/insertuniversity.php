<?php
   if($_FILES['uni_image']['name']!="")
   {
    
	if ((($_FILES["uni_image"]["type"] == "image/gif")
	|| ($_FILES["uni_image"]["type"] == "image/jpg")
	|| ($_FILES["uni_image"]["type"] == "image/jpeg")
	|| ($_FILES["uni_image"]["type"] == "image/png"))
	&& ($_FILES["uni_image"]["size"] < 2097152))  // 2 MB = 2097152 bytes
	{
	 
	 $filename = $_FILES['uni_image']['name'];	 
	 
	 move_uploaded_file($_FILES["uni_image"]["tmp_name"], "./upload/".$filename);
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
		   
			// insert user data into database
			
			$query1 ="INSERT INTO universities (`uni_name`, `uni_image`, `uni_src_link`, `uni_description`, `uni_city`, `uni_country`) VALUES ('".mysql_real_escape_string($_POST['uni_name'])."', '".$filepath."' , '".mysql_real_escape_string($_POST['souce_link'])."', '".mysql_real_escape_string($_POST['description'])."', '".mysql_real_escape_string($_POST['city'])."', '".mysql_real_escape_string($_POST['country'])."')";
			$result=mysql_query($query1);
			header("Location:university.php");
		 }

	
?>
