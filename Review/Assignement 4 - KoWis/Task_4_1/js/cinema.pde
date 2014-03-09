int xDimension;
int exampleSeatsPerRow;
int exampleRows;
int orderQuantity;

boolean[][] seating;
int[][] reservations;

ArrayList<Seat> orders;
ArrayList<Seat> highlighted;

color available;
color booked;
color order;
color highlight;
color ground;

int seatsPerRow;
int rows;
int seatXSpace;  
int seatYSpace;
int margin;
int yDimension;

int xCoordinate;
int yCoordinate;

JavaScript javascript;

void setup() {
  initializeVariables();
  frameRate(60);
  colorMode(RGB);
  background(ground);
  size(xDimension,yDimension);
  smooth();
  strokeCap(PROJECT);
  
  generateCinema();
  generateRandomBookings();
  
}

void draw() {
  colorSeats();
  highlightSeats(mouseX,mouseY);
}

void mousePressed() {
  reservate(mouseX,mouseY);
}

void initializeVariables() {
  xDimension = jsWidth;
  exampleSeatsPerRow = jsSeatsPerRow;
  exampleRows = jsRows;

  seating = new boolean[exampleSeatsPerRow][exampleRows];
  reservations = new int[exampleSeatsPerRow][exampleRows];

  orders = new ArrayList<Seat>();
  highlighted = new ArrayList<Seat>();

  available = color(17,219,0);
  booked = color(220,0,0);
  order = color(255,228,7);
  highlight = color(255,255,190);
  ground = color(#001d7c);

  seatsPerRow = seating.length;
  rows = seating[0].length;
  seatXSpace = int(xDimension / seatsPerRow);  
  seatYSpace = int(seatXSpace * 1.5);
  margin = (xDimension - (seatsPerRow * seatXSpace))/2;
  yDimension = (margin * 2) + (rows + 2)*seatYSpace;

  xCoordinate = 0;
  yCoordinate = 0;
}

void colorSeats() {
  xCoordinate = margin;
  for (int i=0; i<seatsPerRow; i++) {
    yCoordinate = margin;
    for (int j=0; j<rows; j++) {
      if (seating[i][j] == true) {
        drawSingleSeat(xCoordinate,yCoordinate,seatXSpace,reservations[i][j]);
      }
      yCoordinate += seatYSpace;
    }
    xCoordinate += seatXSpace;
  } 
}

int getRowByYCoordinate(int y) {
  int row = int(map(y,margin,height-margin,0,rows+2));
  return row;
} 

int getSeatByXCoordinate(int x) {
  int seat = int(map(x,margin,width-margin,0,seatsPerRow));
  return seat;
}

boolean overFreeSeat(int x, int y) {
  int overSeat = getSeatByXCoordinate(x);
  int overRow = getRowByYCoordinate(y);
  return seatFree(overSeat, overRow);
}

boolean seatFree(int seat, int row) {
  if ((seat >= 0) && (seat < seatsPerRow) && (row >= 0) && (row < rows)) { 
    if ((seating[seat][row] == true) && (reservations[seat][row] != 1)) {
      return true;
    }
    else {
      return false;
    }
  }
  else {
    return false;
  } 
} 

void highlightSeats(int x, int y) {
  if (overFreeSeat(x,y)) {
    int seat = getSeatByXCoordinate(x);
    int row = getRowByYCoordinate(y);
    int marked = 0;
    
    highlighted.clear();
    while (marked < jsOrderQuantity) {
      if (seatFree(seat,row)) {
        drawSingleSeat(margin + seat * seatXSpace, margin + row * seatYSpace, seatXSpace, 3);
        highlighted.add(new Seat(seat,row));
        marked++;
      }
      if (seat < seatsPerRow) {
        seat++;
      }
      else {
        seat = 0;
        if (row < rows) {
          row++;
        }
        else {
          row = 0;
        }
      }
    }  
  }
}

void reservate(int x, int y) {
  if (get(x,y) == highlight) {
    for (Seat aSeat : orders) {
      reservations[aSeat.getSeatNumber()][aSeat.getRowNumber()] = 0;
    }
    orders.clear();
    if(javascript!=null){
      javascript.clearReservations();
	}
    for (Seat aSeat : highlighted) {
      reservations[aSeat.getSeatNumber()][aSeat.getRowNumber()] = 2;
      orders.add(aSeat);
	  if(javascript!=null){
		javascript.addReservation(aSeat.getSeatNumber(),aSeat.getRowNumber());
	  }
	}
	if(javascript!=null){
      javascript.showReservations();
	}
  }
}

void drawSingleSeat(int x, int y, int seatSize, int seatState) {
  switch(seatState) {
  case 0: 
    fill(available);
    break;
  case 1: 
    fill(booked);
    break;
  case 2: 
    fill(order);
    break;
  case 3:
    fill(highlight);
    break;
  }
  pushMatrix();
  translate(x,y);
  rect(2,2,seatSize-4,seatSize-4);
  rect(2,2,seatSize-4,seatSize/4);
  popMatrix();
}

void generateCinema() {
  int xCorridor;
  int yFirstCorridor;
  int ySecondCorridor;
  
  xCorridor = int(rows / 3);
  yFirstCorridor = int(seatsPerRow/6);
  if (seatsPerRow >= 15) {
    ySecondCorridor = seatsPerRow - yFirstCorridor;
  }
  else {
    ySecondCorridor = yFirstCorridor;
  }
  for (int i=0; i<seatsPerRow; i++) {
    for (int j=0; j < rows; j++) {
      if ((i != yFirstCorridor) && (i != ySecondCorridor) && (j != xCorridor)) {
        seating[i][j] = true;
      }
    }
  }
  seating[yFirstCorridor][0] = true;
  seating[ySecondCorridor][0] = true;
  strokeWeight(10);
  line(xDimension/8, yDimension-5, xDimension-(xDimension/8), yDimension-5);
  strokeWeight(1);
}

void generateRandomBookings() {
   int randomState;
   int probability = 0;
   for (int i=0; i<seatsPerRow; i++) {
      for (int j=0; j < rows; j++) {
        randomState = int(random(1,50));
        if ((i > 0) && (i < seatsPerRow-1)) {
          if ((reservations[i+1][j] == 1) || (reservations[i-1][j] == 1)) {
            probability = 35;
          }
          else {
            probability = 5; 
          }
        }
        if ((i>(seatsPerRow/4)) && (i<(seatsPerRow-(seatsPerRow/2)))) {
           probability += 10; 
        }
        if (j>(rows -(rows / 4))) {
           probability -= 10; 
        }
        if (randomState <= probability) {
          if (seating[i][j] == true) {
            reservations[i][j] = 1;
          }
          else {
            reservations[i][j] = 0;
          }
        }
      }
   }
}

interface JavaScript {
    void clearReservations();
    void addReservation(int seat, int row);
    void showReservations();
	int getSeatsPerRow();
	int getRows();
	int getOrderQuantity();
	int getWidth();
}

void bindJavascript(JavaScript js) {
    javascript = js;
}

class Seat {
  int seatNumber;
  int rowNumber;
  
  Seat(int seatNumber, int rowNumber) {
    this.seatNumber = seatNumber;
    this.rowNumber = rowNumber;
  }
  
  public int getSeatNumber() {
    return seatNumber;
  }
  
  public int getRowNumber() {
    return rowNumber;
  } 
}


