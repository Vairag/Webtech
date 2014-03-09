<%@page import="java.sql.*"%>
<%@page import="cinema.DBConfiguration"%>
<html><body>

<%

DBConfiguration DBC1= new DBConfiguration();
DBC1.ConnectDB();

int r_id=Integer.parseInt(request.getParameter("r_id"));
ResultSet rs= DBC1.printReservation(r_id);

String table_to_print="<table id='maintable' border='1'><tr>"+
  " <th>Reservation ID</th> "+
  "	<th>User Name</th> "+
  " <th>User Email</th> "+
  "	<th>Cinema Name</th> "+
  "	<th>Movie Name</th> "+
  "	<th>Seats</th> "+
  "	<th><br> </th> "+
  "	<th><br> </th> </tr>";	
  
  //Extract data from result set
while(rs.next()){
    //Retrieve by column name
    int reservation_id  = rs.getInt("reservation_id");
    String user_name = rs.getString("user_name");
    String user_email = rs.getString("user_email"); 
    String cinema_name = rs.getString("cinema_name");
    String movie_name = rs.getString("movie_name");
    String seats = rs.getString("seats");
    
    //Display values						
	table_to_print="<table> "+
			"<tr> <td>Reservation ID :</td><td > "+reservation_id+" </td> </tr> "+
			
			"<tr> <td>Movie Viewer :</td><td > "+user_name+" </td> </tr> "+
		    
			"<tr>  <td>Contact email ID :</td><td > "+user_email+" </td> </tr> "+
			
			"<tr>  <td>Cinema Name :</td><td > "+cinema_name+" </td> </tr> "+
			
			"<tr>  <td>Movie Name :</td><td > "+movie_name+" </td> </tr> "+
			
			"<tr>  <td>Seat Numbers :</td><td > "+seats+" </td> </tr> "+
			
			"<tr> <td><input type='button' value='Print' ONCLICK='window.print();'/></td><td ><input type='button' value='Back' ONCLICK='window.location.href=\"main.jsp\"'/></td> </tr> "+
			"</table>";	
					
 }


out.print(table_to_print);

%>

</body>
</html>
        