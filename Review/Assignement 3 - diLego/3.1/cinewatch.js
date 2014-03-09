


/**
 * Our main class, bringing all the parts together.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @constructor
 */
var CineWatch = function() {
  /** @type {google.maps.Map} */
  this.map = new google.maps.Map(document.createElement('div'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: new google.maps.LatLng(0, 0),
    zoom: 15
  });

  /** @type {google.maps.places.PlacesService} */
  this.placesService = new google.maps.places.PlacesService(this.map);

  /** @type {google.maps.Geocoder} */
  this.geocoder = new google.maps.Geocoder();

  /** @type {MovieList} */
  this.movieList = new MovieList();

  /** @type {LocationHelper} */
  this.locationHelper = new LocationHelper(this.geocoder);

  /** @type {CinemaSearch} */
  this.cinemaSearch = new CinemaSearch(this.locationHelper, this.placesService);

  /** @type {ResultsPage} */
  this.resultsPage = null;

  /** @type {DetailsPage} */
  this.detailsPage = null;

  this.initializeBootstrap_();
  this.attachHandlers_();
};


/**
 * Initializes bootstrap related addons like tooltips etc.
 * @private
 */
CineWatch.prototype.initializeBootstrap_ = function() {
  $('.cwTooltip').tooltip();
};


/**
 * Binds UI elements to event handlers.
 * @private
 */
CineWatch.prototype.attachHandlers_ = function() {
  $('.cwBtnGeolocate').click(this.onGeolocate.bind(this));
  $('.cwIdInputLocation').keypress(this.onLocationKeyPress.bind(this));
  $('.cwBtnFind').click(this.onSearchLocation.bind(this));
  // Prevent all current and future forms from being submitted (all forms will
  // be handled dynamically by this script).
  $('body').on('submit', 'form', function() { return false; });
};


/**
 * Hides the landing page and shows a result page, if not already done.
 * @private
 */
CineWatch.prototype.loadResultsPage_ = function() {
  if (this.resultsPage === null) {
    this.resultsPage = new ResultsPage($('.cwIdContent')[0], this.map,
        this.locationHelper, this.placesService);
    this.resultsPage.onResultSelected = this.onCinemaSelected.bind(this);
    this.resultsPage.onBackClick = this.loadLandingPage_.bind(this);
  }

  $('.cwIdContent > *').fadeOut();
  $(this.resultsPage.getElement()).fadeIn();
};


/**
 * Switches to the details page as our current view.
 * @private
 */
CineWatch.prototype.loadDetailsPage_ = function() {
  if (this.detailsPage === null) {
    this.detailsPage = new DetailsPage($('.cwIdContent')[0], this.movieList);
    this.detailsPage.onBackClick = this.loadResultsPage_.bind(this);
    this.detailsPage.onBookClick = this.onBookMovie.bind(this);
  }

  $('.cwIdContent > *').fadeOut();
  $(this.detailsPage.getElement()).fadeIn();
};


/**
 * Shows the landing page, if not already done.
 * @private
 */
CineWatch.prototype.loadLandingPage_ = function() {
  $('.cwIdContent > *').fadeOut();
  $('.cwIdLandingPage').fadeIn();
};


/**
 * Shows a list of cinemas.
 * @param {Array.<Object.<(name|reference|geo), *>>} results The found
 *    cinemas.
 * @private
 */
CineWatch.prototype.displayResults_ = function(results) {
  this.loadResultsPage_();
  this.resultsPage.show(results);
};


/**
 * Handler for the Geolocation button. Used to get the user's location using
 * the HTML5 Geolocation API.
 */
CineWatch.prototype.onGeolocate = function() {
  this.locationHelper.getClientLocation(
      this.onClientLocationReceived.bind(this));
};


/**
 * Handler for when the user wants to book a movie ticket.
 * @param {Object} formData The form data which the user has entered.
 */
CineWatch.prototype.onBookMovie = function(formData) {
  console.log('Now would be the time where we send some data to the server ' +
      'in order to process it. But that\'s not part of this assignment. ' +
      'So instead, here\'s the form data:');
  console.dir(formData);
  alert('YOU DID IT! Check your console for details.');
};


/**
 * Handler for when the user selects a cinema at which he wants to book a
 * ticket.
 * @param {Object.<(name|reference|address|geo|url|phone|country), *>} cinema
 *    The selected cinema.
 */
CineWatch.prototype.onCinemaSelected = function(cinema) {
  this.loadDetailsPage_();
  this.detailsPage.show(cinema);
};


/**
 * Callback for when the Geolocation API has a result.
 * @param {Object.<(address|geo), *>} location The client's current
 *    location or null if it couldn't be retrieved.
 */
CineWatch.prototype.onClientLocationReceived = function(location) {
  if (location !== null) {
    $('.cwIdInputLocation')[0].value = location.geo;
    this.cinemaSearch.search(location, this.displayResults_.bind(this));
  }
};


/**
 * Handler for the main input field. May suggest locations and executes a search
 * if enter has been pressed.
 * @param {jQuery.Event} event The event object.
 */
CineWatch.prototype.onLocationKeyPress = function(event) {
  if (event.which === 13) { // 13 == Enter Key
    this.onSearchLocation();
    return;
  }
};


/**
 * Handler for the 'Find' button. Executes the search.
 */
CineWatch.prototype.onSearchLocation = function() {
  this.cinemaSearch.search({address: $('.cwIdInputLocation')[0].value},
      this.displayResults_.bind(this));
};
