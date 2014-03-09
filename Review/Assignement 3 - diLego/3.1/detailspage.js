


/**
 * The component for showin details about a particular cinema.
 * @author kaktus621@gmail.com (Martin Matysiak)
 * @param {Element} container The element in which to render the results page.
 * @param {MovieList} movieList A MovieList instance.
 * @constructor
 */
var DetailsPage = function(container, movieList) {
  this.container = container;
  this.movieList = movieList;

  /**
   * Callback if the users clicks on the back button.
   * @type {?function(jQuery.Event)}
   */
  this.onBackClick = null;

  /**
   * Callback if the users clicks on the OK button.
   * @type {?function(jQuery.Event)}
   */
  this.onBookClick = null;

  /** @type {Handlebars.template} */
  this.template = Handlebars.compile($('#cwDetailsPageTemplate').html());

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
DetailsPage.prototype.getElement = function() {
  return this.element_;
};


/**
 * Shows a list of search results.
 * @param {Array.<Object.<(name|reference|geo|...), *>>} cinema The cinema to
 *    show.
 */
DetailsPage.prototype.show = function(cinema) {
  var movieListCallback = function(movies) {
    cinema.movies = movies;
    this.renderInternal_(cinema);
  }

  this.movieList.get(cinema.country, movieListCallback.bind(this));
};


/**
 * Actually renders the details page.
 * @param {Array.<Object.<(name|reference|geo|...), *>>} cinema The cinema to
 *    show.
 * @private
 */
DetailsPage.prototype.renderInternal_ = function(cinema) {
  $(this.element_).html(this.template(cinema));
  $('.cwBtnBack', this.element_).click(this.onBackClick);
  $('.cwBtnBook', this.element_).click(this.onBookClickInternal_.bind(this));
};


/**
 * Internal handler for the "OK" button. Extracts form data and passes it to
 * the external listener.
 * @private
 */
DetailsPage.prototype.onBookClickInternal_ = function() {
  var formData = $('.cwIdBookForm', this.element_).serializeArray();

  if (!!this.onBookClick) {
    this.onBookClick(formData);
  }
};
