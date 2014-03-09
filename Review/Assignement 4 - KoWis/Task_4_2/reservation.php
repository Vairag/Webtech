<?php

class reservation {

	private $date;
	private $time;
	private $movieName;	
	private $seatNumbers = array();

	
	public function __construct($date,$time,$movieName,$seatNumbers) {

		$this->date = $date;
		$this->time = $time;
		$this->movieName = htmlentities($movieName, ENT_COMPAT, "UTF-8");
		$this->seatNumbers = $seatNumbers;
	}


	public function getDate() {
		
		return $this->date;	
	}


	public function getTime() {
		
		return $this->time;	
	}


	public function getMovieName() {
		
		return $this->movieName;	
	}


	public function getSeatNumbers() {
		
		return $this->seatNumbers;	
	}

}

?>