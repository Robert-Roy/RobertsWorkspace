<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

if ($_SERVER['SERVER_ADDR'] != "::1") {
    if ($_SERVER["HTTPS"] != "on") {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}