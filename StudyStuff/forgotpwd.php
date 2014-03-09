<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php 
require 'header.php';
new Header('Startpage');
?>
   <div class="container">
     <?php require 'sidebar.php';?>
      <!-- content -->
      <section id="content">
         
         <div class="inside">
		   
			<h2>Forgot <span>your password ?</span></h2>
		    <form id="contacts-form" action="DBqueries.php" method="post" enctype="multipart/form-data">
		
			
			<div  class="field" style='color:#FF7B01;' >
				   <?php
						if($_GET['passwordsent']=="yes")
						{
						 echo "Your Password has been sent to your e-mail!";
						}else if($_GET['passwordsent']=="no")
						{
						 echo "Your User Name does not exist !! Please register a new User.";
						}
						
				   ?>
			</div> 
               <fieldset>
               <div class="field">
                  <label>Enter User Name:</label>
                  <input type="text" name="forgot_user_name" required="required" placeholder="Write your Username here"/>
               </div>
			                 
			   <div class="alignright"><input type='submit' value='Send Password on E-mail'/></div>
               
               </fieldset>
            </form>
           </div>
      </section>
   </div>
</div>
<!-- footer -->

<?php 
	require 'footer.php';
?>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
