
<?php 
require 'header.php';
new Header('Universities');
?>

<div class="container">
	<?php require 'sidebar.php';?>
	<!-- content -->
	<section id="content">

		<div class="inside">
			<?php
			if(config())
			{
				// Fetch all the universities

				$query1 = "SELECT * FROM  universities order by uni_name ASC";
				$result=mysql_query($query1);
					
				while($row = mysql_fetch_array($result))
				{
			  $short_desc = substr($row['uni_description'], 0, 200); ?>

			<table>
				<tr>
					<td colspan='5'>
						<h3>
							<?=$row['uni_name']?>
						</h3>
					</td>
				</tr>
				<tr>
					<td colspan='2'><a style='color: blue; width: 340px'
						href="<?=$row['uni_src_link']?>" target="_blank"><?=$row['uni_name']?>
							Website</a>
					</td>

					<td style="width: 20px;"></td>

					<td colspan='2'
						style="padding-left: 10px; width: 220px; text-align: right;">
						<h4>
							City :&nbsp;&nbsp; <span> <?=$row['uni_city']?>, <?=$row['uni_country']?>
							</span>
						</h4>
					</td>

				</tr>
				<tr>

					<td colspan="4"><?=$short_desc?>"...<br> <a style="width: 470px;"
						href="view-university.php?university_id=<?=$row['uni_id']?>">View
							Courses of <?=$row['uni_name']?>...
					</a>
					</td>
					
					<td style="text-align: right;"><img
						style="padding-left: 10px; height: 80px;"
						src="<?=$row['uni_image']?>" alt="university logo" />
					</td>
				</tr>
			</table>
			<hr>
			<?php  	}

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
