<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
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
	<title>My purchases</title>
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
	<!-- ========= container ========= -->
	<img src="imgs/travel_cover.jpg" style="width:100%; height: 300px; object-fit: cover;">
	<div id = 'container_hotel_profile' style = "height: fit-content; margin-bottom: 200px;">
		<div id = "payment_content">
			<h1 class="centered_text">My purchases</h1>
			<?php include('validation/fetch_purchases.php');?>
		</div>
		<br>
	</div>
	<br>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>