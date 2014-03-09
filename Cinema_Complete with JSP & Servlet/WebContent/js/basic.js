

$(document).ready(function () {

    setUpAutocomplete();
    setTimePicker();

});


function setTimePicker() {
    $('#datePicker').val(new Date().toJSON().substring(0, 10));
}

function setUpAutocomplete() {
    $("#moviesearch").autocomplete({
        source: getMovies()
    });
}


function getMovies() {

    xml = loadXMLDoc("movies.xml");
    path = 'cinemas/cinema/movies/movie/title'

    var nodes = xml.evaluate(path, xml, null, XPathResult.ANY_TYPE, null);

    var result = nodes.iterateNext();
    var movies = new Array();
    var i = 0;
    while (result) {
        var movie = result.childNodes[0].nodeValue;
        if ($.inArray(movie, movies) < 0) {
            movies[i] = movie;
            i++;
        }
        result = nodes.iterateNext();
    }

    // alert(movies.join('\n'));

    /*	var evaluator = new XPathEvaluator();
   
       //get first div
       var result = evaluator.evaluate("//div", document.documentElement, null,
                        XPathResult.FIRST_ORDERED_NODE_TYPE, null);
       alert("First div ID is " + result.singleNodeValue.id); */
    return movies;
    }


function loadXMLDoc(dname) {
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    }
    else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.open("GET", dname, false);
    xhttp.send("");
    return xhttp.responseXML;
}

function toggle(show, hide) {
    var ele = document.getElementById(show);
    var sec2 = document.getElementById(hide)
    /*
    if (ele.style.display == "block") {
        ele.style.display = "none";
        sec2.style.display = "block";
    }
    else {
        ele.style.display = "block";
        sec2.style.display = "none";
    }
    */
}