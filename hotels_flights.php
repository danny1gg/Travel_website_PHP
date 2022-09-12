<?php include('validation/destinations.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery-3.4.1.js"></script>
	<title>Visit world capital cities</title>
</head>
<body>
	<!-- ========= navbar ========= -->
	<?php 
		if (!isset($_SESSION['first_name'])) { 
			include('includes/navbar.php');
		} else {
			include('includes/navbar_after_login.php');
		}
	?>
	<br>
	<img src="imgs/travel_cover.jpg" style="width:100%; height: 300px; object-fit: cover;">
	<?php 
		include('validation/submit_destination.php');
		for ($i = 10; $i <= 100; $i += 10) {
			$destination = new Destination;
			$destination->set_name("$capital $i", "$country", "$capital", 20 + $i - 1, 
				$nrTraveler, $informations[($i / 10) % 5]);
			$destination->displayHotelProfile($dateDeparture, $dateReturn);
		}
		echo "<div id = 'container_hotel_profile' style = 'height: fit-content;'>
		<h2 class = 'centered_text'>No more results ... </h2></div><br><br><br>";
	?>
	<br>
	<br>
	<br>
	<br>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>