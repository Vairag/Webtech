var map;
var userLocation;
var marker;

function success(position) {
    var s = document.querySelector('#status');

	if (s.className == 'success') {
		return;
    }

	s.innerHTML = "found you!";
    s.className = 'success';

    var mapcanvas = document.createElement('div');
    mapcanvas.id = 'mapcanvas';
    mapcanvas.style.height = '400px';
    mapcanvas.style.width = '560px';

    document.querySelector('article').appendChild(mapcanvas);

    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    userLocation = latlng; 
	var myOptions = {
        zoom: 13,
        center: latlng,
        mapTypeControl: false,
        navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

    marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: "You are here!"
    });
	//google.maps.event.addListener(marker, 'click', function(){alert("x")});
}

function error(msg) {
    var s = document.querySelector('#status');
    s.innerHTML = typeof msg == 'string' ? msg : "failed";
    s.className = 'fail';

    // console.log(arguments);
}
