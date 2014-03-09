


/**
 * A component for showing search results on a map.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @param {Element} container The element in which to render the results page.
 * @param {google.maps.Map} map The map on which to render results.
 * @param {LocationHelper} locationHelper A LocationHelper instance.
 * @param {google.maps.places.PlacesService} placesService The Places API
 *    library in order to perform detailed queries.
 * @constructor
 */
var ResultsPage = function(container, map, locationHelper, placesService) {
  this.container = container;
  this.map = map;
  this.locationHelper = locationHelper;
  this.placesService = placesService;

  /**
   * Callback for when the user selects a result.
   * @type {?function(
   *    Object.<(name|reference|address|geo|url|phone|country), *>)}
   */
  this.onResultSelected = null;

  /**
   * Callback if the users clicks on the back button.
   * @type {?function(jQuery.Event)}
   */
  this.onBackClick = null;

  /** @type {Handlebars.template} */
  this.template = Handlebars.compile($('#cwResultsPageTemplate').html());

  /** @private @type {Element} */
  this.element_ = document.createElement('div');

  // Add the element to its parent node (hidden)
  $(this.element_).hide();
  this.container.appendChild(this.element_);
};


/**
 * Returns the DOM element of this component.
 * @return {Element} The DOM element.
 */
ResultsPage.prototype.getElement = function() {
  return this.element_;
};


/**
 * Shows a list of search results.
 * @param {Array.<Object.<(name|reference|geo), *>>} results The search results
 *    to display.
 */
ResultsPage.prototype.show = function(results) {
  $(this.element_).html(this.template({
    address: 'TODO',
    results: results
  }));

  $('.cwBtnBack').click(this.onBackClick);
  $('.cwMapContainer').append(this.map.getDiv());
  $('.cwResultList > li').mouseover(this.onMouseOverResult_.bind(this));
  $('.cwResultList > li').click(this.onListItemClick_.bind(this));
  google.maps.event.trigger(this.map, 'resize');

  this.clearMap_();
  this.currentMarkers = this.populateMap_(results);
};


/**
 * Triggered when user hovers a result in the list.
 * @param {jQuery.Event} event The event object.
 * @private
 */
ResultsPage.prototype.onMouseOverResult_ = function(event) {
  // Focus on the corresponding marker
  var reference = $(event.target).attr('data-reference');

  if (!!reference && reference in this.currentMarkers) {
    this.map.panTo(this.currentMarkers[reference].getPosition());
    this.map.setZoom(13);
  }
};


/**
 * Event handler for Maps Marker clicks.
 * @param {string} reference The reference ID of the marker clicked.
 * @private
 */
ResultsPage.prototype.onMarkerClick_ = function(reference) {
  this.onCinemaSelected_(reference);
};


/**
 * Event handler for list item clicks.
 * @param {jQuery.Event} event The event object.
 * @private
 */
ResultsPage.prototype.onListItemClick_ = function(event) {
  this.onCinemaSelected_($(event.target).attr('data-reference'));
};


/**
 * Called when a cinema has been selected either on the map or in the list.
 * Fetches cinema details and calls the external callback handler afterwards.
 * @param {string} reference The reference ID of the selected cinema.
 * @private
 */
ResultsPage.prototype.onCinemaSelected_ = function(reference) {
  this.placesService.getDetails({reference: reference},
      this.onDetails_.bind(this));
};


/**
 * Callback for the Places API details query.
 * @param {google.maps.places.PlaceResult} result The place result.
 * @param {google.maps.places.PlacesServiceStatus} status The query status.
 * @private
 */
ResultsPage.prototype.onDetails_ = function(result, status) {
  if (status !== google.maps.places.PlacesServiceStatus.OK) {
    console.warn('getDetails query failed.');
    return;
  }

  if (!this.onResultSelected) {
    // nobody's interested in the results...
    return;
  }

  this.onResultSelected({
    name: result.name,
    address: result.formatted_address,
    url: result.website ? result.website : result.url,
    geo: result.geometry.location,
    phone: result.formatted_phone_number,
    reference: result.reference,
    country: this.locationHelper.getCountry(result.address_components)
  });
};


/**
 * Removes all markers on the map.
 * @private
 */
ResultsPage.prototype.clearMap_ = function() {
  for (var ref in this.currentMarkers) {
    this.currentMarkers[ref].setMap(null);
  }
};


/**
 * Shows a list of results using a maps view.
 * @param {Array.<Object.<(name|reference|geo), *>>} results The search results
 *    to display.
 * @return {Object.<string, google.maps.Marker>} A list of newly created
 *    markers.
 * @private
 */
ResultsPage.prototype.populateMap_ = function(results) {
  var markers = {};
  var bounds = new google.maps.LatLngBounds();

  for (var i in results) {
    var marker = new google.maps.Marker({
      map: this.map,
      animation: google.maps.Animation.DROP,
      position: results[i].geo,
      title: results[i].name
    });

    bounds.extend(results[i].geo);
    markers[results[i].reference] = marker;
    google.maps.event.addListener(marker, 'click',
        this.onMarkerClick_.bind(this, results[i].reference));
  }

  this.map.fitBounds(bounds);
  return markers;
};
