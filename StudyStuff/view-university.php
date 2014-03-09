<?php 
require 'header.php';
new Header('Universities');
?>

   <div class="container">
      <?php require 'sidebar.php';?>
      <!-- content -->
      <section id="content">
         
         <div class="inside">
		 <?php
	if(isset($_GET['university_id']))
	{
	 	 if(config())
		 { 
		   $query1 = "SELECT * FROM  universities where uni_id=".$_GET['university_id']." order by uni_name ASC";
			$result=mysql_query($query1);
			
			while($row = mysql_fetch_array($result))
            {
			 
			  echo"<table>
			       <tr>
							<td colspan='2'> <h3>".$row['uni_name']."</h3> </td>
							<td colspan='3'> </td>
				   </tr>
				   <tr>
							<td colspan='2' width='340'><a style='color:blue;' target='_blank' href='".$row['uni_src_link']."'>Source Link</a> </td>
							
							<td width='20'> </td>
							<td colspan='2' width='220' style='padding-left:10px;'>  <h4>City :&nbsp;&nbsp;<span> ".$row['uni_city'].",".$row['uni_country']."</span></h4></td>
							 
				   </tr>
				   <tr>	
				            
							<td colspan='4' width='470'> ".$row['uni_description']."...<br><a style='' href='university.php'>Back</a></td>
							<td> <img style='padding-left:10px;' src='./".$row['uni_image']."' height='80' width='150' /> </td>
					</tr>				
		            </table><hr>";	
			}
			
			
			 echo "<h4>Courses <span> offered in the University :::</span></h4>";
			
			$query2 = "SELECT * FROM  courses where uni_id=".$_GET['university_id']." order by uni_name ASC";
			$result=mysql_query($query2);
			
			while($row = mysql_fetch_array($result))
            {
			 
			  echo"<table>
			       <tr>
							<td ><a class='uni_course_link' href='view-courses.php?course_id=".$row['course_id']."'> <h5>".$row['course_type']." ".$row['course_name']."</h5> </td>
							
				   </tr>
				   			
		            </table><hr>";
			}
			
		 }
	}	 
		 ?>
		 
            
         </div>
      </section>
   </div>
</div>
<!-- footer -->
<?php require 'footer.php'; ?>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
