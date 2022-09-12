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
	<title>Profile</title>
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
		<h1 class='centered_text blue_text'>
			Hello <a href = '#'>
			<?php 
				if (isset($_SESSION['id'])) {
					echo $_SESSION['first_name'];
				}
			?>
			<img id = 'profile_pic' src = "<?php echo $_SESSION['profile_picture']; ?>" style = "width: 35px; padding: 2px">
			</a>
		</h1>
		<h1>
			
			Profile info
		</h1>
		<table>
			<h3>
			<?php
				if (isset($_SESSION['id'])) {
					echo "<tr><td>First name: </td><td> <b class = 'blue_text'>" . $_SESSION['first_name'] . "</b></td></tr>";
					echo "<tr><td>Last name: </td><td> <b class = 'blue_text'>" . $_SESSION['last_name'] . "</b></td></tr>";
					echo "<tr><td>Email: </td><td> <b class = 'blue_text'>" . $_SESSION['email'] . "</b></td></tr>";
					echo "<tr><td>Account type: </td><td> <b class = 'blue_text'>" . $_SESSION['account_type'] . "</b></td></tr>";
					echo "<tr><td>Country: </td><td> <b class = 'blue_text'>" . $_SESSION['country'] . "</b></td></tr>";
					echo "<tr><td>Birth date: </td><td> <b class = 'blue_text'>" . $_SESSION['birth_date'] . "</b></td></tr>";
					echo "<tr><td>Registered since: </td><td> <b class = 'blue_text'>" . date('Y-m-d', $_SESSION['created_date']) . "</b></td></tr>";
				}
			?>
			</h3>
		</table>
		<br>
		<a href="profile_edit.php"><div id = "btn_edit_info" class="centered_text" style="margin-top: 10px;">Edit info</div></a>
		<h3 id = "error" class = "centered_text">
			<?php
				if (isset($_COOKIE['registerError'])) {
					echo $_COOKIE['registerError'];
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