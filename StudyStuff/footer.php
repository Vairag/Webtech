
<!-- footer -->
<footer>
	<div class="container">
		<div class="inside">
			<div class="wrapper">
				<div class="fleft">
					WebTech Project for the RWTH Aachen University 2012/13: <span>StudyStuff</span>
				</div>
				<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=520947037926309";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				<div id='fb_like' class="fb-like" data-href="http://webtech.tobiasschuerg.de/" data-send="false" data-width="450" data-show-faces="true"></div>
				<input type="button" id="fbsharebtn" onclick='postToFeed(); return false;' value=" "/> 
				<script src='http://connect.facebook.net/en_US/all.js'></script>
				<script> 
				  FB.init({appId: "520947037926309", status: true, cookie: true});

				  function postToFeed() {

					// calling the API ...
					var obj = {
					  method: 'feed',
					  redirect_uri: 'http://webtech.tobiasschuerg.de/',
					  link: 'http://webtech.tobiasschuerg.de/',
					  picture: 'http://webtech.tobiasschuerg.de/images/logo.jpg',
					  name: 'Wow...StudyStuff is COOL !!!',
					  caption: 'StudyStuff offers you access to a large database of material, which students just like you uploaded, to make learning for others simpler.',
					  description: 'By registering, you will get the permission to rate an comment uploads, or upload material yourself!'
					};

					function callback(response) {
					 
					}

					FB.ui(obj, callback);
				  }
				
				</script>
			</div>
		</div>
	</div>
</footer>
