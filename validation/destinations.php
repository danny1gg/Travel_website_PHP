<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
		header('location: index.php');
	} else {
		class Destination { // Create destination panels
			public $name, $country, $capital, $price, $nights, $travelers, $details;
			function set_name($name, $country, $capital, $price, $nrTraveler, $details) {
				$this->name = $name;
				$this->country = $country;
				$this->capital = $capital;
				$this->nrTraveler = $nrTraveler;
				$this->price = $price;
				$this->details = $details;
			}

			public function setPlural($nr, $element, $result) {
				$this->$result = $nr . $element;
				if ($nr > 1) {
					$this->$result = $nr. $element . 's';	
				}
			}

			public function displayHotelProfile($dateDeparture, $dateReturn) {
				$nrNights = (strtotime($dateReturn) - strtotime($dateDeparture)) / (86400);
				$this->setPlural($nrNights, ' night', 'nights');
				$this->setPlural($this->nrTraveler, ' guest', 'travelers');
				$flightPrice = $this->price + 115;
				$totalPrice = ($this->price * $nrNights) + ($flightPrice * $this->nrTraveler);
				$hotels = array(' Resort ', ' Star ', ' Palace ', ' ');
				$hotelIndex = $this->price / 10 % 4;
				$hotelName = "Hotel $hotels[$hotelIndex] {$this->name}";
				$flightCompanies = array('Wizzair', 'Ryanair', 'Quatar airlines', 'EvaAir', 'Lufthansa');
				$companieIndex = ($this->price / 10) % 5;
				echo "<div id = 'container_hotel_profile'>
						<h1 class='centered_text blue_text' style = 'background: #A9C9DB;'>
							<img src = 'imgs/ico_hotel.png' style = 'width: 25px'>
							$hotelName
							</h1>
						<div id = 'container_offer'>
							<div id = 'hotel_details' style ='padding-left: 10px'>
								<h3>Hotel details</h3>
								<h3 class='green_text'>
								<img src = 'imgs/ico_location.png' style = 'width: 25px'>
								{$this->capital} ({$this->country}) 
								<br> <img src = 'imgs/ico_traveler.png' style = 'width: 25px'>
								{$this->nights} , {$this->travelers}
								<br><img src = 'imgs/ico_food.png' style = 'width: 25px'>
								Free breakfest</h3>";
								if ($this->price == 29 || $this->price == 49) {
									echo "<h3 id = 'room_detail'>Only 1 room left. Hurry up!</h3>";
								} else if ($this->price >= 79) {
									echo "<h3 id = 'room_detail'>All inclusiv!</h3>";
								} else {
									echo "<h3 id = 'room_detail' style = 'color:#CCD6DB'>.</h3>";
								}
				echo  		"<br><h3 class = 'blue_text' style = 'float:right;'>$this->price € hotel p. night</h3>
							<br><br></div>
							<div id = 'transportation_details' style ='padding-left: 10px'>
								<h3>Transportation details</h3>
								<h3 class='green_text'>
									<img src = 'imgs/ico_departure.png' style = 'width: 30px'> 
									  ________________ 
									<img src = 'imgs/ico_landing_left.png' style = 'width: 30px'> 
									<br>$dateDeparture ____ $dateReturn
									<br>$flightCompanies[$companieIndex]
								</h3>
								<h4 class='green_text'>Book now and get free transfer <br> 
								from and to airport + hotel.</h4>
								<h3 class = 'blue_text' style = 'float:right; padding-top: 10px'> 
									$flightPrice  € flight p. person
								</h3>
							</div>
						</div>
						<img src = 'imgs/ico_travel.png' style = 'width: 100px; margin-left: 20px'>
						<div id = 'hotel_info'><p>{$this->details}</p></div><br>
						<div id = 'sector_bottom'>
							<div id = 'price_sector'>
								<b class = 'blue_text'> {$totalPrice} €</b>
								<b class='t_small green_text'>Total</b>
							</div>
							<div>";
								if ($this->price == 99 || $this->price == 119) { 
									echo "<div id = 'btn_book_disabled'>No rooms left</div>";
								} else { 
									echo "<a href = 'select_payment_method.php?hotel_name=$hotelName&country={$this->country}
										&capital={$this->capital}&check_in=$dateDeparture&check_out=$dateReturn&nights={$this->nights}
										&nr_nights=$nrNights&nr_traveler={$this->nrTraveler}&traveler={$this->travelers}
										&departure_date=$dateDeparture&date_return=$dateReturn
										&flight_company=$flightCompanies[$companieIndex]
										&hotel_price={$this->price}&flight_price=$flightPrice&total_price=$totalPrice'>
											<div id = 'btn_book'>Book now</div>
										</a>";
								}
				echo "		</div>
						</div><br>
					</div>";
			}
		}
		$informations = array("Hotel information: The hotel with the best restaurant in town ...",
		"Hotel information: The hotel is situated close to central station ...",
		"Hotel information: The best service in Town, free parkplace, wifi  ...",
		"Hotel information: The hotel has a large pool, wifi, fridge ...",
		"Hotel information: The hotel is located in downtown, nearby ...");
	}
?>