<?php include "includes/header.php"; 

?>


	
			<img src="images/login.jpg">
		
		<h1>Log in to your account</h1>

	<?php //if the user triggered the error, show the message
	if( $error == true ){
		echo $message;
	}
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username">

		<label for="password">Password:</label>
		<input type="password" name="password" id="password">

		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="true">
	</form>

	<a href="register.php">Don't have an account? Sign up here.</a><br>
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
