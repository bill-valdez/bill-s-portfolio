<?php include "includes/header.php";

if( $_POST['did_send'] == 1 ){
	//extract the data from the inputs and clean it up (sanitize)
	$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	$phone = filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
	$message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING );
	//Validate!
	$valid = true;
	//check to see if the name field is blank
	if( strlen($name) == 0 ){
		$valid = false;
		$errors['name'] = 'Please fill out your name.';
	}
	//check to see if the email address is invalid
	// ! means "NOT"
	if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address like bob@mail.com';
	}
	
	//check to see if the message is blank
	if( strlen($message) == 0 ){
		$valid = false;
		$errors['message'] = 'Please fill in the message.';
	}
	//if at the end of all the validation, the $valid var is still true, SEND THE MAIL!
	if( $valid ){
		//prepare to send the mail. set up all 4 parameters of mail()
		$to = 'service@billstvrepair.com';
		$subject = 'E-mail submission for Bills TV Repair';
		$body = "Sent by: $name \n";
		$body .= "Email: $email \n";
		$body .= "Phone Number: $phone \n";
		$body .= "Reason for contact: $reason \n";
		$body .= "Message: $message";
		$header = "Reply-to: $email \r\n";
		$header .= "Cc: service@billstvrepair.com";
		//send the mail!
		$mail_sent = mail($to, $subject, $body, $header);
		//handle error/success message
		if( $mail_sent == 1 ){
			$feedback = 'Thank you for contacting me. I\'ll get back to you soon.';
			$css_class = 'success';
		}else{
			$feedback = 'There was a problem sending the message. Try again.';
			$css_class = 'error';
		}
	} //end if still valid
} //end of parser

 ?>


<body class="cf">
	
			<img src="images/register.jpg" alt="Register">
			
			<?php //show errors if any exist
	if(isset($errors)){
		echo '<ul class="error message">';
		foreach( $errors as $message ){
			echo "<li>$message</li>";
		}
		echo '</ul>';
	}
	 ?>

	 			 <div id="register">
	 			 		<h2>Register</h2>
					<form  action="#" method="post">
						<label for="username">Create Username:</label>
						<input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
						<span class="hint">Choose a unique name that is at least 5 characters long</span><br>

						<label for="email">Email Address:</label>
						<input type="email" name="email" id="email" value="<?php echo $email; ?>"><br>

						<label for="password">Create a Password</label>
						<input type="password" name="password" id="password" value="<?php echo $password; ?>"><br>
						<span class="hint">Choose a unique password that is at least 5 characters long</span><br>


						<label>
						<input type="checkbox" name="policy" value="1" id="policy" <?php checked($policy, 1); ?>>
						I agree to the <a href="#" target="_blank">Terms of Service and Privacy Policy</a>
						</label><br>

						<input type="submit" value="Sign Up!">
						<input type="hidden" name="did_register" value="1"> 

					</form>
				</div>


	            <div id="sendemail">
		            <h2>Send e-mail to service@billstvrepair.com:</h2>
<?php //if the user sent the form, display some feedback
	if( $_POST['did_send'] == 1 ){
	?>
	<div class="<?php echo $css_class; ?>">
		<?php echo $feedback; ?>
	</div>
	<?php } ?>
						 <!-- Use the novalidate attribute in the form to test the php, then remove it -->
        <form action=""<?php echo $_SERVER['PHP_SELF']?> method="post">
        	<label>Name</label>
        	<input type="text" name="name" id="name" value="<?php echo $name; ?>">
			<?php bv_inline_error($errors,'name'); ?><br>

        	<label>Email</label>
        	<input type="email" name="email" id="email" value="<?php echo $email; ?>">
			<?php bv_inline_error($errors,'email'); ?><br>

        	<label>phone</label>
        	<input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>">
        	<?php bv_inline_error($errors,'phone'); ?><br>

        	<label for="message">Message</label>
        	<textarea name="message" id="message"><?php echo $message; ?></textarea>
        	<?php bv_inline_error($errors,'message'); ?><br>

        	<input type="submit" value="Send Message">
        	<input type="hidden" name="did_send" value="1">
        	
        	
        </form>
				</div>


			<div class="base">
				<ul>
					<li><img src="images/piggybank.jpg" alt="Piggy bank"></li>
					<li><a href="register.php"><img src="images/chat.jpg" alt="Chat"></a></li>
					<li><a href="tvparts.php"><img src="images/tv.jpg" alt="T.V."></a></li>
				</ul>
			</div>
			<div class="logo">
				<ul>
					<li><img src="images/samsung.png" alt="Samsung"></li>
					<li><img src="images/mitsubishi.png" alt="Mitsubishi"></li>
					<li><img src="images/sony.png" alt="Sony"></li>
					<li><img src="images/sharp.png" alt="Sharp"></li>				
					<li><img src="images/pioneer.png" alt="Pioneer"></li>
				</ul>
			</div>
		</main>
		
	</div><!-- end cf -->
<?php include "includes/footer.php"; ?>