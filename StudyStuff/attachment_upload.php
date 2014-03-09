<?php 
include("config.php");

  // Delete Attachment
	if(isset($_GET['attachment_id']) && isset($_GET['courseid']))
	{
	 
		  if(config())
		  { 
				$q=mysql_query("SELECT path FROM attachments where id=".$_GET['attachment_id']);
				$r1=mysql_fetch_assoc($q);

				unlink($r1["path"]);
			
			mysql_query("delete from attachments where id='".$_GET['attachment_id']."'");
			header("Location:view-courses.php?course_id=".$_GET['courseid']);   		  
		  }
		  else
		  {  die("Database Selection Failed:".mysql_error());
		  }
	 
	
	 
	}else if ($_FILES["attachement_file"]["error"] > 0)
	  {
		echo "Return Code: " . $_FILES["file"]["error"] . "viru<br />";
	  }
	  else if(isset($_GET['uid']) && isset($_GET['cid']) )
	  {   
			//upload attachment
		  $username=$_GET['uid'];
		  $courseid=$_GET['cid'];
		 
		 $attachment_name=$_POST['attachment_name'];
		  $filename=$_FILES["attachement_file"]["name"];
		  $filepath="./attachments/course" . $courseid . "/" . $filename;
		  $structure="./attachments/course" . $courseid . "/";
		  
		  // create course_id directory if doesn't exist & upload in that folder.
		  if(!is_dir($structure)){
			 if (!mkdir($structure, 0755, false)) {
					die('Failed to create folders...');
				} 	  
		  }
		  
		  move_uploaded_file($_FILES["attachement_file"]["tmp_name"], $filepath);
		  
		  // Database connection
			  
			  if(config())
			  { 
				
				// insert values in Attachment table
				
					$query1="INSERT INTO `attachments` (`name`, `path`, `course_id`, `username`) VALUES ('".$attachment_name."', '".$filepath."', '".$courseid."', '".$username."')";
					
					$result=mysql_query($query1);
					
			  }
			  else
			  {  die("Database Selection Failed:".mysql_error());
			  }
			  
			  header("Location:view-courses.php?course_id=".$courseid);  // redirect  
		}
		
?>