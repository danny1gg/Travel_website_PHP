<?php
	$servername = "localhost";
	$username = "root";
	$password = ""; // SET YOUR DATABASE PASSWORD HERE
	$dbname = "db_travel";

	try {
		$con = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8mb4", $username, $password);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Could not connect to database " . $e->getMessage();
	}
?>