
<?php 
require 'header.php';
new Header('Universities');
?>

<div class="container">
	<?php require 'sidebar.php';?>
      <!-- content -->
      <section id="content">
         
         <div class="inside">
            <h2>Add <span>New University</span></h2>
            <form id="contacts-form" action="insertuniversity.php" method="post" enctype="multipart/form-data">
               <fieldset>
               <div class="field">
                  <label>University Name:</label>
                  <input type="text" name="uni_name" required="required"/>
               </div>
			   <div class="field">
                  <label>University Image:</label>
                  <input type="file" name="uni_image"/> <span style='color:#8d8d8d;font-size:11px;'>Max. Size 2 MB, Dataformat: JPG,PNG,GIF </span>
				 
               </div>
			   
			   <div class="field">
                  <label>Source Link:</label>
                  <input type="text" required="required" name="souce_link"/>
               </div>
			  
               <div class="field extra">
                  <label>Description:</label>
                  <textarea cols="1" rows="1" name="description" placeholder="Max. 500 characters !"></textarea>
               </div>
			   
			    <div class="field">
                  <label>City:</label>
                  <input type="text" name="city" required="required" />
               </div>
			   <div class="field">
                  <label>Country:</label>
                  <input type="text" name="country" required="required" />
               </div>
			   <div class="alignleft"><input type='submit' value='Create University'/></div>
               
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
