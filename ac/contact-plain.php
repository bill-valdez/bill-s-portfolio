<?php include('includes/base-parse.php');?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen, projection">
  <!-- add js to validate our form before it goes to the server -->
  <script src="scripts/jquery-1.11.1.min.js"></script>
  <script src="scripts/jquery.validateT.min.js"></script>
  <script src="scripts/validTests.js"></script>

</head>
<body id="top">
    <main role="main" class="cf">
       <div class="page-content"> 
          <article id="contact-form"> 
              <h1>Contact Us</h1>
              <div class="mobile-emphasis">
                  <a href="tel:15551234569" class="primary action">Call us directly: <span class="phone">1-555-123-4569</span></a> 
              </div>
              <p>Please let us know how we can help you. It only takes a moment, and we'll get back to you shortly. </p>
              <?php 
              //if the form was submitted then call the display_error_or_success()
              if($_POST['did_submit']){
                display_error_or_success($errors, $mail_sent);
                //remove this if you do not want to show user what was sent
                if($mail_sent){
                  echo "This is what was parsed and sent: <br>mail-to: $to<br>";
                  echo "mail-subject: $mail_subject<br>";
                  echo "mail-body: $body <br>";
                  echo "mail-headers: $header <br>";
                }
              }
              if(1!= $mail_sent){
               ?>
            <form action="#" method="post" name="signup" id="signup" novalidate>
              <fieldset id="messageInfo">
                  <legend>Your Message</legend>
                  <label for="title">Message title</label>
                  <input type="text" name="title" id="title" class="required" placeholder="title of your message here">
                  <div class="label">I would like more information about: </div>
                  <!-- having a UL here makes it really easy to change the display from a vertical to horizontal list-->
                  <ul class="choice-list">
                    <li>
                      <!--wrapping the label makes 'hit' area easier to control, is totally valid-->
                      <label for="installation">
                          <input type="radio" name="subject" id="installation" value="installation" title="Please select an option">
                          Installation
                      </label>
                  </li>
                  <li>
                      <label for="licensing">
                          <input type="radio" name="subject" id="licensing" value="licensing">
                          Licensing
                      </label>
                  </li>
                  <li>
                      <label for="support">
                          <input type="radio" name="subject" id="support" value="support">
                          Support
                      </label>
                  </li>
              </ul>
              <label for="message"> Your Message </label>
              <textarea id="message" name="message" placeholder="Write your message" spellcheck="true" cols="45" rows="5" class="required"></textarea>
              <p>Which services are you interested in?<br>
                <ul class="choice-list">
                  <li>
                    <label for="graphic-design">
                      <input type="checkbox" id="graphic-design" name="services[]" value="GD">Graphic&nbsp;Design
                    </label>
                  </li>
                  <li>
                    <label for="web-design">
                      <input type="checkbox" id="web-design" name="services[]" value="WDes">Web&nbsp;Design
                    </label>
                  </li>
                  <li>
                    <label for="web-development">
                      <input type="checkbox" id="web-development" name="services[]" value="WDev">Web&nbsp;Development
                    </label>
                  </li>
                  <li>
                    <label for="video">
                      <input type="checkbox" id="video" name="services[]" value="video">Video
                    </label>
                  </li>
                  <li>
                    <label for="photo">
                      <input type="checkbox" id="photo" name="services[]" value="photography">Photography
                    </label>
                  </li>
                </ul>
              </p>
          </fieldset>

          <fieldset id="generalInfo">
           <legend>Your Contact Info </legend>
           <label for="name" class="label">Name </label>
           <input name="name" id="name" type="text" class="required" placeholder="John Doe">

           <label for="email">E-mail Address</label>
           <input name="email" type="email" class="required" placeholder="yourEmail@yourisp.com">

           <label for="url" class="label">URL</label>
           <input name="url" type="url" id="url" class="required" placeholder="http://themarysue.com">

           <label for="state">State</label>
           <select name="state" id="state" tabindex="150">
              <option value="">--Please select one--</option>
              <option value="FU">None of Your Business</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KA">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
          </select>
      </fieldset>
      <!-- Added hidden field for PHP form submission detection -->
      <input type="hidden" name="did_submit" value="1">
      <input type="submit" name="submit" id="submit" value="Submit">
  </form> 
  <?php }//end if mail not sent ?>
</article>
</div>
</main>
</body>
</html>
