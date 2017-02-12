<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

require_once "util.php";
$util = new util();
//Initialize SQL Tables
try {
    $util->query("CREATE TABLE UniqueIPs ("
            . "ID INT NOT NULL AUTO_INCREMENT, "
            . "IP TEXT, "
            . "COUNTRY TEXT, "
            . "STATE TEXT, "
            . "CITY TEXT, "
            . "ORGANIZATION TEXT, "
            . "PRIMARY KEY (ID)"
            . ")");
} catch (Exception $ex) {
    //Do nothing
    echo "ERROR ERROR ERROR ERROR eeg";
}
try {
    $util->query("CREATE TABLE PageViews ("
            . "IP TEXT, "
            . "PAGE TEXT, "
            . "TIME DATETIME"
            . ")");
} catch (Exception $ex) {
    //Do nothing
    echo "ERROR ERROR ERROR ERROR";
}
?>