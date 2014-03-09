var chosenCinema;
var chosenMovie;
var chosenCinemaLoc;

//convenient modal for displaying arbitrary html/text, without reloading the site
function displayModal(innerHtml){
	$.modal(innerHtml,{onOpen: function (dialog) {
						dialog.overlay.fadeIn(200, function () {
							dialog.container.slideDown(250, function () {
								dialog.data.fadeIn(500);
							});
						});
					},
					 onClose: function() {
						 $.modal.close();
						
					 }
			});
}

function startOrder(cinemaName, cinemaLocation){
	//retrieve movies first
	$.modal.close();
	var movies = ["96 Hours - Taken 2", "Agent Ranjid rettet die Welt", "Hotel Trasilvanien",
	"Madagascar 3: Flucht nach Europa", "Skyfall", "Paranormal Activity 4"];
	chosenCinema = cinemaName;
	chosenCinemaLoc = cinemaLocation;
	var html = 
	"<h2>"+cinemaName+"</h2><p><h4>Address: "+cinemaLocation+"</h4></p>"
	+"<p>you can attend the following movies at this place:</p>"
	+"<ul id='movielist'>";
	for(var movie in movies){
		html+="<li id="+movies[movie]+"><a href=#"+movies[movie]+">"+movies[movie]+"</a></li>"
	}
	html+="</ul>";
	
	displayModal(html);
	 $("#movielist a").click(function() {
       chosenMovie = $(this).html();
	   $.modal.close();
	   chooseSeats(chosenMovie);
      });
}

function chooseSeats(movie){
	var html =
	"<h4>Please selct your seats for the movie: <font color='blue'>"+chosenMovie+"</font></h4>";
	
	html += "<section id='seatselection' style='width: 410px;'>"
    +"<canvas id='b' width='410' background='green' height='50'></canvas>"  
	+"<canvas id='c' width='410' height='300'>"
	+"</canvas>"
	+"<input type='button' value='Go Back' onclick='startOrder(chosenCinema, chosenCinemaLoc)'> &nbsp&nbsp&nbsp"
	+"<input type='button' value='Continue' onclick='finalOrder()'>"
	+"</section>";
	
	displayModal(html);
	jQuery.getScript("js/seatselection.js");
	
}

function finalOrder(){
 if (SeatsToBeReserved.length == 0){
	alert("You have not chosen any seats!");
	return;
 }
 $.modal.close();
 var html =	'<section id="reservation">'
            +'<h3>Complete the Reservation</h3>'
			+'<h4>Please confirm your reservation for the movie <font color="blue">'+chosenMovie+'</font>' 
			+'  at the cinema <font color="blue">'+chosenCinema+'</font> </h4>'
            +'<form method="post" name="reservation_form"  action="DoReservation">'
            +   '<table>'
            +        '<tr>'
            +           '<td>Name:</td>'
            +            '<td>'
            +                '<input id="orderName" type="text" placeholder="Your Name" name="res_name" required="required" /></td>'
            +        '</tr>'
            +        '<tr>'
            +            '<td>Mail:</td>'
            +            '<td>'
            +                '<input id="orderEmail" type="email" placeholder="your.name@mail.com" name="res_mail" required="required" /></td>'
            +        '</tr>'
            +    '</table>'			
			+    '<input type="hidden" id="seats" name="seats"/>' 
            +    '<input type="hidden" name="cinemaName" value = "'+chosenCinema+'"/>'
			+    '<input type="hidden" name="movieName" value = "'+chosenMovie+'"/><br />'
			+    '<input type="submit" name="res_book" value="Book Seats" onclick="bookSeats()" />'
             
			+'</form>'
			+'</section>';
		
	displayModal(html);
}

//function that checks, if Email is valid. (use: email.isEmail())
String.prototype.isEmail = function () {
  var validmailregex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.([a-z][a-z]+)|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
  return validmailregex.test(this);
}    