<?php 
	if(!isset($_SESSION)) {
		session_start();
	}
	include('validation/cookies.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery-3.4.1.js"></script>
	<title>Visit world capital cities</title>
</head>
<body id = "body_index">
	<!-- ========= navbar ========= -->
	<?php 
		if (!isset($_SESSION['first_name'])) { 
			include('includes/navbar.php');
		} else {
			include('includes/navbar_after_login.php');
		}
	?>
	<!-- ========= main container ========= -->
	<div id = 'main_container'>
		<div id = "container">
			<br>
			<h1 class='centered_text white_text'>Visit world capital cities</h1>
			<div id="destination_content">
				<h3 id = "error" class = "centered_text">
					<?php
						if (isset($_COOKIE['destinationError'])) {
							echo $_COOKIE['destinationError'];
						}
					?>
				</h3>
				<form action="hotels_flights.php" method="GET">
					<table>
						<tr>
							<td><input type="date" name="departure_date" 
								value = '<?php echo $_COOKIE['departure_date']; ?>'class = "form_input"></td>
							<td><input type="date" name="return_date" 
								value = '<?php echo $_COOKIE['return_date']; ?>' class = "form_input"></td>
							<td><input type="number" name="nr_traveler" 
								value = '<?php echo $_COOKIE['nr_traveler']; ?>' class = "form_input" 
								style = "width: 55px; height: 27px;" value = "1", min = "-10" max = "40"></td>
							<td><select name="destination" id="destination">
								<option value = "country" disabled>Select Country</option>
							</select></td>
							<td><button id = "submit_btn" type="submit" name = "get" value = "submit_form">
									<img src="imgs/ico_search.png" height="26px">
								</button>
							</td>
						</tr>
						<tr><td><b class='white_text'>Check-in</b></td>
							<td><b class='white_text'>Check-out</b></td>
							<td><b class='white_text'>Travelers</b></td>
							<td style = "padding-left: 5px;"><b class='white_text'>Destination</b></td>
						</tr>
					</table>
				</form>
			</div>
			<img id = "airplane_animation" src="imgs/ico_plane3.png" width="70px">

		</div>
		<!-- ========= sidebar right ========= -->
		<?php include('includes/sidebar.php')?>
	</div>
	<br>
	<br>
	<br>
	<br>
	<!-- ========= countries dropdown list ========= -->
	<script type="text/javascript">
		let dropdown = $('select');
		const countriesList = 'countries/country-by-capital-city.json';
		$.getJSON(countriesList, function(country) {
			$.each(country, function(key, entry) {
				if (entry.country === '<?php echo $_COOKIE['destination']; ?>') {
					$('select').append($('<option selected></option>').attr('value', entry.country).text(entry.country));
				} else {
					$('select').append($('<option></option>').attr('value', entry.country).text(entry.country));
				}
			})
		});
	</script>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>