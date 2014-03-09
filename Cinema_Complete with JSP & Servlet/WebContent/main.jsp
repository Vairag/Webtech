<%@page import="cinema.Reservation"%>
<%@page import="java.sql.*"%>
<%@page import="cinema.DBConfiguration"%>
<html>
<body>

	Welcome, Dear
	<%=request.getSession().getAttribute("emp_name")%>
	<input type="button" id="logout" value="Logout"
		ONCLICK="window.location.href='adminlogin.jsp'" />

	<%
		DBConfiguration DBC1 = new DBConfiguration();
		DBC1.ConnectDB();
		ResultSet rs = DBC1.getAllReservation();

		out.println("<table border='1'>");
		out.println("<tr>");
		out.println("<td> Reservation ID </td>");
		out.println("<td> Name </td>");
		out.println("<td> Mail </td>");
		out.println("<td> Cinema </td>");
		out.println("<td> Movie </td>");
		out.println("<td> Seats </td>");
		out.println("<td> </td>");
		out.println("<td> </td>");
		out.println("</tr>");

		//Extract data from result set
		while (rs.next()) {
			//Retrieve by column name
			Reservation reservation = new Reservation();
			reservation.setId(rs.getInt("reservation_id"));
			reservation.setUsername(rs.getString("user_name"));
			reservation.setUsermail(rs.getString("user_email"));
			reservation.setCinemaName(rs.getString("cinema_name"));
			reservation.setMovieName(rs.getString("movie_name"));
			reservation.setSeats(rs.getString("seats"));

			//Display values
			String tableRow = "<tr>" + "<td > "
					+ reservation.getId()
					+ " </td>"
					+ "<td > "
					+ reservation.getUsername()
					+ " </td>"
					+ "<td > "
					+ reservation.getUsermail()
					+ " </td>"
					+ "<td > "
					+ reservation.getCinemaName()
					+ " </td>"
					+ "<td > "
					+ reservation.getMovieName()
					+ " </td>"
					+ "<td > "
					+ reservation.getSeats()
					+ " </td>"
					+ "<td > <input type='button' id='p_print' value='Print Reservation' ONCLICK='window.location.href=\"printreservation.jsp?r_id="
					+ reservation.getId()
					+ "\"'/></td>"
					+ "<td > <input type='button' id='p_delete' value='Delete Reservation' ONCLICK='window.location.href=\"CheckLogin?r_id="
					+ reservation.getId() + "\"'/></td>" + "</tr>";
			out.println(tableRow);
		}
		out.print("</table>");
	%>

</body>
</html>