<?php
//where we are ... 
//for mailing: change this to your email address when you put this on a live server.
$admin_email = 'aestech1@yahoo.com';

//change to error_reporting(E_ALL) if you need to debug notices
error_reporting(E_ALL ^ E_NOTICE);

/**
* Helper Functions
*/

//display errors for form fields
function display_error_or_success($errors, $mail_sent){
	//if there are errors
	if(!empty($errors) OR !$mail_sent){
		echo '<section class="error form-message"> <h1>Your Message Could Not Be Sent</h1>';
		//show each error message with a break tag
		foreach($errors as $error){
			echo $error;
			echo '<br />';
		}
		echo '</section>';
	}elseif(1==$mail_sent){
		echo '<section class="success form-message">
				<h1>Thank you for contacting us!</h1>
				<p>We\'ll get back to you shortly.</p>
				</section>';
	}
}

if(1 ==$_POST['did_submit']):
//conditions go inside here
	//cant trust users, clean up data.	
	 $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
	  $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
	 $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	  $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	 if(is_array($_POST['city'])){
	 $city = filter_var_array($_POST['city'],FILTER_SANITIZE_STRING);
		}

//begin validation
	 $valid = true;

//checks to see if a name was entered
	 if(0 == strlen($fname)){
	 	$valid = false;
	 	$errors['fname'] = 'Please fill out your first name.';
	 }
	  if(0 == strlen($lname)){
	 	$valid = false;
	 	$errors['lname'] = 'Please fill out your last name.';
	 }
//check for invalid email format
	 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	 	$valid = false;
	 	$errors['email'] = 'Please provide a valid email address.';
	 }
	 


//get the data from the services array if it has data
	 if(empty($city)){
	$valid=false;
	$errors['city'] = 'Please choose a city.';
	 }else{
	 	$N = count($city);
	 	$fcity .= "They selected $N ";
	 	for($i=0; $i < $N; $i++){
	 		$fcity .=($city[$i]." ");
	 	}
	 }

//only send the mail if valid is still true
	if(true == $valid):
		//get ready to send mail -- set up mail() parameters
		$to = $admin_email;
		$mail_subject = "america's cup entry";

		
		$body .= "Name: $fname $lname\n";
		$body .= "Phone: $phone \n";
		$body .= "Email: $email \n";
		$body .= "City: $fcity";

		$header = "Reply-to: $email \r\n";
		$header .= "From: $fname $lname \r\n";

//send mail! mail_sent will equal 1 if the mail sends, 0 if it fails to send
		$mail_sent = mail($to, $mail_subject, $body, $header); 

	endif; // end if valid is still true

endif; //end if did_submit













//no close php