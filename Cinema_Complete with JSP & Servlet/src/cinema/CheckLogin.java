package cinema;

import java.io.IOException;
//import DBConfiguration;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class CheckLogin
 */
@WebServlet("/CheckLogin")
public class CheckLogin extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public CheckLogin() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub

		/*
		 * Get the value of form parameter
		 */
		String emp_name = request.getParameter("usrname");
		String emp_pwd = request.getParameter("pwd");
		String error_msg = "Username or Password is not correct!";
		HttpSession session = request.getSession();

		/*
		 * Set the content type(MIME Type) of the response.
		 */
		DBConfiguration DBC1 = new DBConfiguration();
		DBC1.ConnectDB();
		boolean validuser = DBC1.checkUser(emp_name, emp_pwd);

		if (validuser == true) {
			session.setAttribute("emp_name", emp_name);

			RequestDispatcher view = request.getRequestDispatcher("main.jsp");
			view.forward(request, response);

		} else {
			request.setAttribute("error_msg", error_msg);
			RequestDispatcher view = request
					.getRequestDispatcher("adminlogin.jsp");
			view.forward(request, response);
		}

	}

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		// Delete reservation Get Request comes here from main.jsp
		int r_id = Integer.parseInt(request.getParameter("r_id"));
		DBConfiguration DBC1 = new DBConfiguration();
		DBC1.ConnectDB();
		boolean success = DBC1.deleteReservation(r_id);
		if (success == true) {

			RequestDispatcher view = request.getRequestDispatcher("main.jsp");
			view.forward(request, response);
		}

	}

}
