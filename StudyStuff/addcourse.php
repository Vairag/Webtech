
<?php 
require 'header.php';
new Header('Courses');
?>


<div class="container">
	<?php require 'sidebar.php'; ?>
	<!-- content -->
	<section id="content">

		<div class="inside">
			<h2>
				Add <span>New Course of the University</span>
			</h2>
			<form id="contacts-form" action="insertcourse.php" method="post" enctype="multipart/form-data">
				<fieldset>
				    <div class="field">
						<label>University Name:</label> <select required="required"
							name="uni_id">
							<?php
							
							if(config())
							{
								$query1 = "SELECT uni_id, uni_name FROM  universities order by uni_name ASC";
								$result=mysql_query($query1);
									
								while($row = mysql_fetch_array($result))
								{

									echo "<option value='".$row['uni_id']."'>".$row['uni_name']."</option>";
								}
							}
							?>
						</select> OR <a id='add_uni' href="adduniversity.php">Add
							University</a>
					</div>
					<div class="field">
						<label>Course Image:</label> <input type="file"
							name="course_image" /> <span
							style='color: #8d8d8d; font-size: 11px;'>Max. Size 2 MB,
							Dataformat: JPG,PNG,GIF </span>

					</div>
					
					<div class="field">
						<label>Field of Study:</label> <select required="required"
							name="field_of_study">

							<option value="Engineering">Engineering</option>
							<option value="Medical">Medical</option>

							<option value="Arts">Arts</option>
							<option value="Others">Others</option>

						</select>
					</div>
					<div class="field">
						<label>Course Type:</label> <select required="required"
							name="course_type">

							<option value="Masters">Masters</option>
							<option value="Bachelors">Bachelors</option>

						</select>
					</div>
					<div class="field">
						<label>Course Name:</label> <input type="text" required="required"
							name="course_name" />
					</div>
					<div class="field">
						<label>Source Link:</label> <input type="text" required="required"
							name="source_link" />
					</div>

					<div class="field extra">
						<label>Description:</label>
						<textarea cols="1" rows="1" name="description" placeholder="Max. 500 characters !"></textarea>
					</div>
					<div class="field">
						<label>Related Links:</label> <input type="text"
							name="related_links" /> <span
							style='color: #8d8d8d; font-size: 11px;'>Separated by comma (,) !</span>
					</div>
					<div class="alignleft">
						<input type='submit' value='Create Course' />
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
