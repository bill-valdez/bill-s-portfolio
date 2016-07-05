<?php session_start() ?>
<?php require 'includes/config.php'; ?>
<?php require_once'includes/functions.php'; ?>
<?php require_once'includes/loginparse.php'; ?>
<?php require_once'includes/registerparse.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Bill's T.V. Repair</title>
	<!--  
 <meta name="description" content="Embedded Responsive Video" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
-->

<link href="css/normalize.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" href="rss.php">

	<!-- 
	<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
	
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="scripts/jquery.smooth-scroll.min.js"></script>
<script>
     $(document).ready(function(){
          $('h3 a, li.toTop a').smoothScroll();
     });
</script>
-->

</head>

<body class="cf">
	<div class="prompt">
		<ul>

			<li>Hey there! Welcome to Bill's T.V. Repair. Lets fix your T.V. </li>
			<?php  if ($_SESSION['logged_in']) {
				?>
				<li><a href="?action=logout">Logout</a></li>
				<?php 

			}else{?>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
			<?php } ?>
			<li><h3><a href="mailto:contact@billstvrepair.com">service@billstvrepair.com</a></h3></li>
			<li><h3><a href="register.php">Contact Me</a></h3></li>

		</ul>
		
	</div>
	<header id="mainHead" class="cf">
		<ul>			
			<li><h1>billstvrepair.com</h1></li>
			<li><h2>619-756-8618</h2></li>

				<!-- <li><form action="search.php" method="get" id="searchform">
					<input type="search" name="phrase" id="phrase" value="">
					<input type="submit" value="Search">
				</form></li> -->
			</ul>

		</header>
		
		<main id="content">
			
			<nav id="mainNav" role="navigation" class="cf">
				

				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>					
					<li><a href="blog.php">Blog</a></li>
					<li><a href="inhomeservice.php">In Home Service</a></li>
					<li><a href="tvparts.php">T.V.Parts</a></li>
					<li><a href="fixityourself.php">Fix It Yourself</a></li>
					<li><a href="techtips.php">Tech Tips</a></li>
				</ul>
			</nav>