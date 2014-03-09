var chosenCinema;
var chosenMovie;
var chosenCinemaLoc;
var tmpSeatCount;

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
	var movies = ["Twilight: Breaking Dawn-Part 2","Rise Of The Guardians",
	"Life Of Pi","Red Dawn","Looper","Hotel Transylvania"];
	var movieIds = [151421, 401531, 709970, 223503, 404787, 912789];
	chosenCinema = cinemaName;
	chosenCinemaLoc = cinemaLocation;
	var html = 
	"<h2>"+cinemaName+"</h2><p><h4>Address: "+cinemaLocation+"</h4></p>"
	+"<p>you can attend the following movies at this place:</p>"
	+"<table id='movietable' cellpadding='5' style='padding:15px'>";
	
	for(var i = 0; i < movies.length; i++){
		html+="<tr>" 
		+"<td><a class='movielist' id='"+movies[i]+"' href=#>"+movies[i]+"</a></td>"
		+"<td><a class='watchtrailer' moviename='"+movies[i]+"' id="+movieIds[i]+">>>WATCH TRAILER<<</a></td>"
		+"</tr>"; 
	}
	html+="</table>";
	
	displayModal(html);
	 
	 $(".movielist").click(function() {
	   chosenMovie = $(this).html();
	   chooseSeats(chosenMovie);
      });
	 $(".watchtrailer").click(function() {
	   chosenMovie = $(this).attr("moviename");
	   chosenTrailerId = $(this).attr("id");
	   showTrailer(chosenTrailerId);
      });
}

function chooseSeats(movie){
	$.modal.close();
	var html =
	"<h4>Please select your seats for the movie: <font color='blue'>"+chosenMovie+"</font></h4>";
	
	html += "<section id='seatselection' style='width: 410px;'>"
    +"<canvas id='b' width='410' background='green' height='50'></canvas>"  
	+"<canvas id='c' width='410' height='300'>"
	+"</canvas>"
	+"<input class='backandforth' type='button' value='<< Back To Movie-List' onclick='startOrder(chosenCinema, chosenCinemaLoc)'/> &nbsp&nbsp"
	+"<input class='backandforth' type='button' value='Continue >>' onclick='finalOrder()'/>"
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
            +'<form id="reservationform" method="post" name="reservation_form" enctype="multipart/form-data" action="">'
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
			+    '<input type="submit" name="res_book" value="Book Seats" onclick="" />'
             
			+'</form>'
			+'</section>';
		
	displayModal(html);
	
	//add seats to the form
	var hiddenInput = document.getElementById("seats");
		hiddenInput.value=SeatsToBeReserved;
	
	//submits the form (like it did before) without reloading the page
	jQuery("#reservationform").bind("submit", function(){
		var email = jQuery("#orderEmail").val();
		var name = jQuery("#orderName").val();
		if (!CheckEmailAndName(email, name)){
			alert("Email or name is either invalid or missing!");
		}else{
			var data = jQuery(this).serialize();
			$.post('doreservation.php', data, function(response){
				shareOrderForm();
			});
			
		}
		return false;
	});
	
	
}


function showTrailer(publishedid){
	$.modal.close();
	var html = "<div align='center'>";
	html+= "<h4><font color='blue'>"+chosenMovie+" (Trailer)</font></h4>";
	html+= "<iframe width='410' height='320' src='http://www.videodetective.com/embed/video/?publishedid="+publishedid+"&options=false&autostart=false&playlist=none&width=400&height=300' frameborder='0' scrolling='no'></iframe>";
	html+="<input class='backandforth' type='button' value='<< Back To Movie-List' onclick='startOrder(chosenCinema, chosenCinemaLoc)'/>&nbsp&nbsp"
	+"<input id='bookthis' class='backandforth' type='button' value='Book This Movie >>'/>";
	html+= "</div>";
	displayModal(html);
	$("#bookthis").click(function(){
		chooseSeats(chosenMovie);
	});
}

function postToFeed(seats, movie, cinema) {
        // calling the API with dynamic values...
		
        var obj = {
          method: 'feed',
          redirect_uri: 'http://webtech.tobiasschuerg.de/',
          link: 'https://developers.facebook.com/docs/reference/dialogs/',
          picture: 'http://fbrell.com/f8.jpg',
          name: 'Bingo !!! Going For '+movie,
          caption: 'At '+cinema+' Cinema, Aachen.',
          description: 'He/She has booked '+seats+' seats for the above movie.'
        };
		
		
        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
}

function shareOrderForm(){
	$.modal.close();
	
	var html = "<h3>You successfully booked " + SeatsToBeReserved.length + " seats"
			+" for the movie <font color='blue'>" +chosenMovie+"</font> in the cinema <font color='blue'>" +chosenCinema+"</font>.</h3>"
			+"<br/><script src='http://connect.facebook.net/en_US/all.js'></script>"
			+"<input type='button' id='fbshare_btn' onclick='postToFeed(tmpSeatCount, chosenMovie, chosenCinema); return false;'/> <INPUT style='float:right;' TYPE='BUTTON' VALUE='Home' ONCLICK=\"window.location.href='index.htm'\">";
	
	displayModal(html);
	for (var i = 0; i < SeatsToBeReserved.length; i++) {
        removeImageInIndex(SeatsToBeReserved[i]);
        ReserveSeatInIndex(SeatsToBeReserved[i]);
    }
	tmpSeatCount = SeatsToBeReserved.length;
    SeatsToBeReserved.length = 0;
    dynamicCounter = 0;
}
