<!DOCTYPE html>
<?php
error_reporting(E_ALL);
require('reservation.php');

$reservations = array();
$view = 'default';
$id = 0;

$reservations[] = new reservation(date("m.d.y"),date("H:i:s"),'The Godfather',array(72,73,74));
$reservations[] = new reservation(date("m.d.y"),date("H:i:s"),'StarWars IV',array(15,16));
$reservations[] = new reservation(date("m.d.y"),date("H:i:s"),'Transformers 2',array(3,4,5,6));
$reservations[] = new reservation(date("m.d.y"),date("H:i:s"),'Skyfall',array(6));
$reservations[] = new reservation(date("m.d.y"),date("H:i:s"),'Hangover',array(34,35,36,37,38,39));


if(isset($_POST["reservation-action"])) {

	$id = $_POST["reservation_id"];

	if($id >=0 && $id<count($reservations)) {
		if(!strcmp($_POST["action"],'delete')) {
			unset($reservations[$id]);
			$view = 'deleted';
		}
		else {
			$view = 'details';	
		}
	}
	else {
		$view = 'notfound';	
	}
}


?>

<html>

	<head>
		<meta charset="utf-8" />
		<title>CinemaPortal - Worker-Dashboard</title>
		<meta name="author" content="DeltaOne" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>

		<div id="layer">
			
			<header>
				CinemaPortal
			</header>

			<section>
				<h1>Ticketing</h1>
		
				<?php
					switch($view) {
						case 'details':
							echo '<table>';
							echo '<tr>';
							echo '<td>Reservation-ID:</td>';
							echo '<td>' , $id , '</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>Date::</td>';
							echo '<td>' , $reservations[$id]->getDate() , '</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>Time::</td>';
							echo '<td>' , $reservations[$id]->getTime() , '</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>Movie:</td>';
							echo '<td>' , $reservations[$id]->getMovieName() , '</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>Seats:</td>';
							echo '<td>';
							foreach($reservations[$id]->getSeatNumbers() as $seatNumber) {
								echo $seatNumber, ' ';
							}							
							echo '<td>';
							echo '</tr>';
							echo '</table>';
							echo '<p><a href="index.php">back</a></p>';	
							break;
						case 'deleted':
							echo 'Reservation with ID ' , $id, ' was deleted.<br/>';
							echo '<p><a href="index.php">back</a></p>';	
							break;
						case 'notfound':
							echo 'Reservation with ID ' , $id, ' not found.<br/>';
							echo '<p><a href="index.php">back</a></p>';
							break;	
						default:
							echo '<form action="index.php" method="post">';
							echo '<p>Please enter reservation-ID:<br/>';
							echo '<input type="number" name="reservation_id" min="0" max="10" /></p>';
							echo '<p>Please choose action:<br/>';
							echo '<select name="action">';
							echo '<option value="view">View Reservation</option>';				
							echo '<option value="delete">Delete Reservation</option>';	
							echo '</select></p>';				
							echo '<p><input type="submit" name="reservation-action" value="OK" /></p>';				
							echo '</form>';	
							break;						
					}					
				?>		

			</section>

			<footer>
				<ul>
					<li><a href="">Impressum</a></li>
					<li>CinemaPortal/WorkerDashboard - Ver.1.0</li>
				</ul>
			</footer>
			
		</div>




	</body>

</html>

<?php

?>	