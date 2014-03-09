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
		     
            <h2>Create <span>new user</span></h2>
            <form id="contacts-form" action="DBqueries.php" method="post" enctype="multipart/form-data">
		
			
			<div  class="field" style='color:#FF7B01;' >
				   <?php
						if($_GET['creteduser']=="yes")
						{
						 echo "Please, login with your new Username & Password!";
						}
				   ?>
			</div> 
               <fieldset>
               <div class="field">
                  <label>User Name:</label>
                  <input type="text" name="user_name" required="required" placeholder="Write your username here"/>
               </div>
			   
			   
			   <div class="field">
                  <label>E-mail:</label>
                  <input type="email" required="required" name="email" placeholder="Write your valid email here"/>
               </div>
			   <div class="field">
                  <label>Password:</label>
                  <input type="password" required="required" name="pwd" placeholder="Write password here"/>
               </div>
			  
               
			   <div class="alignright"><input type='submit' value='Create User'/></div>
               
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
