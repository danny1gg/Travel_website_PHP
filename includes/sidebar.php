		<div id = 'sidebar_right'>
			<h2 class="centered_text white_text">Top 5 destinations</h2><br>
			<ol>
				<?php
					$next_week = date('Y-m-') . date('d') + 7;
					$return_date = date('Y-m-') . date('d') + 11;
					$countries = array('Maldives', 'Seychelles', 'United States', 'United Kingdom', 'France');
					for ($i = 0; $i < 5; ++$i) {
						echo "<a href = 'hotels_flights.php?destination=$countries[$i]&departure_date=$next_week&return_date=$return_date&get='>
							<li class = 't_destination'>$countries[$i]</li>
							</a>";
					}
				?>
			</ol>
		</div>