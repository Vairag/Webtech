
<?php 
require 'header.php';
new Header('Download');
?>

<div class="container">
	<?php require 'sidebar.php';?>
	
	<!-- content -->
	<section id="content">
	
	
	<?php 
	require_once 'config.php';
	$attachmentID = $_GET["id"];
	if(config())
	{
		// fetches the four latest attachments from db (with their ratings)
		$query1 = "SELECT A.id, A.name, A.comment, A.path, A.date, AVG(rating) AS rating, A.downloads, A.course_id
				FROM `attachments` AS A Left JOIN `ratings` AS B ON A.id = B.attachment_id
				WHERE A.id = $attachmentID GROUP BY A.id";
		$attachments = mysql_query($query1);

		
		while($row = mysql_fetch_array($attachments))
		{
			$id = $row['id'];
			$name = $row['name'];
			$comment = $row['comment'];
			$date = date('F d, Y h:mA', strtotime($row['date']));
			$path = $row['path'];
			$downloads = $row['downloads'];
			$rating = $row['rating'];
			$courseID = $row['course_id'];

			print "<h2>Download<span> $name</span></h2>";

			print "<h4>Changed: <span>$date</span></h4>";
			
			// display stars only if rating is availible, > 0 and <=5.
			if (isset($rating) && $rating <= 5) {
				$rating = round($rating);
				print "<h4>Rating: <img src=\"./images/" . $rating . "star.png\" alt='Rating star' height=\"15\"></h4>";
			} else {
				print "No ratings yet";
			}			
					
			print "<p>$comment</p>";			
			
			print "<p><center><a href='$path' target='_blank'> <h3>download now</h3> </a></center>";
			
			$queryCourse = "SELECT course_name, uni_name FROM `courses` WHERE `course_id` = $courseID";
			$courseQuery = mysql_query($queryCourse);
			if ($courseArray = mysql_fetch_array($courseQuery) ) {
				$university = $courseArray['uni_name'];
				$course = $courseArray['course_name'];
				print "<p>This file belongs to the course ";
				print "<a href='view-courses.php?course_id=$courseID'>$course</a> of $university.</p>";
			}
		}
	} ?>
	
	<hr /> <br />
	
		<h3>Comments</h3> <a style="float:right;" href="#comment-form"> Add Comment</a>
		
		<?php 
		       $query1 = "SELECT * FROM  comments where attachment_id=".$attachmentID." order by id DESC";
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
		
		
	    <form id="comment-form" action="insertcomment.php" method="post" enctype="multipart/form-data">
				<fieldset>
				   
					<div class="field extra">
						<label>Give your Comment:</label>
						<textarea cols="1" rows="1" name="comment_text" placeholder="Write your comment here"></textarea>
						
					</div>
					<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"/>
					<input type="hidden" name="attachment_id" value="<?php echo $attachmentID; ?>"/>
					<div class="field">
						<input type='submit' id="commentbtn" value='Comment' />
					</div>

				</fieldset>
			</form>
	    
	
	
	</section>
	
</div>
</div>

<?php 
	require 'footer.php';
?>
			
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
