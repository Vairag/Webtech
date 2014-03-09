<?php
class attachment {
	
	public $id;
	public $name;
	public $date;
	public $path;
	public $downloads;
	public $rating;
	public $comment;
	public $commentshort;

	function __construct($row) {
		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->date = date('F d, Y h:mA', strtotime($row['date']));
		$this->path = $row['path'];
		$this->downloads = $row['downloads'];
		$this->rating = $row['rating'];
		
		$this->comment = $row['comment'];
		if (empty($this->comment)) {
			$this->comment = "no description";
		}
		
		if (strlen ($this->comment) > 50) {
			$this->commentshort = substr($this->comment, 0, 90);
			$this->commentshort .= "...";
		} else {
			$this->commentshort = $this->comment;
		}
	}

}

?>