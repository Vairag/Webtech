<!DOCTYPE HTML>
<html>

<head>

    <title>Movie Ticket Reservation</title>

    <link rel="stylesheet" href="css/style.css" />
    <link href="css/smoothness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
    <script src="js/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui-1.9.1.custom.js"></script>
    <script src="js/basic.js" type="text/javascript"></script>
    <script src="js/locate.js"></script>
	<script src="js/theaters.js" type="text/javascript"></script>
	<script src="js/simplemodal.js" type="text/javascript"></script>
	<script src="js/orderHelper.js" type="text/javascript"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false" type="text/javascript"></script>
	
	  <link href="css/jquery.tweet.css" rel="stylesheet"/>
  <script src="js/jquery.tweet.js" charset="utf-8"></script>
  <script type="text/javascript">
    function randomString(length) {
      var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
      var str = '';
      for (var i = 0; i < length; i++) {
        str += chars[Math.floor(Math.random() * chars.length)];
      }
      return str;
    }
    var rnd = randomString(8);

    jQuery(function($) {
      $(".rnd").replaceWith(rnd);
      $(".feed .code").hide().each(function(i, e){ eval($(e).text()); });
    });
	  </script>
</head>

<body>

    <header>
        <h1>Movie Ticket Reservation</h1>
    </header>

    <nav id="nav">        
        <a href="adminlogin.php">Box Office</a>
		<a href="#home">Cinemas</a>
        <a href="#home2">Bar</a>
    </nav>

    <section id="content">
		<section id="map">
           <article>
                <p><span id="status">Please wait while we try to locate you... <a href="index.htm">try again</a></span></p>
				<input type="button" id="submitbutton" value="Search for nearby cinemas" onclick="findNearbyTheaters(map, userLocation, 15000)"/>
			</article>
            <script>
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(success, error);
                } else {
                    error('not supported');
                }

            </script>
        </section>
		
		
		<div id='fb-root'></div>
		<p id='msg'></p> 
		<script src='http://connect.facebook.net/en_US/all.js'></script>
		<script> 
			FB.init({appId: "397453840329120", status: true, cookie: true});
		</script>
	</section>

	
	<section class="feed">
	
	 <span style='font-size: 14px; margin-left:20px;margin-left:20px'> 
		Note : Search Cinemas, which are close to your location and reserve tickets for movie.
	 </span>
    
    </section>


    <footer>
        Ticket Reservation | RWTH Aachen University | By : Vairag  Godhani
    </footer>

</body>

</html>
