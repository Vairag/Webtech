<?php

// Database connection
	include("config.php");
	  if(config())
	  { 		  
		
		mysql_query("delete from reservation where reservation_id='".$_GET['r_id']."'");
		header("Location:main.php");   		  
	  }
	  else
	  {  die("Database Selection Failed:".mysql_error());
	  }

   
 
		
?>