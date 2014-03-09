var searchresult = null;
var markerArray = [];

/* Search for movie theaters near the user's position and 
(if successfull) add the markers to the map
note: radiusInMeters is restricted to a maximum of 50000 (by google)*/
function findNearbyTheaters(map, currentLocation, radiusInMeters){
	deletePreviousMarkers();
	var query = {
		location: currentLocation,
		radius: radiusInMeters,
		types: ['movie_theater']
	}
	var finder = new google.maps.places.PlacesService(map);
	finder.nearbySearch(query, callback);
	
	//handle the searchresult
	function callback(results, status){
		//just some design for the markers
		var pinColor = "0BBF62";
		var pinImage = new google.maps.MarkerImage(
			"http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
			new google.maps.Size(21, 34),
			new google.maps.Point(0,0),
			new google.maps.Point(10, 34)
		);
		
		//search for cinemas was successfull:
		if((status == google.maps.places.PlacesServiceStatus.OK) && (results.length != 0)){
			var s = document.querySelector('#status');
			s.innerHTML = "<b>Search successfull! Please select a cinema by clicking a green marker!</b>";
			searchresult = results;
			//once nearby cinemas have been found, add them as markers to the map
			for (var i = 0; i < searchresult.length; i++){
				var tmpMarker = new google.maps.Marker({
					position: searchresult[i].geometry.location,
					title: searchresult[i].name,
					icon: pinImage,
					animation: google.maps.Animation.DROP,
					customLocation: searchresult[i].vicinity,
					map:map
				});
				markerArray.push(tmpMarker);
				google.maps.event.addListener(tmpMarker, 'click', function(){
					startOrder(this.title, this.customLocation);
				});
			}
			
		}else{ //unsucessfull search
			var s = document.querySelector('#status');
			s.innerHTML = "<b>Sorry. No results for your search were found.</b>";
		}
	}
}

function deletePreviousMarkers(){
	for (var i = 0; i < markerArray.length; i++ ){
		markerArray[i].setMap(null);
	}
}