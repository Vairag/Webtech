
<?php 
require 'header.php';
new Header('My Account');
?>

<div class="container">

	<?php require 'sidebar.php';?>

	<!-- content -->
	<section id="content">
	
	<?php if(!isset($_SESSION['username'])) {		
	// NOT LOGGED IN ?>

		<div class="inside">
			<h3>
				Not registered yet? <span>Be part of the community!</span>
			</h3>
			<p>
				<a href="newuser.php">Sign up for a new Account!</a>
			</p>


			<div class="img-box">
				<p>
					<img src="images/register.png" height="200" alt='register'><span class="txt1">StudyStuff</span>
					offers you access to a large database of materials, which students
					just like you uploaded, to make learning for others simpler.
				</p>

				<p>By registering, you will get the permission to rate an comment
					uploads, or upload material yourself!</p>

				<a href="newuser.php">Sign up now!</a>
			</div>
		</div>
		
		<?php  } else { ?>
		
		<div class="inside">
            
            <h2>Your Personal <span>Data</span></h2>
            <form id="contacts-form" action="DBqueries.php" method="post" enctype="multipart/form-data">
               <div  class="field" style='color:#FF7B01;' >
				   <?php
						if(isset ($_GET['updated']) && $_GET['updated'] == "yes")
						{
						 echo "Your data has been successfully Updated!";
						}
				   ?>
			   </div> 
			   
			   <fieldset>
               <div class="field">
                  <label>User Name::</label>
                  <input type="text" required="required" name="acc_user_name" value="<?php echo $_SESSION['username']; ?>"/>
               </div>
               <div class="field">
                  <label>E-mail:</label>
                  <input type="email" required="required" name="acc_email" value="<?php echo $_SESSION['user_email']; ?>"/>
               </div>
               <div class="field">
                  <label>New Password:</label>
                  <input type="password" required="required" name="acc_pwd" value="" placeholder="Write your new Password"/>
               </div>
               <div class="alignright"><input type='submit' value='Update Data'/></div>
               </fieldset>
            </form>
         </div>
		
		<?php } // end of logged in block?>
		
	</section>
</div>
</div>

<?php require 'footer.php';	?>

<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
