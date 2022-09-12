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
	<!-- ========= main container ========= -->
	<div id = "container">
		<br>
		<h1 class='centered_text white_text'>Login</h1>
		<h3 id = "error" class = "centered_text">
			<?php
				if (isset($_COOKIE['loginError'])) {
					echo $_COOKIE['loginError'];
				}
			?>
		</h3>
		<form id = "form_register" action = "validation/validate_login.php" method="POST">
			<input type="text" name="email" placeholder="email ..."><br>
			<input type="password" name="password" placeholder="password ..."><br><br>
			<button id = "btn_submit" type="submit">Login</button>
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