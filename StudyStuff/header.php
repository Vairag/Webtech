<?php 

if (isset($_GET['logout']))
{
	if ($_GET['logout']=='yes')
	{
		session_start();  //fetching the current session
		session_destroy(); // destroying current fetchec session.
	}
}
Class Header {

	function __construct($title) {
		$pageTitle = "StudyStuff";
		if (isset($title)) {
			$pageTitle .= " - " . $title;

			// get the section
			if (isset($_SESSION['active_section'])) {
				$section =  $_SESSION['active_section'];
			} else {
				$section = basename($_SERVER["SCRIPT_FILENAME"], '.php');
			}
			$GLOBALS['active_section'] = $section;

		}		?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php print $pageTitle; ?></title>
<meta charset="utf-8">

<link rel="stylesheet" href="./css/reset.css" type="text/css"
	media="all">
<link rel="stylesheet" href="./css/style.css" type="text/css"
	media="all">

<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="./js/cufon-yui.js"></script>
<script type="text/javascript" src="./js/cufon-replace.js"></script>
<script type="text/javascript" src="./js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="./js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="./js/script.js"></script>
<script type="text/javascript" src="./js/css_browser_selector.js"></script>

<!--[if lt IE 7]>
							<link rel="stylesheet" href="css/ie/ie6.css" type="text/css" media="screen">
							<script type="text/javascript" src="js/ie_png.js"></script>
							<script type="text/javascript">
							ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');
			</script>
			<![endif]-->
<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
			<![endif]-->
</head>

<body>
	<div class="wrap">
		<!-- header -->
		<header>

			<div class="container">
				<h1>
					<a href="index.php">StudyStuff</a>
				</h1>

				<nav>
					<ul>
						<li <?php if ($section == "index") print('class="current"'); ?>><a
							href="index.php" class="m1">Home</a></li>

						<li
						<?php if ($section == "uploads" || $section == "download") print('class="current"'); ?>>
							<a href="uploads.php" class="m2">Material</a>
						</li>

						<li
						<?php if (($section == "university") || ($section == "view-university") || ($section == "adduniversity")) print('class="current"'); ?>>
							<a href="university.php" class="m3">University</a>
						</li>

						<li
						<?php if (($section == "courses") || ($section == "view-courses") || ($section == "addcourse")) print('class="current"'); ?>>
							<a href="courses.php" class="m4">Courses</a>
						</li>

						<?php
						if ($section == "my_account")
						{
							print('<li class="current last">');
						} else {
						print ("<li class='last'>");
						}
						?>
						<a href="my_account.php" class="m5">Profile</a>
						</li>
					</ul>
				</nav>

				<div id='welcome_user'>
					<div class="rowElem">
						<?php
						session_start();
						if(isset($_SESSION['username']))
						{
							echo "<span style='margin-right:10px;' >Logged in as ".$_SESSION['username']."</span>";
							echo "<a href='index.php?logout=yes'>Logout</a>";
							//  reset session is done, see first 10 lines of this file
						}
						?>
					</div>
				</div>


			</div>
		</header>
		<?php 
	}



}

?>