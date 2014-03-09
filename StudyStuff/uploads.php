
<?php 
require 'header.php';
new Header('Material');
?>

<div class="container">
	<?php require 'sidebar.php';?>
	<!-- content -->
	<section id="content">

		<div class="inside">

			<h3>Search our big collection of useful university materials.</h3>

			<script>
		  (function() {
			var cx = '004966871163279697204:oro0q4bmhls';
			var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
			gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
				'//www.google.com/cse/cse.js?cx=' + cx;
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
		  })();
		</script>
			<div class="gcse-searchbox">
				<gcse:search></gcse:search>
			</div>

			<br />
			<?php
			if(config())
			{
				$limit = 5;
				$query1 = "SELECT A.id, A.name, A.path, A.date, AVG(rating) AS rating, A.comment, A.downloads
				FROM `attachments` AS A Left JOIN `ratings` AS B ON A.id = B.attachment_id
				GROUP BY A.id ORDER BY rating DESC LIMIT $limit";
				$attachments = mysql_query($query1);

				$most_downloaded_q = "SELECT A.id, A.name, A.path, COUNT(rating) AS count, A.date, AVG(rating) AS rating, A.comment, A.downloads
				FROM `attachments` AS A Left JOIN `ratings` AS B ON A.id = B.attachment_id
				GROUP BY A.id ORDER BY count DESC LIMIT $limit";
				$most_downloaded = mysql_query($most_downloaded_q);
			}
			?>



			<table style="border-spacing: 10px; border-collapse: collapse;">
				<tbody>
					<tr>
						<td><h3>Best rating</h3></td>
						<td><h3>Most popular</h3></td>
					</tr>
					<tr>
						<td><?php 
						require_once 'attachment.php';
						while($row = mysql_fetch_array($attachments))
						{
							$attachment = new attachment($row);

							print "<section>";
							print "<a href='download.php?id=$attachment->id'> <h4>$attachment->name</h4></a>";

							// display stars only if rating is availible, > 0 and <=5.
							$rating = $attachment->rating;
							if (isset($rating) && $rating <= 5) {
								$rating = round($rating);
								print "<img src=\"./images/" . $rating
								. "star.png\" alt=\"rating start\" height=\"15\">";
							} else {
							print "no ratings yet";
							}

							print "<p>$attachment->commentshort</p>";
							print "</section>";
						}
						?></td>

						<td><?php 
						require_once 'attachment.php';
						while($row = mysql_fetch_array($most_downloaded))
						{
							$attachment = new attachment($row);

							print "<section>";
							print "<a href='download.php?id=$attachment->id'> <h4>$attachment->name</h4></a>";

							// display stars only if rating is availible, > 0 and <=5.
							$rating = $attachment->rating;
							if (isset($rating) && $rating <= 5) {
								$rating = round($rating);
								print "<img src=\"./images/" . $rating
								. "star.png\" alt=\"rating start\" height=\"15\">";
							} else {
							print "no ratings yet";
							}

							print "<p>$attachment->commentshort</p>";
							print "</section>";
						}
						?></td>
					</tr>
				</tbody>
			</table>

		</div>
	</section>
</div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
