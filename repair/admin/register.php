<?php 
session_start();
require('../includes/config.php');
include_once('../includes/functions.php');

//parse the form IF the user submitted the form
if( $_POST['did_register'] ){
	//clean the data
	$username = clean_input($_POST['username']);
	$email = clean_input($_POST['email']);
	$password = clean_input($_POST['password']);
	$policy = clean_input($_POST['policy']);

	//hashed version of the password
	$hashed_password = sha1($password);

	//validate the data
	$valid = true;

	//username too short
	if( strlen( $username ) < 4 ){
		$valid = false;
		$errors['username'] = 'Username must be at least 4 characters long';
	}else{
		//if username passed the length check, check to see if the username is already taken in the DB
		$query_username = "SELECT username FROM users 
							WHERE username = '$username'
							LIMIT 1";
		$result_username = $db->query($query_username);
		//if one row is found, the name is already taken
		if( $result_username->num_rows >= 1 ){
			$valid = false;
			$errors['username'] = 'That username is already taken. Choose another.';
		}
	} //end username check

	//invalid email address
	if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address, like bob@mail.com';
	}else{
		//if the email is the right format, then check to see if it's already taken
		$query_email = "SELECT email FROM users
						WHERE email = '$email'
						LIMIT 1";
		$result_email = $db->query($query_email);
		//if one row is found, this email is already taken
		if( $result_email->num_rows >= 1 ){
			$valid = false;
			$errors['email'] = 'Your email address is already taken. Do you want to login?';
		}
	} //end email check

	//password too short
	if( strlen($password) < 5 ){
		$valid = false;
		$errors['password'] = 'Your password must be at least 5 characters long.';
	}

	//forgot to check the policy box
	if( $policy != 1 ){
		$valid = false;
		$errors['policy'] = 'You must agree to the Terms of Service and Privacy Policy.';
	}

	//add the user to the DB if it's valid
	if( $valid ){
		$query_adduser = "INSERT INTO users
						(username, password, email, is_admin)
						VALUES
						('$username', '$hashed_password', '$email', 0)";
		$result_adduser = $db->query( $query_adduser );
		//check to see that the user was added successfully
		if( $db->affected_rows == 1 ){
			//log the user in and forward them to the admin panel
			$_SESSION['logged_in'] = true;
			setcookie( 'logged_in', true, time() + 60 * 60 * 24 * 7 );

			//grab their new user_id
			$logged_in_user_id = $db->insert_id;

			$_SESSION['user_id'] = $logged_in_user_id;
			setcookie('user_id', $logged_in_user_id, time() + 60 * 60 * 24 * 7 );

			//redirect to admin dashboard
			header('Location:index.php');
		}//end if user added to DB
		else{
			$errors['db'] = 'Something went wrong during account creation. Sorry?';
		}

	}//end if valid

}//end parse! ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign up for an account!</title>
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">
	

</head>
<body class="register-form">
	<h1>Sign up for an account</h1>

	<?php //show errors if any exist
	if(isset($errors)){
		echo '<ul class="error message">';
		foreach( $errors as $message ){
			echo "<li>$message</li>";
		}
		echo '</ul>';
	}
	 ?>
	<form action="#" method="post">
		<label for="username">Create Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>">
		<span class="hint">Choose a unique name that is at least 5 characters long</span>

		<label for="email">Email Address:</label>
		<input type="email" name="email" id="email" value="<?php echo $email; ?>">

		<label for="password">Create a Password</label>
		<input type="password" name="password" id="password" value="<?php echo $password; ?>">
		<span class="hint">Choose a unique password that is at least 5 characters long</span>


		<label>
		<input type="checkbox" name="policy" value="1" id="policy" <?php checked($policy, 1); ?>>
		I agree to the <a href="#" target="_blank">Terms of Service and Privacy Policy</a>
		</label>

		<input type="submit" value="Sign Up!">
		<input type="hidden" name="did_register" value="1"> 

	</form>
	<a href="login.php">Already have an account? Log in!</a>
	<br>
	<a href="../">&larr; Back to Blog</a>
</body>
</html>