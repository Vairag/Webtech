package cinema;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;



/**
 * Servlet implementation class DoReservation
 */
@WebServlet("/DoReservation")
public class DoReservation extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public DoReservation() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	
	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
		
		String res_name = request.getParameter("res_name");
		String res_mail = request.getParameter("res_mail");
		String cinemaName = request.getParameter("cinemaName");
		String movieName = request.getParameter("movieName");
		String seats = request.getParameter("seats");
		
		System.out.println("in servler"+res_name+res_mail+cinemaName+movieName+seats);
		
		DBConfiguration DBC1= new DBConfiguration();
		DBC1.ConnectDB();
		boolean success=DBC1.insertReservation( res_name, res_mail, cinemaName, movieName, seats);
		
		 if(success==true)
		 {
			 
				RequestDispatcher view = request.getRequestDispatcher("index.htm");
				view.forward(request, response);
			 
		 }

	}

}
