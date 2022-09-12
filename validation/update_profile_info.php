<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('location: ../../index.php');
	} else {
		include("../db/connection.php");
		$new_first_name = trim(filter_var(htmlspecialchars($_POST['fName']), FILTER_SANITIZE_STRING));
		$new_last_name = trim(filter_var(htmlspecialchars($_POST['lName']), FILTER_SANITIZE_STRING));
		$new_country = trim(filter_var(htmlspecialchars($_POST['country']), FILTER_SANITIZE_STRING));
		$new_birth_date = filter_var(htmlspecialchars($_POST['bDate']), FILTER_SANITIZE_STRING);
		$confirm_edit_password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
		if (validateForm($new_first_name, $new_last_name, $new_country, $new_birth_date, $confirm_edit_password)) {
			/* ========    check if user exists in database   ======= */
			$sql_pass = "SELECT password FROM users WHERE email = :email";
			$sql_get_pass = $con->prepare($sql_pass);
			$sql_get_pass->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
			$sql_get_pass->execute();
			while ($row = $sql_get_pass->fetch(PDO::FETCH_ASSOC)) {
				$db_get_pass = $row['password'];
			}
			if (!password_verify($confirm_edit_password, $db_get_pass)) {
				$err =  "Wrong confirmation password!" . strlen($db_get_pass);
				updateStatus($err);
			} else {
				$sql_update = "UPDATE users SET first_name = :new_first_name, last_name = :new_last_name,
				country = :country, birth_date = :birth_date WHERE email = :email";
				$update_profile = $con->prepare($sql_update);
				$update_profile->bindParam(':new_first_name', $new_first_name, PDO::PARAM_STR);
				$update_profile->bindParam(':new_last_name', $new_last_name, PDO::PARAM_STR);
				$update_profile->bindParam(':country', $new_country, PDO::PARAM_STR);
				$update_profile->bindParam(':birth_date', $new_birth_date, PDO::PARAM_STR);
				$update_profile->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
				$update_profile->execute();
				if ($update_profile->rowCount()) {
					include('sessions.php');
					updateProfileSessions($new_first_name, $new_last_name, $new_country, $new_birth_date);
					$err =  'Profile updated successfully!';
					updateStatus($err);
					header('location: ../profile.php');
				} else {
					$err =  'Something went wrong... No data was modified!';
					updateStatus($err);
				}
			}
		}
	}

	function updateStatus($err) {
		setcookie("registerError", $err, time() + 3, "/");
		header('location: ../profile_edit.php');
	}

	function validateForm($fn, $ln, $country, $bDate, $pass) {
		if (empty($pass)) {
			$err = "* Please confirm with password!";
			updateStatus($err);
			return false;
		}
		return true;
	}
?>