<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
		header('location: ../index.php');
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
		include('validation/set_purchase_variables.php');
	?>
	<div id = 'container_hotel_profile'>
		<h1 class="centered_text">Select payment method</h1>
		<div id = "payment_content"><br>
			<div id = 'container_offer'>
					<div id = 'hotel_details' style ='padding-left: 10px'>
						<h3>Hotel details</h3>
						<h3 class = 'green_text'> 
							<? echo $hotelName; ?> <br>
							<? echo "$capital ($country)"; ?> <br>
							Check_in: <? echo $checkIn; ?> <br>
							Check_out: <? echo $checkOut; ?> <br>
							<? echo "$nights, $traveler"; ?>
						<h3>
						<h3 class = blue_text> <? echo $hotelPrice; ?> € hotel p. night</h3>
					</div>
					<div id = 'transportation_details' style ='padding-left: 10px'>
						<h3>Flight details</h3>
						<h3 class = 'green_text'> <? echo $flightCompany; ?> <br>
							<img src = 'imgs/ico_departure.png' style = 'width: 30px'> 
							  ________________ 
							<img src = 'imgs/ico_landing_left.png' style = 'width: 30px'> 
							<br><? echo "$dateDeparture ____ $dateReturn"; ?>
							<br>
						</h3>
						<h3 class = blue_text style = 'line-height: 85px;'>
							<? echo $flightPrice; ?> € flight p. person
						</h3>
					</div>
				</div>
			<br><hr>
			<h2 class = 'blue_text centered_text'> <? echo $totalPrice; ?> € Total </h2><br>
			<div id = "sector_payment">
				<img src="imgs/payment_american_express.png" style="width: 50px; margin-right:10px;">
				<img src="imgs/payment_visa.png" style="width: 50px; margin-right:10px;">
				<img src="imgs/payment_maestro.png" style="width: 50px; margin-right:10px;">
				<img src="imgs/payment_paypal.png" style="width: 50px; margin-right:10px;">
				<div id = "p_right">
					<?php 
						echo "<a href = 'validation/validate_purchase.php?hotel_name=$hotelName
							&country=$country&capital=$capital&check_in=$checkIn&check_out=$checkOut
							&nights=$nights&nr_nights=$nrNights&traveler=$traveler&nr_traveler=$nrTraveler
							&departure_date=$dateDeparture&date_return=$dateReturn&flight_company=$flightCompany
							&hotel_price=$hotelPrice&flight_price=$flightPrice&total_price=$totalPrice
							&total_price=$totalPrice'>";
					?>
					<img src="imgs/ico_buy_now.png" style="width: 150px;"></a>
				</div>
			</div>
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