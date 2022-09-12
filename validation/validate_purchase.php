<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
		header('location: index.php');
	} else {
		/* ======= Get and filter input values ==========*/
		$hotelName = filter_var(htmlspecialchars($_GET['hotel_name']), FILTER_SANITIZE_STRING);
		$country = filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING);
		$capital = filter_var(htmlspecialchars($_GET['capital']), FILTER_SANITIZE_STRING);
		$checkIn = filter_var(htmlspecialchars($_GET['check_in']), FILTER_SANITIZE_STRING);
		$checkOut = filter_var(htmlspecialchars($_GET['check_out']), FILTER_SANITIZE_STRING);
		$nights = filter_var(htmlspecialchars($_GET['nights']), FILTER_SANITIZE_STRING);
		$nrNights = filter_var(htmlspecialchars($_GET['nr_nights']), FILTER_SANITIZE_STRING);
		$traveler = filter_var(htmlspecialchars($_GET['traveler']), FILTER_SANITIZE_STRING);
		$nrTraveler = filter_var(htmlspecialchars($_GET['nr_traveler']), FILTER_SANITIZE_STRING);
		$dateDeparture = filter_var(htmlspecialchars($_GET['departure_date']), FILTER_SANITIZE_STRING);
		$dateReturn = filter_var(htmlspecialchars($_GET['date_return']), FILTER_SANITIZE_STRING);
		$flightCompany = filter_var(htmlspecialchars($_GET['flight_company']), FILTER_SANITIZE_STRING);
		$hotelPrice = filter_var(htmlspecialchars($_GET['hotel_price']), FILTER_SANITIZE_STRING);
		$flightPrice = filter_var(htmlspecialchars($_GET['flight_price']), FILTER_SANITIZE_STRING);
		$totalPrice = filter_var(htmlspecialchars($_GET['total_price']), FILTER_SANITIZE_STRING); // =========
		if (isset($_SESSION['email'])) {
			loggedInPurchase($hotelName, $country, $capital, $checkIn, $checkOut, $nights, $nrNights, $traveler, 
			$nrTraveler, $dateDeparture, $dateReturn, $flightCompany, $hotelPrice, $flightPrice, $totalPrice);
		} else {
			notLoggedInPurchase();
		}
	}

	function loggedInPurchase($hotelName, $country, $capital, $checkIn, $checkOut, $nights, $nrNights, $traveler, 
		$nrTraveler, $dateDeparture, $dateReturn, $flightCompany, $hotelPrice, $flightPrice, $totalPrice) {
		include("../db/connection.php");
		/* ============ Fetch purchased hotels and flights =================*/
		$sql_check_purchase = "SELECT * FROM purchased_hotels WHERE user_email = :email";
		$fetch_purchase = $con->prepare($sql_check_purchase);
		$fetch_purchase->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
		$fetch_purchase->execute();
		while ($row = $fetch_purchase->fetch(PDO::FETCH_ASSOC)) {
			$db_email = $row['user_email'];
			$db_hotelName = $row['hotel_name'];
			$db_hotelCountry = $row['hotel_capital'];
			$db_hotelCapital = $row['hotel_capital'];
			$db_checkIn = $row['hotel_check_in'];
			$db_checkOut = $row['hotel_check_out'];
			$db_nights = $row['hotel_nights'];
			$db_travelers = $row['hotel_travelers'];
			$db_total_price = $row['total_price'];
		}
		if ($db_email === $_SESSION['email'] && $db_hotelName === $hotelName 
			&& $db_checkIn === $checkIn && $db_checkOut === $checkOut && $db_total_price === $totalPrice) {
			$status = "Error... You already booked this trip!";
			showStatus($status);
		} else { /* =========== Insert informations into database =========*/
			$sql_purchase = "INSERT into purchased_hotels 
			(user_id, user_email, hotel_name, hotel_country, hotel_capital, 
			hotel_check_in, hotel_check_out, hotel_nights, hotel_travelers, hotel_price, flight_company, flight_price, total_price) 
			VALUES (:user_id, :user_email, :hotel_name, :hotel_country, :hotel_capital, :hotel_check_in, 
			:hotel_check_out, :hotel_nights, :hotel_travelers, :hotel_price, :flight_company, :flight_price, :total_price)";
			$purchase = $con->prepare($sql_purchase);
			$purchase->bindParam(':user_id', $hotelName, PDO::PARAM_STR);
			$purchase->bindParam(':user_email', $_SESSION['email'], PDO::PARAM_STR);
			$purchase->bindParam(':hotel_name', $hotelName, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_country', $country, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_capital', $capital, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_check_in', $checkIn, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_check_out', $checkOut, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_nights', $nights, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_travelers', $traveler, PDO::PARAM_STR);
			$purchase->bindParam(':hotel_price', $hotelPrice, PDO::PARAM_INT);
			$purchase->bindParam(':flight_company', $flightCompany, PDO::PARAM_STR);
			$purchase->bindParam(':flight_price', $flightPrice, PDO::PARAM_INT);
			$purchase->bindParam(':total_price', $totalPrice, PDO::PARAM_INT);
			$purchase->execute();
			$status = "<h1 class='blue_text'>Thank you for your purchase!<br></h1>
			<h3>You will recive an email with your travel information.</h3>
			<a href='my_purchases.php'>Got to my purchases</a>";
			showStatus($status);
		}
	}

	function notLoggedInPurchase() {
		$status = "<div class = 'not_loggedin_purchase_container'>
						<h2>
							To purchase this offer, please continue with: <a href='register.php'>Register</a>
							<br>
							or <a href='login.php'><b>Login</b></a><br>
						</h2>
					</div>";
		showStatus($status);
	}

	function showStatus($status) {
		setcookie("purchaseStatus", $status, time() + 60, "/");
		header('location: ../purchase_success.php');
	}
?>