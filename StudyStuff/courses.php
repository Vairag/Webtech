
<?php 
require 'header.php';
new Header('Courses');
?>


<div class="container">
	<?php require 'sidebar.php'; ?>

	<section id="content">

		<div class="inside">
			<?php
			require_once 'config.php';
			if(config())
			{
					
				$query1 = "SELECT * FROM  courses order by course_name ASC";
				$result=mysql_query($query1);
					
				while($row = mysql_fetch_array($result))
				{
			  $short_desc = substr($row['description'], 0, 200);
			  echo"<table>
						<tr>
						<td colspan='2'> <h3>".$row['course_type']." ".$row['course_name']."</h3> </td>
						<td colspan='3'> </td>
						</tr>
						<tr>
						<td colspan='2' width='340'> <h4>University: &nbsp;&nbsp;<span>".$row['uni_name']." </span> </h4></td>
									
								<td width='20'> </td>
								<td colspan='2' width='220' style='padding-left:10px;'>  </td>

									
								</tr>
								<tr>
								<td colspan='4' width='470'> ".$short_desc."...<br><a style='' href='view-courses.php?course_id=".$row['course_id']."'>More...</a></td>
										<td> <img style='padding-left:10px;' src='./".$row['course_image']."' alt='Course picture' height='80' width='150' /> </td>

										</tr>
										</table><hr>";
				}
					
			}
			?>


		</div>
	</section>
</div>
</div>

<?php require 'footer.php'; ?>

<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
