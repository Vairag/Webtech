<!-- aside -->
<aside>

	<?php if(!isset($_SESSION['username'])) { ?>

	<form id='loginform' action="DBqueries.php" method="post"
		enctype="multipart/form-data">
		<fieldset>
			<div class="rowElem">
				<h3 style='padding-left: 10px; padding-top: 10px;'>Login</h3>

				<div class="aligncenter">
					Username: <input name="login_username" id="username" type="text"
						required="required" /><br /> <br /> Password: <input
						name="login_pwd" id="pwd" type="password" required="required" /><br />
					<br />
				</div>
				<div>
					<input type="submit" id="buttonsubmit"
						style="margin-left: 75px; width: 157px;" value="LOGIN" />
				</div>
				<div class="aligncenter">
					<br /> <a id="newuser" href="newuser.php"> Register New ? </a><br />
					<br /> <a href="forgotpwd.php">Forgot your Password ?</a>
				</div>
			</div>
		</fieldset>
	</form>

	<?php 
	// end of login form
} else {
		// TODO: add logout button. -Done in Header file !!
	 if (($GLOBALS['active_section'] == "courses") || ($GLOBALS['active_section'] == "addcourse") || ($GLOBALS['active_section'] == "view-courses")){
	 	  echo "<form id='newsletter-form'>
            <fieldset>
            <div class='rowElem'>
               <h3>Add  Course</h3>
			   <a id='add_uni' href='/addcourse.php'>Add  Course</a>
             </div>
            </fieldset>
         </form>";
	  }else if (($GLOBALS['active_section'] == "university") || ($GLOBALS['active_section'] == "adduniversity") || ($GLOBALS['active_section'] == "view-university")){
	 	  echo "<form id='newsletter-form'>
            <fieldset>
            <div class='rowElem'>
               <h3>Add  University</h3>
			   <a id='add_uni' href='adduniversity.php'>Add  University</a>
             </div>
            </fieldset>
         </form>";
	  }
		
	}
	?>

	
	<?php if ($GLOBALS['active_section'] != "my_account") {
	require 'config.php';
	print("<hr />");
	require_once 'config.php';
	if(config())
	{
		// fetches the four latest attachments from db (with their ratings)
		$query1 = "SELECT A.id, A.name, A.path, A.date, AVG(rating) AS rating, A.downloads
			FROM `attachments` AS A Left JOIN `ratings` AS B ON A.id = B.attachment_id
			GROUP BY A.id ORDER BY A.date DESC LIMIT 5";
		$attachments = mysql_query($query1);

		?>

	<h2>
		Latest<span> uploads</span>
	</h2>
	<ul class="news">

		<?php 		
		while($row = mysql_fetch_array($attachments))
		{
			$id = $row['id'];
			$name = $row['name'];
			$date = date('F d, Y h:mA', strtotime($row['date']));
			$path = $row['path'];
			$downloads = $row['downloads'];
			$rating = $row['rating'];

			print "<li>";
			print "<strong>$date</strong>";
			print "<a href='download.php?id=$id'> <h4>$name</h4> </a>";

			// display stars only if rating is availible, > 0 and <=5.
			if (isset($rating) && $rating <= 5) {
				$rating = round($rating);
				print "<img src=\"./images/" . $rating . "star.png\" height=\"15\" alt=\"rating star\">";
			} else {
				print "no ratings yet";
				}
				print "</li>";
	} ?>

	</ul>
	<?php 
	}
	}
	?>


</aside>
