<?php include('includes/contact-parse.php');?>
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
            <form action="#" method="post" name="signup" id="signup">
              <fieldset id="messageInfo">
                  <legend>Your Message</legend>
                  <label for="title">Message title</label>
                  <input type="text" name="title" id="title" class="required" placeholder="title of your message here" value="<?php sticky_field($title); ?> ">
                  <div class="label">I would like more information about: </div>
                  <!-- having a UL here makes it really easy to change the display from a vertical to horizontal list-->
                  <ul class="choice-list">
                    <li>
                      <!--wrapping the label makes 'hit' area easier to control, is totally valid-->
                      <label for="installation">
                          <input type="radio" name="subject" id="installation" value="installation" title="Please select an option" <?php checked($subject, 'installation'); ?> >
                          Installation
                      </label>
                  </li>
                  <li>
                      <label for="licensing">
                          <input type="radio" name="subject" id="licensing" value="licensing"<?php checked($subject, 'licensing'); ?>>
                          Licensing
                      </label>
                  </li>
                  <li>
                      <label for="support">
                          <input type="radio" name="subject" id="support" value="support" <?php checked($subject, 'support'); ?>>
                          Support
                      </label>
                  </li>
              </ul>
              <label for="message"> Your Message </label>
              <textarea id="message" name="message" placeholder="Write your message" spellcheck="true" cols="45" rows="5" class="required"><?php sticky_field($message); ?></textarea>
              <p>Which services are you interested in?<br>
                <ul class="choice-list">
                  <li>
                    <label for="graphic-design">
                      <input type="checkbox" id="graphic-design" name="services[]" value="GD" <?php if(isset($services)){checkCheck('GD', $services);} ?> >Graphic&nbsp;Design
                    </label>
                  </li>
                  <li>
                    <label for="web-design">
                      <input type="checkbox" id="web-design" name="services[]" value="WDes" <?php if(isset($services)){checkCheck('WDes', $services);} ?>>Web&nbsp;Design
                    </label>
                  </li>
                  <li>
                    <label for="web-development">
                      <input type="checkbox" id="web-development" name="services[]" value="WDev" <?php if(isset($services)){checkCheck('WDev', $services);} ?>>Web&nbsp;Development
                    </label>
                  </li>
                  <li>
                    <label for="video">
                      <input type="checkbox" id="video" name="services[]" value="video" <?php if(isset($services)){checkCheck('video', $services);} ?>>Video
                    </label>
                  </li>
                  <li>
                    <label for="photo">
                      <input type="checkbox" id="photo" name="services[]" value="photography" <?php if(isset($services)){checkCheck('photography', $services);} ?>>Photography
                    </label>
                  </li>
                </ul>
              </p>
          </fieldset>

          <fieldset id="generalInfo">
           <legend>Your Contact Info </legend>
           <label for="name" class="label">Name </label>
           <input name="name" id="name" type="text" class="required" placeholder="John Doe" value="<?php sticky_field($name); ?>">

           <label for="email">E-mail Address</label>
           <input name="email" type="email" class="required" placeholder="yourEmail@yourisp.com" value="<?php sticky_field($email); ?>">

           <label for="url" class="label">URL</label>
           <input name="url" type="url" id="url" class="required" placeholder="http://themarysue.com" value="<?php sticky_field($url); ?>" >

           <label for="state">State</label>
           <select name="state" id="state" tabindex="150">
              <option value="">--Please select one--</option>
              <option value="FU" <?php selected("FU", $state); ?> >None of Your Business</option>
              <option value="AL" <?php selected("AL", $state); ?> >Alabama</option>
              <option value="AK" <?php selected("AK", $state); ?> >Alaska</option>
              <option value="AZ" <?php selected("AZ", $state); ?> >Arizona</option>
              <option value="AR" <?php selected("AR", $state); ?> >Arkansas</option>
              <option value="CA" <?php selected("CA", $state); ?> >California</option>
              <option value="CO" <?php selected("CO", $state); ?>>Colorado</option>
              <option value="CT" <?php selected("CT", $state); ?>>Connecticut</option>
              <option value="DE" <?php selected("DE", $state); ?>>Delaware</option>
              <option value="DC" <?php selected("DC", $state); ?>>District of Columbia</option>
              <option value="FL" <?php selected("FL", $state); ?>>Florida</option>
              <option value="GA" <?php selected("GA", $state); ?>>Georgia</option>
              <option value="HI" <?php selected("HI", $state); ?>>Hawaii</option>
              <option value="ID" <?php selected("ID", $state); ?>>Idaho</option>
              <option value="IL" <?php selected("IL", $state); ?>>Illinois</option>
              <option value="IN" <?php selected("IN", $state); ?>>Indiana</option>
              <option value="IA" <?php selected("IA", $state); ?>>Iowa</option>
              <option value="KA" <?php selected("KA", $state); ?>>Kansas</option>
              <option value="KY" <?php selected("KY", $state); ?>>Kentucky</option>
              <option value="LA" <?php selected("LA", $state); ?>>Louisiana</option>
              <option value="ME" <?php selected("ME", $state); ?>>Maine</option>
              <option value="MD" <?php selected("MD", $state); ?>>Maryland</option>
              <option value="MA" <?php selected("MA", $state); ?>>Massachusetts</option>
              <option value="MI" <?php selected("MI", $state); ?>>Michigan</option>
              <option value="MN" <?php selected("MN", $state); ?>>Minnesota</option>
              <option value="MO" <?php selected("MO", $state); ?>>Missouri</option>
              <option value="MT" <?php selected("MT", $state); ?>>Montana</option>
              <option value="NE" <?php selected("NE", $state); ?>>Nebraska</option>
              <option value="NV" <?php selected("NV", $state); ?>>Nevada</option>
              <option value="NH" <?php selected("NH", $state); ?>>New Hampshire</option>
              <option value="NJ" <?php selected("NJ", $state); ?>>New Jersey</option>
              <option value="NM" <?php selected("NM", $state); ?>>New Mexico</option>
              <option value="NY" <?php selected("NY", $state); ?>>New York</option>
              <option value="NC" <?php selected("NC", $state); ?>>North Carolina</option>
              <option value="ND" <?php selected("ND", $state); ?>>North Dakota</option>
              <option value="OH" <?php selected("OH", $state); ?>>Ohio</option>
              <option value="OK" <?php selected("OK", $state); ?>>Oklahoma</option>
              <option value="OR" <?php selected("OR", $state); ?>>Oregon</option>
              <option value="PA" <?php selected("PA", $state); ?>>Pennsylvania</option>
              <option value="RI" <?php selected("RI", $state); ?>>Rhode Island</option>
              <option value="SC" <?php selected("SC", $state); ?>>South Carolina</option>
              <option value="SD" <?php selected("SD", $state); ?>>South Dakota</option>
              <option value="TN" <?php selected("TN", $state); ?>>Tennessee</option>
              <option value="TX" <?php selected("TX", $state); ?>>Texas</option>
              <option value="UT" <?php selected("UT", $state); ?>>Utah</option>
              <option value="VT" <?php selected("VT", $state); ?>>Vermont</option>
              <option value="VA" <?php selected("VA", $state); ?>>Virginia</option>
              <option value="WA" <?php selected("WA", $state); ?>>Washington</option>
              <option value="WV" <?php selected("WV", $state); ?>>West Virginia</option>
              <option value="WI" <?php selected("WI", $state); ?>>Wisconsin</option>
              <option value="WY" <?php selected("WY", $state); ?>>Wyoming</option>
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
