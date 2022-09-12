<?php 
	if(!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION['first_name'])) {
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
	<title>Edit Profile info</title>
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
	<!-- ========= main container ========= -->
	<div id = "container_user_profile">
		<br>
		<h1 class='centered_text blue_text'>Edit your profile info</h1>
		<h1>Profile info</h1>
		<form action = 'validation/update_profile_info.php' method = 'POST'>
			<table>
				<h3>
				<?php
					if (isset($_SESSION['id'])) {
						echo "<tr><td>Account type<br><b class = 'red_text'> (Not changeable): </td>
						<td>" . $_SESSION['account_type'] . "<br> </b></td></tr>";
						echo "<tr><td>First name: </td>
							<td> <input type = 'text' name = 'fName' value = '" . $_SESSION['first_name'] . "' placeholder = '" . $_SESSION['first_name'] . "'></td></tr>";
						echo "<tr><td>Last name: </td>
							<td> <input type = 'text' name = 'lName' value = '" . $_SESSION['last_name'] . "' placeholder = '" . $_SESSION['last_name'] . "'></td></tr>";						
						echo "<tr><td>Country: </td>
							<td> <input type = 'text' name = 'country' value = '" . $_SESSION['country'] . "' placeholder = '" . $_SESSION['country'] . "'></td></tr>";
						echo "<tr><td>Birth date: </td>
							<td> <input type = 'date' name = 'bDate' value = '" . $_SESSION['birth_date'] . "'></td></tr>";
						echo "<tr style= 'height: 20px;'><td><b><br><br>Security</b></td><td></td></tr>";
						echo "<tr><td> <a href = ''><img src = 'imgs/ico_edit.png' style = 'width:15px'> " 
								. $_SESSION['email'] . " <a/>
							</td>
							<td></td></tr>";
						echo "<tr><td><a href = ''><img src = 'imgs/ico_edit.png' style = 'width:15px'> Change password <a/></td><td></td></tr>";
						echo "<tr style = 'background: #CEAAA9; height: fit-content'><td>Confirm changes with password:
							</td><td><input type = 'password' name = 'password' placeholder = '* * * * * *'></td></tr>";
					}
				?>
				</h3>
			</table>
			<button type = "submit" id = "btn_edit_info" class="centered_text" style="margin-top: 10px;">Apply</button>
		</form>
		<br>
		<h3 id = "error" class = "centered_text">
			<?php
				if (isset($_COOKIE['registerError'])) {
					echo $_COOKIE['registerError'];
				}
			?>
		</h3>
	</div>
	<br>
	<br>
	<br>
	<br>
	<!-- ========= footer ========= -->
	<?php include('includes/footer.php')?>
</body>
</html>