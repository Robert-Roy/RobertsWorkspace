<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
//TODO better validate information before sending email
//TODO block banned IPs
//TODO banip page
//todo confirm send page
require_once "util.php";
util::printheader("Delivery");
?>                            
<div class="contentdiv">
    <?php
    if (empty($_POST['name']) && empty($_POST['email']) && empty($_POST['phone']) && empty($_POST['message'])) {
        ?><p>One of us appears to have made a mistake.<br>You should not be here.<br><br><a href="<?= util::$HOME ?>">Return to Home</a></p><?php
    } else {
        $name = htmlspecialchars(\filter_var(\trim($_POST["name"]), FILTER_SANITIZE_STRING));
        $email = htmlspecialchars(\filter_var(\trim($_POST["email"]), FILTER_SANITIZE_STRING));
        $phone = htmlspecialchars(\filter_var(\trim($_POST["phone"]), FILTER_SANITIZE_STRING));
        $message = htmlspecialchars(\filter_var(\trim($_POST["message"]), FILTER_SANITIZE_STRING));
        $IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
        $finalmessage = "Name: " . $name . "\nEmail: " . $email . "\nPhone: " . $phone .
                "\nMessage: " . $message . "\nLogged IP: " . $IP . "\nSent Automatically by www.RobertsWorkspace.com";
        $blnvalidinput = true;
        $strInvalidReasons = "<ul>";

        if ($name === "") {
            $blnvalidinput = false;
            $strInvalidReasons = "No Name Entered<BR>";
        }
        if ($email === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Email Address Entered</li>";
        }
        if ($phone === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Phone Number Entered</li>";
        }
        if ($message === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Message Entered</li>";
        }
        $strInvalidReasons = $strInvalidReasons . "</ul>";

        if ($blnvalidinput) {
            util::mailadmin('Contact Form Inquiry', $finalmessage);
            ?><p>Your message has been successfully sent. Thank you.</p><?php
            } else {
                ?><p>Your message was not for the following reasons:
                <br><br>
                <?= $strInvalidReasons ?>
                <br>
                <a href="<?= util::$CONTACT ?>">Please try again</a>.</p><?php
        }
    }
    ?>

</div>
<?php
util::printfooter();
?>