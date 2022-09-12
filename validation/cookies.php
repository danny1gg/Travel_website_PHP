<?php
	if (!isset($_COOKIE['departure_date'])) {
		$_COOKIE['departure_date'] = date('Y-m-d');
	}
	if (!isset($_COOKIE['return_date'])) {
		$_COOKIE['return_date'] = date('Y-m-d');
	}
	if (!isset($_COOKIE['nr_traveler'])) {
		$_COOKIE['nr_traveler'] = 1;
	}
	if (!isset($_COOKIE['destination'])) {
		$_COOKIE['destination'] = 'Romania';
	}
	
	function setDatesCookies($departure, $return) {
		setcookie('departure_date', $departure);
		setcookie('return_date', $return);
	}

	function setCookies($departure, $return, $nrTraveler, $destination) {
		setcookie('departure_date', $departure);
		setcookie('return_date', $return);
		setcookie('nr_traveler', $nrTraveler);
		setcookie('destination', $destination);
	}	
?>