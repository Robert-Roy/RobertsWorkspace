<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->

<?php
//todo res
//todo autoresize text area
//error hover messages
//todo calendar practice
//practice numerical inputs
//input patern validation
// create a password project
//location practice
//hover/focus change appearance
//swipe left/right program
// practice even tlisteners in javascript, especially adding them

include("util.php");
util::printheader("Send Robert a Message");
?>
    <div class="contentdiv contactdiv">  
        <form action="sendmail.php" method="post" onsubmit="return validateContactForm();">
                <label class="label" for="name">What is your name?</label>
                <input type="text" name="name" autofocus autocomplete="name" placeholder="John Doe">
                <label class="label" for="email">What is your email address?</label>
                <input type="text" name="email" autocomplete="email" placeholder="johndoe@gmail.com">
                <label class="label"  for="phone">What is your phone number?</label>
                <input type="text" name="phone" autocomplete="tel" placeholder="555-555-5555">
                
                <label class="label" for="message">What would you like to say to me?</label>
            <textarea type="text" rows="4" name="message" placeholder="Hey, Robert. Nice website!"></textarea><br>
            <input class="crispbutton" style="margin-top:3px" type="submit" value="Send Message">
        </form>
    </div>
<div class='contentdiv'>
    <a href='mailto:Robert@robertsworkspace.com'>Prefer to send an email?</a>
</div>
<?php
util::printfooter();

?>