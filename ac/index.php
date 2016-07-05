<?php 
include('includes/base-parse.php');
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Americas Cup Racing Home Page</title>
 <meta name="description" content="Embedded Responsive Video" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">	
	<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
	
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="scripts/jquery.smooth-scroll.min.js"></script>
<script>
     $(document).ready(function(){
          $('h3 a, li.toTop a').smoothScroll();
     });
</script>

</head>

<body class="cf">
	<header id="mainHead">
		<h1>America's Cup</h1>
	</header>
	<nav id="menu">
		<h3>
			<a href="#mainNav" title="Go to the Navigation">Menu &darr;</a>
		</h3>
	</nav>
	<div class="cf">
		<main>
			<section>
				<h3>Win a paid trip for two to the America's Cup Race. Just choose the winning city for a chance to win.</h3>
				<p><img src="images/oracle1.jpg"/>The island of Bermuda and the city of San Diego have been shortlisted as potential host cities for the 35th America’s Cup.“Both Bermuda and San Diego have made very compelling cases to be the host for the next America’s Cup,” said Russell Coutts, Director of the America’s Cup Event Authority (ACEA). “We will be in good hands with either venue.”
			</section>
			<section>
				<h3>You Can Choose Bermuda</h3>
				<p><img src="images/bermuda.jpg"/>Bermuda is 640 miles (1,030 km) east-southeast of North Carolina. It is known to sailors for the Newport to Bermuda race, as well as the Bermuda Gold Cup match-racing event, both of which have a long history of success on the island and a sterling reputation among sailors. America’s Cup racing in Bermuda would take place close to shore, within the Great Sound.
			</section>
			<section>
				<h3>You Can Choose San Diego</h3>
				<p><img src="images/sandiego.jpg"/>San Diego is one of only seven cities to have hosted the America’s Cup. When the Cup was previously held there in 1988, 1992 and 1995, the race course was far offshore, on the ocean waters beyond Point Loma. But if San Diego were selected as the venue this time, racing would take place in San Diego Bay, offering incredible viewing opportunities for spectators along the city’s waterfront.
			</section>
			<div class="video">
				<iframe  src="http://www.youtube.com/embed/Y6dnOlE9sjk?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
			<section class="contactform">
				<?php 
              //if the form was submitted then call the display_error_or_success()
              if($_POST['did_submit']){
                display_error_or_success($errors, $mail_sent);
                //remove this if you do not want to show user what was sent
                // if($mail_sent){
                //   echo "This is what was parsed and sent: <br>mail-to: $to<br>";
                //   echo "mail-subject: $mail_subject<br>";
                //   echo "mail-body: $body <br>";
                //   echo "mail-headers: $header <br>";
                // }
              }
              if(1!= $mail_sent){
               ?>
  				<h2>Wan't to win?</h2>
                 <p>Fill out this form and choose either San Diego or Bremuda. If your choice is selected, and you win our raffle. We will send you and one guest to the races, all inclusive. Good luck.</p>
                <form method="post" action="#">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" />
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" />
                    <label for="email">Email Address:</label>
                    <input type="text" name="email" id="email" />
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" id="phone" />                      
                    <fieldset class="checkgroup">
                        <input type="checkbox" name="city[]" id="sandiego_yes" value="sandiego" />
                        <label for="sandiego_yes">San Diego</label>
                        <input type="checkbox" name="city[]" id="bermuda_yes" value="bermuda" />
                        <label for="bermuda_no">Bermuda</label>                       
                    </fieldset>  
                    <input type="hidden" name="did_submit" value="1">           
                    <input type="submit" name="submit" value="Send My Entry" />
                </form>
               <?php 
                }?>
            </section>
	        <nav id="mainNav" role="navigation" class="cf">
				<h2 hidden>Site Navigation</h2>
				<ul>
					<li>
					<a href="#">Home</a></li><li>
					<a href="bermuda.html">Bermuda</a></li><li>
					<a href="sandiego.html">San Diego</a></li><li class="toTop">
					<a href="#mainHead">&uarr; Back to Top</a></li>	
				</ul>
			</nav>
		</main>
		<aside class="aside">
			<h3>What You Can Expect To See</h3>
			<ul>
				<li>Get Ready for the experience of a lifetime.</li>
				<li>Sun, drinks, food and a week on the water.</li>
			</ul>
			<ul>
		      <li class="product">
		      	<img src="images/alingi.jpg" width="305" height="204">
		      	<p>Alingi</p>
		      </li>
		      <li class="product">
		      	<img src="images/cuphoist.jpg" width="305" height=
		      	"191"><p>The Cup Hoist</p>
		      </li>
		      <li class="product">
		      	<img src="images/boattip1.jpg" width="305" height=
		      	"203"><p>The Big Tip</p>
		      </li>
		      <li class="product">
		      	<img src="images/raceturn1.jpg" width="305" height=
		      	"229"><p>The Turn</p></li>
		      <li class="product">
		      	<img src="images/oracle2.jpg" width="305" height="218">
		      	<p>Oracle 2</p>
		      </li>
		      <li class="product">
		      	<img src="images/dt1.jpg" width="305" height="168">
		      	<p>After the Race</p>
		  		</li>
			</ul>
		</aside>
	</div><!-- end cf -->
	<footer id="pageFoot">
		<small> Copyright - William Valdez </small>
	</footer>
</body>
</html>
