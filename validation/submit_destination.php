<?php
	include("db/connection.php");
	include"validation/cookies.php";
	if(!isset($_SESSION)) {
		session_start();
	}
	$capital = "";
	$nrTraveler = 1;
	if (isset($_COOKIE['nr_traveler'])) {
		$nrTraveler = $_COOKIE['nr_traveler'];
	}
	$dateDeparture = filter_var(htmlspecialchars($_GET['departure_date']), FILTER_SANITIZE_STRING);
	$dateReturn = filter_var(htmlspecialchars($_GET['return_date']), FILTER_SANITIZE_STRING);
	$country = filter_var(htmlspecialchars($_GET['destination']), FILTER_SANITIZE_STRING);
	$countries_list = file_get_contents('countries/country-by-capital-city.json');
	$countryDecodeJson = json_decode($countries_list, true);
	foreach ($countryDecodeJson as $c) {
		if ($c['country'] == $country) {
			$capital = $c['city'];
			break;
		}
	}
	if (filter_var(htmlspecialchars($_GET['get']), FILTER_SANITIZE_STRING) === 'submit_form') {
		$dateReturn = filter_var(htmlspecialchars($_GET['return_date']), FILTER_SANITIZE_STRING);
		$nrTraveler = filter_var(htmlspecialchars($_GET['nr_traveler']), FILTER_SANITIZE_STRING);
		validateDestinationForm($dateDeparture, $dateReturn, $nrTraveler, $country);
		setCookies($dateDeparture, $dateReturn, $nrTraveler, $country);
	}

	function validateDestinationForm($departure, $return, $nrTraveler, $destination) {
		$today = date('Y-m-d');
		if (empty($departure) || empty($return)||
			empty($nrTraveler)|| empty($destination)) {
			$err =  "* Please fill the required fields!";
			throwError($err);
		} else if ($departure < $today) {
			$err =  "* Select a valid check-in date!";
			setDatesCookies($departure, $return);
			throwError($err);
		} else if ($departure >= $return) {
			$err =  "* Check-out date must be after Check-in";
			setDatesCookies($departure, $return);
			throwError($err);
		} else if (30 < $nrTraveler) {
			$err =  "* Please enter less than 30 travelers!";
			setcookie($nrTraveler, $err, time() + 3, '/');
			throwError($err);
		}
	}

	function throwError($err) {
		setcookie('destinationError', $err, time() + 3, '/');
		header('location: index.php');
	}
?>