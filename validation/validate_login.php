<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('location: ../../index.php');
	} else {
		$email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));
		$password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
		validateLogin($email, $password);
	}
	
	function validateLogin($email, $pass) {
		if ($email == null || $pass == null) { // check for empty email or password
			$err = "* Email and Password cannot be empty!";
			throwError($err);
			return false;
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // check if email is in corect format
			$err = "* Please enter a valid email!";
			throwError($err);
			return false;
		} else { // login if everithing is fine
			getUserInfo($email, $pass);
		}

	}

	function throwError($err) {
		setcookie("loginError", $err, time() + 3, "/");
		header('location: ../login.php');
	}

	function getUserInfo($email, $pass) {
		include("../db/connection.php");
		/* ========== fetch user info  ========= */
		$sql_login = "SELECT * FROM users WHERE email = :email";
		$check_login = $con->prepare($sql_login);
		$check_login->bindParam(':email', $email, PDO::PARAM_STR);
		$check_login->execute();
		while ($row = $check_login->fetch(PDO::FETCH_ASSOC)) {
			$db_id = $row['id'];
			$db_fName = $row['first_name'];
			$db_lname = $row['last_name'];
			$db_email = $row['email'];
			$db_pass = $row['password'];
			$db_country = $row['country'];
			$db_account_type = $row['account_type'];
			$db_birth_date = $row['birth_date'];
			$db_created_date = $row['created_date'];
			$db_profile_picture = $row['profile_picture'];
		}
		if (password_verify($pass, $db_pass)) { // check if the entered password is correct
			include('sessions.php'); // login if a matching email with the correct password was found
			setLoginSessions($db_id, $db_fName, $db_lname, $db_email, $db_country, 
				$db_account_type, $db_birth_date, $db_created_date, $db_profile_picture);
			header('location: ../profile.php'); 
		} else {
			$err = "* Wrong email or password!";
			throwError($err);
		}
	}
?>