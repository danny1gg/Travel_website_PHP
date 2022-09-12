<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	// ======= Hotel variables ====
	$hotelName = $_GET['hotel_name'];
	$country = $_GET['country'];
	$capital = $_GET['capital'];
	$checkIn = $_GET['check_in'];
	$checkOut = $_GET['check_out'];
	$nights = $_GET['nights'];
	$nrNights = $_GET['nr_nights'];
	$nrTraveler = $_GET['nr_traveler'];
	$traveler = $_GET['traveler'];
	$hotelPrice = $_GET['hotel_price'];
	$totalPrice = $_GET['total_price'];
	// ====== Flight variables =====
	$flightCompany = $_GET['flight_company'];
	$dateDeparture = $_GET['departure_date'];
	$dateReturn = $_GET['date_return'];
	$flightPrice = $_GET['flight_price'];
?>
