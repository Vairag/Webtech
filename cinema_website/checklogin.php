<?php
 // Database connection
include("config.php");		 
		   // Send email on Forgot Password...will be implementated later !
		   if(isset($_POST['emp_id']) && isset($_POST['emp_pwd']))
		   {    
		       //echo $_POST['emp_id'].$_POST['emp_pwd'];
		       if(config())
		       {
				$query = "INSERT INTO  box_office_employees (`box_office_employees_id` ,`box_office_employees_pwd`) VALUES ('".$_POST['emp_id']."',  '".$_POST['emp_pwd']."')";
				$result=mysql_query($query);

				header("Location:adminlogin.php?creteduser=yes"); 
			  
			  }
		   }
          else if(config())
		  { 	  
		    //check for correct Employee Id & PWD match
			$result=mysql_query("SELECT * FROM `box_office_employees` WHERE `box_office_employees_id`='".$_POST['usrname']."' and `box_office_employees_pwd`='".$_POST['pwd']."'");
			
			$row = mysql_num_rows($result);
			if($row)
			{
			  // Start Session & add box_office_employees_id to Session 
		      session_start();
			  $_SESSION['box_office_employees_id']=$_POST['usrname'];
			 
			header("Location:main.php");
			}
			else
			{  
			  header("Location:adminlogin.php?err=failed");
			
			}
           }
		   
?>