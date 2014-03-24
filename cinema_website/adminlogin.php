<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<html>
<head>
    
	<script type="text/javascript">
	function cancelForm()
	{  
		document.forms["loginform"]["usrname"].value="";
		document.forms["loginform"]["pwd"].value="";
		
	}
    </script>	
</head>
<body>
<div style="margin-left:300px;">

<h1>BoX Office Employee Panel</h1>
<div id="area">
<form name="loginform" action="checklogin.php" method="post" enctype="multipart/form-data" >


	Employee Id :&nbsp;&nbsp;<input name="usrname" id="usrname" type="text" required="required"/><br/><br/>
    Password &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input name="pwd" id="pwd" type="password" required="required"/><br/><br/>
	<input type="submit" id="buttonsubmit" value="LOGIN"/>
	<input type="button" id="buttoncancel" value="Back to HOME Panel" ONCLICK="window.location.href='index.php'"/>
	
	
	<div  style='color:red;' >
		   <?php
		       if($_GET['err']=="failed")
			    {
			     echo "Username or Password is not correct!";
			    }   
		   ?>
    </div>  
	
	<div  style='color:green;' >
		   <?php
                if($_GET['creteduser']=="yes")
			    {
			     echo "Please, login with your new Employee Id & Password!";
			    }
		   ?>
    </div> 
</form>
<h3>Default Logins:<br> Employee Id : employee1 & Password : boxoffice 
    
</h3>

<a id="newuser" href="adminlogin.php?err=newuser">Don't have account! Register Now ? </a>
<br/>
<?php
if($_GET['err']=="newuser")
{
    $create_form="<h2> Create New Employee ! </h2>"
	   ."<form name='createform' action='checklogin.php' method='post' enctype='multipart/form-data'>"
	."Employee Id :&nbsp;&nbsp;<input name='emp_id' id='emp_id' type='text' required='required'/><br/><br/>"
    ."Password &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input name='emp_pwd' id='emp_pwd' type='password' required='required'/><br/><br/>"
	."<input type='submit' id='buttonsubmit' value='Create New Employee'/>"
	."<input type='button' id='buttoncancel' value='Cancel' ONCLICK='window.location.href=\"adminlogin.php\"'/>	</form>";
	echo $create_form;
}
?>  
</div>
</div>
</body>
</html>
