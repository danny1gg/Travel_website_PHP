<?php 
	if(!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION['first_name'])) {
		header('location: navbar.php');
	}
?>
<div id = "nav" class="navbar">
	<div id = "logo">
		<a href = "index.php"><img id = "airplane_logo" src="imgs/ico_plane4.png" width="35px"></a>
	</div>
	<ul id = "nav_ul">
		<a href = 'profile.php'><li>
			<img id = 'profile_pic' src = "<?php echo $_SESSION['profile_picture']; ?>" style = "width: 30px; padding: 5px"></li>
		</a>
		<a href = 'my_purchases.php'><li>
			<img id = 'purchases' src = "imgs/ico_shopping_cart2.png" style = "width: 35px; padding: 2px;"></li>
		</a>
		<a href = 'logout.php'>
			<li id = "logout_btn" style = "padding: 10px;">Logout</li>
		</a>
	</ul>
</div>