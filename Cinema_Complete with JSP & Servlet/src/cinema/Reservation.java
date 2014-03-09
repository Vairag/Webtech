package cinema;

public class Reservation {

	String cinemaName = "cinema";

	int id = 0;

	String movieName = "movie";

	String seats = "1, 5, 7";

	String usermail = "mail@provider.com";

	String username = "name";

	public String getCinemaName() {
		return cinemaName;
	}

	public int getId() {
		return id;
	}

	public String getMovieName() {
		return movieName;
	}

	public String getSeats() {
//		String seatlist = "";
//		for (int seat: seats) {
//			seatlist = seatlist + seat + ", ";
//		}
//		// seatlist.subSequence(0, seatlist.length() - 2);
//		return seatlist;
		return seats;
	}

	public String getUsermail() {
		return usermail;
	}

	public String getUsername() {
		return username;
	}

	public void setCinemaName(String cinemaName) {
		this.cinemaName = cinemaName;
	}

	public void setId(int id) {
		this.id = id;
	}
	public void setMovieName(String movieName) {
		this.movieName = movieName;
	}
	public void setSeats(String seats) {
		this.seats = seats;
	}
	public void setUsermail(String usermail) {
		this.usermail = usermail;
	}
	public void setUsername(String username) {
		this.username = username;
	}

}
