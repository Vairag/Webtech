


/**
 * Our main class, bringing all the parts together.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @constructor
 */
var MovieList = function() {
  /** @type {string} */
  this.API_KEY = 'fdu88j3vtz7rsq9spnmgy7wf';

  /** @type {string} */
  this.API_URL = 'http://api.rottentomatoes.com/api/public/v1.0';

  /**
   * Number of milliseconds until a cached value is regarded as too old.
   * @const
   * @type {number}
   */
  this.CACHE_EXPIRES = 604800000; // 7 days

  /** @type {Object.<string, (string|Array.<string>)}} */
  this.movieCache = 'movieCache' in localStorage ?
      JSON.parse(localStorage.movieCache) : {};

  // Precache a few common countries.
  this.get('de');
  this.get('us');
};


/**
 * Checks if we have a recently cached movie list for the given country.
 * @param {string} country The country identifier.
 * @return {boolean} Whether we have a cached movie list.
 * @private
 */
MovieList.prototype.isCached_ = function(country) {
  return country in this.movieCache &&
      this.movieCache[country].fetched > (Date.now() - this.CACHE_EXPIRES);
};


/**
 * Handler for the RottenTomatoes API call. Stores the fetched list in cache
 * and returns it to the original caller.
 * @param {string} country A country identifier.
 * @param {function(Array.<string>)} callback A callback which will receive a
 *    list of movie titles that are currently playing in the given country.
 * @param {Object} data The response data.
 */
MovieList.prototype.onMovieList = function(country, callback, data) {
  var movies = [];
  for (var i in data.movies) {
    movies.push(data.movies[i].title);
  }

  if (movies.length === 0) {
    movies.push('Error: could not find any movies for this country.');
  }

  this.movieCache[country] = {
    'fetched': Date.now(),
    'list': movies
  };
  localStorage['movieCache'] = JSON.stringify(this.movieCache);
  if (!!callback) {
    callback(movies);
  }
};


/**
 * Gets a movie list for the given country. Also stores the list to the local
 * cache.
 * @param {string} country A country identifier.
 * @param {function(Array.<string>)} callback A callback which will receive a
 *    list of movie titles that are currently playing in the given country.
 */
MovieList.prototype.get = function(country, callback) {
  if (this.isCached_(country)) {
    if (!!callback) {
      callback(this.movieCache[country].list);
    }
  } else {
    // Register a JSONP callback in the global namespace
    window.__movieListJsonp = this.onMovieList.bind(this, country, callback);

    // Fetch via RottenTomatoes API
    var xhr = $.ajax({
      url: this.API_URL + '/lists/movies/in_theaters.json',
      data: {
        page_limit: 40,
        page: 1,
        country: country,
        apikey: this.API_KEY
      },
      dataType: 'jsonp',
      jsonpCallback: '__movieListJsonp'
    });
  }
};
