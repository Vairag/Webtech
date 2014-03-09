	var b_canvas = document.getElementById("b");
    var b_context = b_canvas.getContext("2d");
    b_context.fillRect(0, 0, 300.5, 10); // drawing the black line
    b_context.font = "bold 24px sans-serif";
    b_context.fillText("Screen", 112, 43); // writing Screen in bold 24pixels font

    var c_canvas = document.getElementById("c");
    var c_context = c_canvas.getContext("2d");
    c_context.font = "bold 12px sans-serif";
    c_context.fillText("Reserved", 350, 40);
    c_context.fillText("Free", 350, 15); 
    c_context.stroke();  //writing Free And Reserved in their positions
    c_context.font = "bold 20px sans-serif";
    c_context.stroke();

    boxheight=20; //25
    boxwidth=30; //40
    for (var x = 0.5; x <= 300.5; x += boxwidth)  //400.5
    {
        c_context.moveTo(x, 0);
        c_context.lineTo(x, 240.5); //300.5
    }
    for (var y = 0.5; y <= 240.5; y += boxheight) //300.5
    {
        c_context.moveTo(0, y);
        c_context.lineTo(300.5, y); //400.5
    }
    c_context.strokeStyle = "#eee";
    c_context.stroke();             //Constructing the Table 

    for(var i=0;i<12;i++)
    {
        c_context.font = "bold 18px sans-serif";
        var chr = String.fromCharCode(65 + i); 
        c_context.fillText(chr, 310, 17+boxheight*i);
        c_context.stroke();
    }                                           //writing the alphabet of the lines from A to L

    for(var i=0;i<10;i++)
    {
        c_context.font = "bold 18px sans-serif";
        c_context.fillText(i+1, 10+boxwidth*i, 260); //writing the numbers from 1 to 10
        c_context.stroke();
    }

    var reservations=[1,1,1,0,0,0,0,1,1,0,0,0,1,1,0,0,1,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 ];  //1 means reserverd 0 means not reserved .. 

    var star = new Image();
    star.src = "img/star.png";
    HTMLCanvasElement.prototype.relMouseCoords = relMouseCoords;
    c_canvas.addEventListener("click", tableOnClick, false);
    var SeatsToBeReserved= [];
    var star = new Image();
    star.src = "img/star.png";
    var greenCheckMark = new Image();
    greenCheckMark.src = "img/green.png"; 
    var redWrongMark = new Image();
    redWrongMark.src = "img/red.png";
    
    greenCheckMark.onload = function() 
    { //places all reserved seats icons in their correct positions
        for(var i=0;i<reservations.length;i++)
        {
            if(reservations[i]!=1)
            {
                c_context.drawImage(greenCheckMark, (i%10)*boxwidth, (Math.floor(i/10)*boxheight),20,20);	//positioning the images as the reservations array states
            }
        }

        c_context.drawImage(greenCheckMark, 330, 0 ,20,20);	
    }

    redWrongMark.onload = function() 
    {//places all free seats icons in their correct positions
        offset=4;
        for( var i=0;i<reservations.length;i++)
        {
            if(reservations[i]==1)
            {
                c_context.drawImage(redWrongMark, ((i%10)*boxwidth)+offset,(Math.floor(i/10)*boxheight)+offset,15,15);	//positioning the images as the reservations array states
            }
        }

        c_context.drawImage(redWrongMark, 330+offset, 23+offset ,15,15);
    }

	function findPos(obj) {
	    var curLeft = curTop = 0;
	    if (obj.offsetParent) {
	    	do {
	    		curLeft += obj.offsetLeft;
	    		curTop += obj.offsetTop;
	    	} while (obj = obj.offsetParent);
	    }
	    return {x:curLeft, y:curTop};
	}
	
	var thePositions =findPos(c_canvas);
	
     function relMouseCoords(event) {// a function to convert all mouse clicks on the html page to mouse clicks relative to the canvas
		if(detectBrowser()=="Mozilla"||detectBrowser()=="Chrome")
		{
            var totalOffsetX = 0;
            var totalOffsetY = 0;
            var canvasX = 0;
            var canvasY = 0;
			currentElement=this
            do {
                totalOffsetX += currentElement.offsetLeft - currentElement.scrollLeft;
                totalOffsetY += currentElement.offsetTop - currentElement.scrollTop;
            }
            while (currentElement = currentElement.offsetParent)

            canvasX = event.pageX - totalOffsetX;
            canvasY = event.pageY - totalOffsetY;
            return { x: canvasX, y: canvasY }
		}
                 else if(detectBrowser()=="Safari")
                 {
                    var offset = {x: 0, y: 0};
                    el=this;
                    offset.x = el.offsetLeft - el.parentNode.offsetLeft;
                    offset.y = el.offsetTop - el.parentNode.offsetTop;
                    var point = window.webkitConvertPointFromNodeToPage(el, new WebKitPoint(0, 0));
                   
                    canvasX = event.pageX - Math.round(point.x + offset.x);
                    canvasY = event.pageY - Math.round(point.y + offset.y);
                    return {
                        x: canvasX ,
                        y: canvasY+50 //50 is the height of the screen
                            }
                    }
		else
		{
			currentElement=this
			//alert(this.x)
			//alert(this.offsetY)
			//alert(document.body.clientWidth)
			//alert(document.body.clientHeight)
			//alert(window.pageXOffset)
			//alert(window.pageYOffset)
				//alert("currentElement.offsetLeft" + currentElement.offsetLeft)
				//alert("currentElement.offsetTop" + currentElement.offsetTop)
				//alert(currentElement.scrollLeft)
				//alert(currentElement.scrollTop)
				//alert("event.pageY " + event.pageY)
				//alert("event.clientY " + event.clientY)
				//alert("event.pageX " + event.pageX)
				//alert("event.clientX " + event.clientX)
				//alert(document.documentElement.scrollLeft)
				//alert(document.documentElement.scrollTop)
				//alert(document.body.scrollLeft)
				//alert(document.body.scrollTop)
			var canvasXX=0;
			var canvasYY=0;
			if (event.pageX || event.pageY) 
			{ 
			  canvasXX = event.pageX;
			  canvasYY = event.pageY;
			//alert("in")
			}
			else 
			{ 
					//alert("in2")
			  canvasXX = event.clientX + document.body.scrollLeft + document.documentElement.scrollLeft; 
			  canvasYY = event.clientY + document.body.scrollTop + document.documentElement.scrollTop; 
			} 
			
			var currentElement = this;
			canvasXX -= currentElement.offsetLeft;
			canvasYY -= currentElement.offsetTop;
			//alert("toReturnX" + canvasXX)
			//alert("toReturnY" + canvasYY)
			return { x: canvasXX, y: canvasYY }
		}
        }

    function getIndexOfCordinates(x,y)
    { //unchecks a clicked seat if its in the maybe state or returns the corresponding seat that has been pressed(if it is free) or returns -1 when the seat that was pressed is already reserved.
        row = Math.floor(y/boxheight);
        column = Math.floor(x/boxwidth);
		//alert("row"+row)
        indexPressed = (row*10)+column;
        if(SeatsToBeReserved.indexOf(indexPressed)!=-1)
        {
            UnCheckedReservedSeatInIndex(indexPressed);
        }
        else if(reservations[indexPressed]==0) //means it is ok to book this place
        {
            return indexPressed;
        }
        else
        {
            return -1;
        }
    }

    function tableOnClick(e) 
    {//handles Click Event in the main Canvas
		coords =c_canvas.relMouseCoords(e);
        canvasX = coords.x;
        canvasY = coords.y;
        index=getIndexOfCordinates(canvasX,canvasY);
        if(index==-1)
        {
            return;
        }

        drawSymbolOnPressedCell(index);
		if (index != null){
			SeatsToBeReserved.push(index);
		}		
    }

    function drawSymbolOnPressedCell(index)
    {//used to draw the maybe symbol on the seats 
        offsetHorizontal=5;
        offsetVertical=3;
        removeImageInIndex(index);
        c_context.drawImage(star, (index%10)*boxwidth+offsetHorizontal, (Math.floor(index/10)*boxheight)+offsetVertical,17,17);
    }

    function removeImageInIndex(index)
    {//clears the pixels in the given index(i.e. deletes the image)
        x=index%10;
        y=Math.floor(index/10);
        c_context.clearRect(x*boxwidth+1, y*boxheight+1, 20, 18);
    }


		function CheckEmailAndName(email, name)
		{
			
				var validemail =/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
                 
				if((validemail.test(email))&&name.value!="")
				{
					return true;
				}
				else
				{
					return false;
				}
		}

    function ReserveSeatInIndex(index)
    {//used go perminantely reserve a seat with the given index
        offset=4;
        c_context.drawImage(redWrongMark, ((index%10)*boxwidth)+offset,(Math.floor(index/10)*boxheight)+offset,15,15);
        reservations[index]=1;
    }

    function UnCheckedReservedSeatInIndex(index)
    {//used to Uncheck a maybe reserved seat.
       SeatsToBeReserved = SeatsToBeReserved.filter(function(v) { return v == index? false: true;});
		
	   removeImageInIndex(index);
        
       c_context.drawImage(greenCheckMark, (index%10)*boxwidth, (Math.floor(index/10)*boxheight),20,20);
		
		
	}

	function detectBrowser()
	{
	var userAgent = navigator.userAgent.toLowerCase();
	$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
	if($.browser.msie)
	    {
	        return "MSIE";
	    }
	else if($.browser.chrome)
	    {
	        return "Chrome";
	    }
	else if($.browser.safari)
	    {
	        return "Safari";
	    }
	else if($.browser.mozilla)
	    {
	        return "Mozilla";
	    }
	else if($.browser.opera)
	    {
	        return "Opera";
	    }

	return "NotImportant";
	}