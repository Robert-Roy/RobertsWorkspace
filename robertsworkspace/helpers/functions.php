<?php

function getUserIP() {
    return htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
}

function getPage() {
    return $page = htmlspecialchars(\filter_var(\trim($_SERVER['PHP_SELF']), FILTER_SANITIZE_STRING));
}

function getTime() {
    return $time = date("Y-m-d H:i:s");
}

function handleerror($errorcode) {
    mailadmin("Site Error", "Error " . $errorcode . " occurred on " . $_SERVER['PHP_SELF'] . ".");
}

function mailadmin($subject, $message) {
    global $ADMINEMAIL;
    if ($_SERVER['SERVER_ADDR'] != "127.0.0.1") {
        mail($ADMINEMAIL, $subject, $message, "From: <" . $ADMINEMAIL . ">");
    } else {
        echo $subject . "<br>" . $message . "<br>";
    }
}

?>