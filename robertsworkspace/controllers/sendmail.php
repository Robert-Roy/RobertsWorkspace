<?php

//TODO better validate information before sending email
//TODO block banned IPs
//TODO banip page
//todo confirm send page
$title = "Delivery";

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
    $strInvalidReasons = "<li>No Name Entered</li>";
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
    mailadmin('Contact Form Inquiry', $finalmessage);
    require $VIEWROOT . "sendmailsuccess.view.php";
    die();
}
$title = "Delivery Failed";
require $VIEWROOT . "sendmailfailure.view.php";