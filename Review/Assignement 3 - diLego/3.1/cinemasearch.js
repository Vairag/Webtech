


/**
 * Provides the search logic. Makes use of the Google Places API to find
 * relevant cinemas.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @constructor
 * @param {LocationHelper} locationHelper A LocationHelper instance.
 * @param {google.maps.places.PlacesService} placesService The Google Places API
 *    library.
 */
var CinemaSearch = function(locationHelper, placesService) {
  this.locationHelper = locationHelper;
  this.placesService = placesService;
};


/**
 * Processes results of a Places API query and returns the processed results to
 * the actual caller.
 * @param {function(Array.<Object.<(name|reference|geo), *>>)} callback The
 *    callback method which will receive the results.
 * @param {Array.<google.maps.places.PlaceResult>} results A list of results.
 * @param {google.maps.places.PlacesServiceStatus} status The request status.
 * @param {google.maps.places.PlacesSearchPagination} pagination An object used
 *    to fetch additional pages of Places results.
 * @private
 */
CinemaSearch.prototype.onSearchResults_ = function(callback, results, status,
    pagination) {
  if (status !== google.maps.places.PlacesServiceStatus.OK) {
    console.warn('Got unexpected status from Places API query: ' + status);
    callback(null);
  } else {
    var cinemas = [];
    for (var i in results) {
      cinemas.push({
        name: results[i].name,
        reference: results[i].reference,
        geo: results[i].geometry.location
      });
    }
    callback(cinemas);
  }
};


/**
 * Searches for cinemas in a given area.
 * @param {Object<(address|geo), *>} query A query object containing either
 *    an address or geocoordinates.
 * @param {function(Array.<Object.<(name|reference|geo), *>>)} callback A
 *    callback method that will receive a list of search results or null if an
 *    error occurred.
 */
CinemaSearch.prototype.search = function(query, callback) {
  // The Places API query can only be performed when having lat/lng coordinates,
  // so check for that first.
  if (!query.geo) {
    if (query.address) {
      // Geocode address and run this method again
      var onGeocode = function(latLng) {
        if (latLng !== null) {
          this.search({geo: latLng}, callback);
        }
      };

      this.locationHelper.geocode(query.address, onGeocode.bind(this));
    } else {
      console.warn('Search performed without valid location query.');
    }
    return;
  }

  var queryParameters = {
    keyword: 'movies',
    location: query.geo,
    radius: 25000,
    rankBy: google.maps.places.RankBy.PROMINENCE,
    types: ['movie_theater']
  };

  this.placesService.nearbySearch(queryParameters,
      this.onSearchResults_.bind(this, callback));
};
