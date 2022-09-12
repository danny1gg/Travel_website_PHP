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
	<title>Purchase status</title>
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
	<div id = 'container_hotel_profile'>
		<div id = "purchase_content" class="centered_text">
			<h3 id = "error" class = "centered_text">
				<?php
					if (isset($_COOKIE['purchaseStatus'])) {
						echo $_COOKIE['purchaseStatus'];
					}
				?>
			</h3>
			
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>