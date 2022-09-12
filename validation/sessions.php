<?php
	function setLoginSessions($db_id, $db_f_Name, $db_l_name, $db_email, $db_country, 
		$db_account_type, $db_birth_date, $db_created_date, $db_profile_picture) {
		$_SESSION['id'] = $db_id;
		$_SESSION['first_name'] = $db_f_Name;
		$_SESSION['last_name'] = $db_l_name;
		$_SESSION['email'] = $db_email;
		$_SESSION['country'] = $db_country;
		$_SESSION['account_type'] = $db_account_type;
		$_SESSION['birth_date'] = $db_birth_date;
		$_SESSION['created_date'] = $db_created_date;
		$_SESSION['profile_picture'] = $db_profile_picture;
	}

	function updateProfileSessions($db_f_Name, $db_l_name, $db_country, $db_birth_date) {
		$_SESSION['first_name'] = $db_f_Name;
		$_SESSION['last_name'] = $db_l_name;
		$_SESSION['country'] = $db_country;
		$_SESSION['birth_date'] = $db_birth_date;
	}
?>