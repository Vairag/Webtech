<?php

// Database connection
	include("config.php");
	  if(config())
	  { 		  
		
		$result=mysql_query("select * from reservation where reservation_id='".$_GET['r_id']."'");
		
		while($row = mysql_fetch_array($result))
        {
		  $table_string="<table> 
						<tr>
							<td>Reservation ID :</td><td > ".$row['reservation_id']." </td>
						</tr>
						<tr>
							<td>Movie Viewer :</td><td > ".$row['user_name']." </td>
						</tr>
						<tr>
							<td>Contact email ID :</td><td > ".$row['user_email']." </td>
						</tr>
						<tr>
							<td>Cinema Name :</td><td > ".$row['cinema_name']." </td>
						</tr>
						<tr>
							<td>Movie Name :</td><td > ".$row['movie_name']." </td>
						</tr>
						<tr>
							<td>Seat Numbers :</td><td > ".$row['seats']." </td>
						</tr>
						<tr>
							<td><input type='button' value='Print' ONCLICK='window.print();'/></td><td ><input type='button' value='Back' ONCLICK='window.location.href=\"main.php\"'/></td>
						</tr>
						</table>";	
					
		}
		echo $table_string;
		
		//header("Location:main.php");   		  
	  }
	  else
	  {  die("Database Selection Failed:".mysql_error());
	  }

   
 
		
?>