package cinema;

//STEP 1. Import required packages
import java.sql.*;

public class DBConfiguration {
	// JDBC driver name and database URL
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	static final String DB_URL = "jdbc:mysql://localhost/cinema"; // Format-
																	// jdbc:mysql://server_host/database_name

	// Database credentials
	static final String USER = "root";
	static final String PASS = "";

	Connection conn = null;
	Statement stmt = null;
	ResultSet rs = null;

	public void ConnectDB() {

		try {

			// STEP 2: Register JDBC driver

			Class.forName("com.mysql.jdbc.Driver");

			// STEP 3: Open a connection

			conn = DriverManager.getConnection(DB_URL, USER, PASS);

		} catch (ClassNotFoundException ex) {
			System.out.println("CNF-EX: " + ex.getMessage());

		} catch (SQLException ex) {
			// handle any errors
			System.out.println("SQLException: " + ex.getMessage());
			System.out.println("SQLState: " + ex.getSQLState());
			System.out.println("VendorError: " + ex.getErrorCode());
		}
	}

	public boolean insertReservation(String res_name, String res_mail,
			String cinemaName, String movieName, String seats) {
		boolean success = false;

		try {

			// STEP 4: Execute a query

			stmt = conn.createStatement();
			String sql = "INSERT INTO reservation (`user_name` ,`user_email` ,`cinema_name` ,`movie_name` ,`seats`) VALUES ('"
					+ res_name
					+ "', '"
					+ res_mail
					+ "', '"
					+ cinemaName
					+ "', '" + movieName + "', '" + seats + "')";
			System.out.println(sql);
			stmt.executeUpdate(sql);

			success = true;

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return success;
	}

	public boolean checkUser(String emp_name, String emp_pwd) {
		boolean validuser = false;
		if (conn != null) {
			
			try {				
				// STEP 4: Execute a query
				stmt = conn.createStatement();
				String sql = "SELECT * FROM box_office_employees WHERE `box_office_employees_id`='"
						+ emp_name
						+ "' and `box_office_employees_pwd`='"
						+ emp_pwd + "'";

				rs = stmt.executeQuery(sql);

				if (rs.next()) {
					validuser = true;
				} else {
					validuser = false;
				}

			} catch (Exception e) {
				e.printStackTrace();
				validuser = false;
			}
			
		} else {
			validuser = false;
		}

		return validuser;
	}

	public ResultSet getAllReservation() {
		try {

			// STEP 4: Execute a query

			stmt = conn.createStatement();
			String sql = "SELECT * FROM reservation ORDER BY reservation_id ASC";
			rs = stmt.executeQuery(sql);

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return rs;

	}

	public ResultSet printReservation(int reservation_id) {
		try {

			// STEP 4: Execute a query

			stmt = conn.createStatement();
			String sql = "SELECT * FROM reservation where reservation_id="
					+ reservation_id;
			rs = stmt.executeQuery(sql);

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return rs;

	}

	public boolean deleteReservation(int reservation_id) {
		boolean success = false;
		try {

			// STEP 4: Execute a query

			stmt = conn.createStatement();
			String sql = "delete from reservation where reservation_id="
					+ reservation_id;

			stmt.executeUpdate(sql);

			success = true;

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return success;

	}

	public void CloseDB() {

		try {
			// STEP 6: Clean-up environment
			rs.close();
			stmt.close();
			conn.close();

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}// end of Class