<?php //parse the form IF the user submitted it
if( $_POST['did_login'] == true ){
	//extract the user-submitted values. hold onto them with variables
	$input_username = clean_input($_POST['username']);
	$input_password = clean_input($_POST['password']);

	//hashed version of the password for DB lookup
	$hashed_password = sha1($input_password);

	//validate - check for correct minimum length
	if( strlen($input_username) >= 5 AND strlen($input_password) >= 5 ){

		//check to see if this user exists in the DB
		$query = "SELECT user_id
					FROM users
					WHERE username = '$input_username'
					AND password = '$hashed_password'
					LIMIT 1";
		$result = $db->query($query);

		//if one row is found, log them in!
		if( $result->num_rows == 1 ){
			//log them in for one week
			setcookie( 'logged_in', true, time() + 60 * 60 * 24 * 7 );
			//in case cookies are disabled, log them in for the duration of the session
			$_SESSION['logged_in'] = true;

			//who logged in?
			$row = $result->fetch_assoc();
			$logged_in_user_id = $row['user_id'];

			setcookie('user_id', $logged_in_user_id, time() + 60 * 60 * 24 * 7);
			$_SESSION['user_id'] = $logged_in_user_id;

			//redirect the user to admin panel
			// header('Location:index.php');

		} //end if credentials match
		else{
			//no match! show the user an error message
			$error = true;
			$message = 'Username and password combination is incorrect, try again';
		}
	} // end if valid length
	else{ 
		//too short - show generic error message		
		$error = true;
		$message = 'Username and password combination is incorrect, try again';
	}
} //end if did_login

//logout
if($_GET['action'] == 'logout'){
	//end the session
	session_destroy();
	//manually delete session var
	unset($_SESSION['logged_in']);
	//set all cookies to null (blank)
	setcookie('logged_in', '');

	unset($_SESSION['user_id']);
	setcookie('user_id', '');
}

//check to see if the user has an unexpired cookie, if so, log them in automatically and send them to their profile
elseif( $_COOKIE['logged_in'] == true ){
	//re-create the session var
	$_SESSION['logged_in'] = true;
	//send to profile
	// header('Location:index.php');
} ?>