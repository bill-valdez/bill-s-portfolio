<?php
//where we are ... 
//for mailing: change this to your email address when you put this on a live server.
$admin_email = 'none@none.com';

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
		if(!empty($errors)){
		foreach($errors as $error){
			echo $error;
			echo '<br />';
		}
	}
		echo '</section>';
	}elseif(1==$mail_sent){
		echo '<section class="success form-message">
				<h1>Thank you for contacting us!</h1>
				<p>We\'ll get back to you shortly.</p>
				</section>';
	}
}
//keep the value of a field after a form is submitted
function sticky_field($field){
	if(isset($field)){
		echo $field;
	}
}

//sticky selects
function selected($expected, $actual){
	if($actual == $expected){
		echo 'selected="selected"';
	}
}
//check box sticky function
function checkCheck($checkThis, $againstThis){
	if(in_array($checkThis, $againstThis)){
		echo 'checked="checked"';
	}

}

//for sticky radio buttons
function checked($expected, $actual){
	if($actual == $expected){
		echo 'checked="checked"';
	}
}



//start parsing
if(1 ==$_POST['did_submit']):
//conditions go inside here
	//cant trust users, clean up data.	
	 $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	 $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
	 $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	 $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	 $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
	 $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
	 if(is_array($_POST['services'])){
	 $services = filter_var_array($_POST['services'],FILTER_SANITIZE_STRING);
		}
		//allow certain tags in our message string
	 $allow = '<b><i><strong><em><p>';
	 $message = strip_tags(trim($_POST['message']), $allow );

//begin validation
	 $valid = true; //be sure to reinstate after testing!!!!!

//checks to see if a name was entered
	 if(0 == strlen($name)){
	 	$valid = false;
	 	$errors['name'] = 'Please fill out your name.';
	 }
//check for invalid email format
	 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	 	$valid = false;
	 	$errors['email'] = 'Please provide a valid email address.';
	 }
//check for an empty subject field
	 if(0 == strlen($subject)){
	 	$valid = false;
	 	$errors['subject'] = 'Please choose one of the subjects.';
	 }	 

//check message string length
	 if(4 > strlen($message)){
	 	$valid = false;
	 	$errors['message'] = 'Please write a message.';
	 }
//get the data from the services array if it has data
	 if(empty($services)){
	 	$fServices = "They didn't select any services. \n";
	 }else{
	 	$N = count($services);
	 	$fServices .= "The selected $N service(s) ";
	 	for($i=0; $i < $N; $i++){
	 		$fServices .=($services[$i]." ");
	 	}
	 }

//only send the mail if valid is still true
	if(true == $valid):
		//get ready to send mail -- set up mail() parameters
		$to = $admin_email;
		$mail_subject = "$title - A Contact Form Submission";

		$body = "Subject: $subject \n";
		$body .= "Name: $name \n";
		$body .= "From: $state \n";
		$body .= "Email: $email \n";
		$body .= "URL: $url \n\n";
		$body .= "Message: $message \n\n";
		$body .= "Services: $fServices";

		$header = "Reply-to: $email \r\n";
		$header .= "From: $name \r\n";

//send mail! mail_sent will equal 1 if the mail sends, 0 if it fails to send
		$mail_sent = mail($to, $mail_subject, $body, $header); 

	endif; // end if valid is still true

endif; //end if did_submit













//no close php