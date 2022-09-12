<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('location: ../../index.php');
	} else {
		include("../db/connection.php");
		/* ========== filter adnn store input values ============*/
		$firstName = trim(filter_var(htmlspecialchars($_POST['fName']), FILTER_SANITIZE_STRING));
		$lastName = trim(filter_var(htmlspecialchars($_POST['lName']), FILTER_SANITIZE_STRING));
		$email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));
		$country = trim(filter_var(htmlspecialchars($_POST['country']), FILTER_SANITIZE_STRING));
		$password = filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING);
		$repeatPassword = filter_var(htmlspecialchars($_POST['rPassword']), FILTER_SANITIZE_STRING);
		$accountType = trim(filter_var(htmlspecialchars($_POST['accountType']), FILTER_SANITIZE_STRING));
		$birthDate = filter_var(htmlspecialchars($_POST['bDate']), FILTER_SANITIZE_STRING);
		$createdDate = getdate()[0];
		$profilePicture = "imgs/profile_pic_default.png";
		/* ========    Password hash   ======= */
		$pwCost = array('cost' => 12,);
		$pwHash = password_hash($password, PASSWORD_BCRYPT, $pwCost);
		if (validateForm($firstName, $lastName, $email, $country,  $password, $repeatPassword, $birthDate)) {
			/* ========   Check if user exists in database   ======= */
			$sql = "SELECT * FROM users WHERE email = :email";
			$exist_email = $con->prepare($sql);
			$exist_email->bindParam(':email', $email, PDO::PARAM_STR);
			$exist_email->execute();
			if ($exist_email->rowCount() == 1) {
				$err =  "* Email already used!";
				throwError($err);
			} else { /* ======== Insert Registration informations into database =======*/
				$sql_insert = "INSERT INTO users (first_name, last_name, email, country, password, 
					account_type, birth_date, created_date, profile_picture) 
					VALUES (:first_name, :last_name, :email, :country, :pw, :account_type, :birth_date, 
					:created_date, :profile_picture)";
				$query = $con->prepare($sql_insert);
				$query->bindParam(':first_name', $firstName, PDO::PARAM_STR);
				$query->bindParam(':last_name', $lastName, PDO::PARAM_STR);
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':country', $country, PDO::PARAM_STR);
				$query->bindParam(':pw', $pwHash, PDO::PARAM_STR);
				$query->bindParam(':account_type', $accountType, PDO::PARAM_STR);
				$query->bindParam(':birth_date', $birthDate, PDO::PARAM_STR);
				$query->bindParam(':created_date', $createdDate, PDO::PARAM_INT);
				$query->bindParam(':profile_picture', $profilePicture, PDO::PARAM_STR);
				$query->execute();
				$last_id = $con->lastInsertId();
				/* ======== Login after registration =======*/
				loginAfterRegister($last_id, $firstName, $lastName, $email, $country, 
				$accountType, $birthDate, $createdDate, $profilePicture);
			}
		}
	}

	function throwError($err) {
		setcookie("registerError", $err, time() + 3, "/");
		header('location: ../register.php');
	}

	function checkIfEmptyInput($firstName, $lastName, $email, $country, $password, $repeatPassword, $birthDate) {
		if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($country) 
			&& !empty($password) && !empty($repeatPassword) && !empty($birthDate)) {
			return true;
		}
		return false;
	}

	function validateForm($fn, $ln, $email, $country, $pass, $rPass, $bDate) {
		if (!checkIfEmptyInput($fn, $ln, $email, $country, $pass, $rPass, $bDate)) { // check for empty inputs
			$err =  "* Please fill the required fields!";
			throwError($err);
			return false;
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // check if the email is a valid one
			$err = "* Please enter a valid email!";
			throwError($err);
			return false;
		} else if (strlen($pass) < 6 || 30 < strlen($pass)) { // check password length
			$err = "* Please enter a password between 6 and 30 characters!";
			throwError($err);
			return false;
		} else if ($pass !== $rPass) { // check if the password and confimr password are same
			$err = "* Passwords don't match!";
			throwError($err);
			return false;
		} else if (strcmp($bDate, date('Y-m-d')) >= 0) { // check if the birth date is in the past (not future)
			$err = "* Please enter a valid birth date!";
			throwError($err);
			return false;
		}
		return true;
	}
	
	function loginAfterRegister($dbId, $dbFName, $dbLName, $dbEmail, $dbCountry, 
		$dbAccountType, $birthDate, $dbCreatedDate, $dbProfilePicture) {
		$_SESSION['id'] = $dbId;
		$_SESSION['first_name'] = $dbFName;
		$_SESSION['last_name'] = $dbLName;
		$_SESSION['email'] = $dbEmail;
		$_SESSION['country'] = $dbCountry;
		$_SESSION['account_type'] = $dbAccountType;
		$_SESSION['birth_date'] = $birthDate;
		$_SESSION['created_date'] = $dbCreatedDate;
		$_SESSION['profile_picture'] = $dbProfilePicture;
		header('location: ../profile_after_registration.php');
	}
?>