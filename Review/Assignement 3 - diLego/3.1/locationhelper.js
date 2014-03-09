


/**
 * Contains methods to convert geocodes to addresses and other useful methods.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @param {google.maps.Geocoder} geocoder The geocoder service.
 * @constructor
 */
var LocationHelper = function(geocoder) {
  this.geocoder = geocoder;
};


/**
 * Tries to get the client's location using the HTML5 Geocoding API.
 * @param {function(Object.<(address|geo), string>)} callback A callback method
 *    which will receive the client's current location or null if it didn't
 *    succeed.
 */
LocationHelper.prototype.getClientLocation = function(callback) {
  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      callback({
        geo: new google.maps.LatLng(position.coords.latitude,
            position.coords.longitude)
      });
    }, function(error) {
      console.warn('Getting Geolocation failed.');
      callback(null);
    });
  } else {
    console.warn('Geolocation API not supported.');
    callback(null);
  }
};


/**
 * Processes the results of the Google Geocoding Service and returns the
 * processed results to the original caller.
 * @param {function(google.maps.LatLng)} callback The method which will receive
 *    the geocoded location or null if an error occurred.
 * @param {Array.<google.maps.GeocoderResult>} results A list of geocoding
 *    results.
 * @param {google.maps.GeocoderStatus} status Status of the geocoding request.
 */
LocationHelper.prototype.onGeocode = function(callback, results, status) {
  if (status !== google.maps.GeocoderStatus.OK) {
    callback(null);
  } else {
    callback(results[0].geometry.location);
  }
};


/**
 * Geocodes the given address using the Google Geocoding API.
 * @param {string} address An address to geocode.
 * @param {function(google.maps.LatLng)} callback The method which will receive
 *    the geocoded location or null if an error occurred.
 */
LocationHelper.prototype.geocode = function(address, callback) {
  this.geocoder.geocode({address: address},
      this.onGeocode.bind(this, callback));
};


/**
 * Looks for the Country value in an addressComponents object returned from the
 * Google Maps API.
 * @param {Array.<Object>} addressComponents The address_components field of a
 *    Places API response.
 * @return {string} A country identifier.
 */
LocationHelper.prototype.getCountry = function(addressComponents) {
  for (var i in addressComponents) {
    for (var j in addressComponents[i].types) {
      if (addressComponents[i].types[j] === 'country') {
        return addressComponents[i].short_name.toLowerCase();
      }
    }
  }

  // fallback value
  return 'us';
};
