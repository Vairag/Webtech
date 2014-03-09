<?php 
require 'header.php';
new Header('Courses');
?>

<script
	src="http://code.jquery.com/jquery-latest.js"></script>
<script
	src="./js/rating_disabled.js"></script>
<div class="container">
	<?php require 'sidebar.php';?>
	<!-- content -->
	<section id="content">

		<div class="inside">
			<?php
			if(isset($_GET['course_id']))
			{

				require_once 'config.php';
				if(config())
				{
		   $query1 = "SELECT * FROM  courses where course_id=".$_GET['course_id']." order by course_name ASC";
		   $result=mysql_query($query1);

		   while($row = mysql_fetch_array($result))
            { ?>

			echo"
			<table>
				<tr>
					<td colspan='5'>
						<h3>
							<?php print($row['course_type'] . " " . $row['course_name']);?>
						</h3>
					</td>

				</tr>
				<tr>

					<td colspan='2' width='350'>
						<h4>
							University:&nbsp;&nbsp;<span><?=$row['uni_name']?> </span>
						</h4>
					</td>

					<td colspan='2' width='250' align='right'><h4>
							Field of Study :&nbsp;&nbsp;<span><?=$row['field_of_study']?> </span>
						</h4>
					</td>
					<td>&nbsp;</td>

				</tr>
				<tr>
					<td colspan='4' width='440'><?=$row['description']?></td>
					<td width='160'><img style='padding-left: 10px;'
						src="<?=$row['course_image']?>" alt='course picture' height='100'
						width='150' />
					</td>

				</tr>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan='5'>
						<h4>Official website:</h4>
						<p>
							<a href="<?=$row['source_link']?>"><?=$row['source_link']?></a>
						</p>
					</td>

				</tr>
				<tr>
					<td colspan='5'>
						<h4>Related Links :&nbsp;&nbsp;</h4>
						<p>
							<a href="<?=$row['related_links']?>"><?=$row['related_links']?> </a>
						</p> <br /> <a href='courses.php'>Back</a>
					</td>


				</tr>
			</table>
			<hr>
			<?php }

			if(!isset($_SESSION['username'])) {
			// For not logged in Users
					echo "<h4>Attached <span> materials :::</span></h4>";
					$query1 = "SELECT * FROM  attachments where course_id=".$_GET['course_id']." order by id DESC";
					$result=mysql_query($query1);
					$print_table="<table>";

					while($row = mysql_fetch_array($result))
					{
						$new_path = substr($row['path'], 1);
						$print_table=$print_table."<tr><td align='right'><a href=download.php?id=".$row['id'].">".$row['name']."</a></td><td><div id='r".$row['id']."' class='rate_widget'>
		   		<div class='star_1 ratings_stars'></div>
		   		<div class='star_2 ratings_stars'></div>
		   		<div class='star_3 ratings_stars'></div>
		   		<div class='star_4 ratings_stars'></div>
		   		<div class='star_5 ratings_stars'></div>
		   		<div class='total_votes'>vote data</div>
		   		</div></td></tr>";
					}
					$print_table=$print_table."</table><hr>";
					echo $print_table;
			}else{  ?>

			<!--For Logged in Users  -->
			<h4>
				Upload <span> related material to above Course :::</span>
			</h4>
			<form id="attachment-form"
				action="attachment_upload.php?uid=<?php echo $_SESSION['username'].'&cid='.$_GET['course_id']; ?>"
				method="post" enctype="multipart/form-data">
				<fieldset>

					<div class="field">
						<input type="text" name="attachment_name" required="required"
							placeholder="Description" /> <input type="file"
							name="attachement_file" required="required" /> <input
							type='submit' id='attachment_uploadbtn' value='Upload' />
					</div>

				</fieldset>
			</form>
			<hr>
			<script src="./js/rating.js"></script>
			<h4>
				Your Uploaded <span> materials :::</span>
			</h4>
			<?php
			if(isset($_GET['course_id']))
			{

				if(config())
				{

					$query1 = "SELECT * FROM  attachments where course_id=".$_GET['course_id']." and username='".$_SESSION['username']."' order by id DESC";
					$result=mysql_query($query1);
					$print_table="<table>";

					while($row = mysql_fetch_array($result))
					{
					 $print_table=$print_table."<tr><td align='right'><a title='click to open or download' href=download.php?id=".$row['id'].">".$row['name']."</a></td><td><div id='r".$row['id']."' class='rate_widget'>
		   		<div class='star_1 ratings_stars'></div>
		   		<div class='star_2 ratings_stars'></div>
		   		<div class='star_3 ratings_stars'></div>
		   		<div class='star_4 ratings_stars'></div>
		   		<div class='star_5 ratings_stars'></div>
		   		<div class='total_votes'>vote data</div>
		   		</div></td><td align='left'><a href='attachment_upload.php?attachment_id=".$row['id']."&courseid=".$_GET['course_id']."'><img align='left' src='./images/delete.png' title='Delete attachment !' height='20'  width='20' /><a></td></tr>";
					}
					$print_table=$print_table."</table>";
					echo $print_table;


					echo "<h4>Attached <span> materials by Others :::</span></h4>";

					$query1 = "SELECT * FROM  attachments where course_id=".$_GET['course_id']." and username!='".$_SESSION['username']."' order by id DESC";
					$result=mysql_query($query1);
					$print_table="<table>";
					while($row = mysql_fetch_array($result))
					{
					 $print_table=$print_table."<tr><td align='right'><a title='click to open or download' target='_blank' href='".$row['path']."'>".$row['name']."</a></td><td><div id='r".$row['id']."' class='rate_widget'>
								<div class='star_1 ratings_stars'></div>
								<div class='star_2 ratings_stars'></div>
								<div class='star_3 ratings_stars'></div>
								<div class='star_4 ratings_stars'></div>
								<div class='star_5 ratings_stars'></div>
								<div class='total_votes'>vote data</div><td><br></tr></div></tr>";
					}
					$print_table=$print_table."</table><hr>";
					echo $print_table;
				}
			}
		 ?>

			<?php
			}

				}
			}
		 ?>

			<h3>Comments</h3>
			<a style="float: right;" href="#comment-form2"> Add Comment</a>

			<?php 
			$query1 = "SELECT * FROM  comments where course_id=".$_GET['course_id']." order by id DESC";
			$result=mysql_query($query1);
			$allcomments="";

			while($row = mysql_fetch_array($result))
			{
				$date = date('F d, Y h:mA', strtotime($row['date']));
				$allcomments=$allcomments."<h4>".$row['username']." <span>".$date."</span></h4>
					<p>".$row['comment']."</p>";
			}

			echo  $allcomments;

			?>


			<form id="comment-form2" action="insertcomment.php" method="post"
				enctype="multipart/form-data">
				<fieldset>

					<div class="field extra">
						<label>Give your Comment:</label>
						<textarea cols="1" rows="1" name="comment_text"
							placeholder="Write your comment here"></textarea>

					</div>
					<input type="hidden" name="username"
						value="<?php echo $_SESSION['username']; ?>" /> <input
						type="hidden" name="course_id"
						value="<?php echo $_GET['course_id']; ?>" />
					<div class="field">
						<input type='submit' id="commentbtn" value='Comment' />
					</div>

				</fieldset>
			</form>

		</div>
	</section>
</div>
</div>
<!-- footer -->
<?php require 'footer.php'; ?>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
