<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	include("db/connection.php");
	$email = $_SESSION['email'];
	$sql_bookings = "SELECT * FROM purchased_hotels WHERE user_email = :email";
	$fetch_purchase = $con->prepare($sql_bookings);
	$fetch_purchase->bindParam(':email', $email, PDO::PARAM_STR);
	$fetch_purchase->execute();
	while ($row = $fetch_purchase->fetch(PDO::FETCH_ASSOC)) {
		$email = $row['user_email'];
		$hotelName = $row['hotel_name'];
		$hotelCountry = $row['hotel_country'];
		$hotelCapital = $row['hotel_capital'];
		$checkIn = $row['hotel_check_in'];
		$checkOut = $row['hotel_check_out'];
		$nights = $row['hotel_nights'];
		$travelers = $row['hotel_travelers'];
		$hotelPrice = $row['hotel_price'];
		$flightCompany = $row['flight_company'];
		$flightPrice = $row['flight_price'];
		$totalPrice = $row['total_price'];
		$purchase = new Purchase();
		$purchase->setInfo($hotelName, $hotelCountry, $hotelCapital, $checkIn, $checkOut, $nights, $travelers, 
		$hotelPrice, $flightCompany, $flightPrice, $totalPrice);
		$purchase->displayPurchase();
	}
	
	class Purchase { // create purchases list
		public $hotelName, $hotelCountry, $hotelCapital, $email, $checkIn, $nights, $travelers, $totalPrice;

		public function setInfo($hotelName, $hotelCountry, $hotelCapital, $checkIn, $checkOut, $nights, $travelers, 
			$hotelPrice, $flightCompany, $flightPrice, $totalPrice) {
			$this->hotelName = $hotelName;
			$this->hotelCountry = $hotelCountry;
			$this->hotelCapital = $hotelCapital;
			$this->checkIn = $checkIn;
			$this->checkOut = $checkOut;
			$this->nights = $nights;
			$this->travelers = $travelers;
			$this->hotelPrice = $hotelPrice;
			$this->flightCompany = $flightCompany;
			$this->flightPrice = $flightPrice;
			$this->totalPrice = $totalPrice;
		}

		public function displayPurchase() {
			echo "<b> $this->hotelName </b><br>";
			echo "$this->hotelCapital ($this->hotelCountry) <br>";
			echo "Check-in: $this->checkIn <br>";
			echo "Check-out:  $this->checkOut <br>";
			echo "$this->nights, $this->travelers <br>";
			echo "<b>$this->flightCompany </b><br>";
			echo "Hotel price: $this->hotelPrice <br>";
			echo "Flight price: $this->flightPrice  € <br><br>";
			echo "<b class = 'blue_text'>Total price: $this->totalPrice  € </b><hr>";
		}
	}
?>