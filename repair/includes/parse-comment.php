<?php
//parse the comment form submission
if( $_POST['did_comment'] ){
	//extract and sanitize the form data
	$name = clean_input($_POST['name']);
	$body = clean_input($_POST['body']);

	//validate!
	$valid = true;

	//error: name field is blank
	if( strlen($name) == 0 ){
		$valid = false;
		$errors['name'] = 'Please fill in your name';
	}

	//error: body is blank
	if( strlen($body) == 0 ){
		$valid = false;
		$errors['body'] = 'Please fill in the comment body';
	}

	//if the data passed validation, add the comment to the DB
	if( $valid ){
		//set up query
		$query_insert = "INSERT INTO comments
						(name, body, date, post_id)
						VALUES
						('$name', '$body', now(), $post_id)";
		//run it
		$result_insert = $db->query($query_insert);		

	} //end if valid

	//check to see if the query ran and worked
	if( $db->affected_rows == 1 ){
		$status = 'success';  
		$message = 'Thanks for posting a comment, it will appear immediately.';
	}
	else{
		$status = 'error';
		$message = 'Your comment could not be added. Please fix any errors below and try again.';
	}

}//end comment parse