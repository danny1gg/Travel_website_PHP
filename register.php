<?php 
	if(!isset($_SESSION)) {
		session_start();
	}
	if (isset($_SESSION['first_name'])) {
		header('location: index.php');
	}
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
<body>
	<!-- ========= navbar ========= -->
	<?php include('includes/navbar.php');?>
	<div id = "container">
		<br>
		<h1 class='centered_text white_text'>Register</h1>
		<h3 id = "error" class = "centered_text">
			<?php
				if (isset($_COOKIE['registerError'])) {
					echo $_COOKIE['registerError'];
				}
			?>
		</h3>
		<!-- ========= main container ========= -->
		<form id = "form_register" action = "validation/validate_registration.php" method="POST">
			<input type="text" name="fName" placeholder="first name ..."><br>
			<input type="text" name="lName" placeholder="last name ..."><br>
			<input type="text" name="email" placeholder="email ..."><br>
			<input type="text" name="country" placeholder="country ..."><br>
			<input type="password" name="password" placeholder="password ..."><br>
			<input type="password" name="rPassword" placeholder="repeat password ..."><br>
			<select name = "accountType" style = "width: 275px; padding: 5px;">
				<option>Traveler</option>
				<option>Hotel / Company</option>
			</select><br>
			<p class = "white_text">Birthday<p>
			<input type="date" name="bDate" value='1990-01-01'><br>
			<button id = "btn_submit" type="submit">Register</button>
		</form>
	</div>
	<br>
	<br>
	<br>
	<br>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>