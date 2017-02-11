<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
require_once "util.php";
util::printheader("What your IP says about you:");
$apierror = false; //this will tell me if i could not get the json file from ip-api.com
$IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));

$json = file_get_contents("http://ip-api.com/json/$IP");
$array = json_decode($json);
if (is_object($array)) {
    $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
    if ($status != "fail") {
        $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
        $countryCode = htmlspecialchars(\filter_var(\trim($array->countryCode), FILTER_SANITIZE_STRING));
        $region = htmlspecialchars(\filter_var(\trim($array->region), FILTER_SANITIZE_STRING));
        $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
        $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
        $zip = htmlspecialchars(\filter_var(\trim($array->zip), FILTER_SANITIZE_STRING));
        $lat = htmlspecialchars(\filter_var(\trim($array->lat), FILTER_SANITIZE_STRING));
        $lon = htmlspecialchars(\filter_var(\trim($array->lon), FILTER_SANITIZE_STRING));
        $timezone = htmlspecialchars(\filter_var(\trim($array->timezone), FILTER_SANITIZE_STRING));
        $isp = htmlspecialchars(\filter_var(\trim($array->isp), FILTER_SANITIZE_STRING));
        $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));
        $as = htmlspecialchars(\filter_var(\trim($array->as), FILTER_SANITIZE_STRING));
    }
} else {
    $apierror = true;
}
?>
<div class="contentdiv" style="text-align:center">
    <p>Your IP:<br><?= $IP ?></p>
</div>
<br>
<div class="contentdiv">
    <p>
        <?php
        if ($apierror === true) {
            util::handleerror("35878693671");
            ?>Unable to make connection to ip-api.com.<?php
        } elseif ($status === "fail") {
            util::handleerror("68735357732");
            ?>An error has occurred. It has been logged.<?php
        } elseif ($status === "success") {
            ?>
            Country: <?= $country ?> (<?= $countryCode ?>)<br>
            Region: <?= $regionName ?> (<?= $region ?>)<br>
            City: <?= $city ?><br>
            Zip: <?= $zip ?><br>
            Coordinates: (<?= $lat ?>, <?= $lon ?>)<br>
            Time Zone: <?= $timezone ?><br>
            Internet Service Provider: <?= $isp ?><br>
            Organization: <?= $org ?><br>
            As Number/Name: <?= $as ?>
        <?php
        } else {
            util::handleerror("2531432154235123");
            ?>An error has occurred. It has been logged.<?php
            //TODO Log error
        }
        ?>
    </p>
</div>
<br>
<div class="contentdiv">
    <p>Powered by: <a href="http://ip-api.com/">ip-api.com</a></p>
</div>
<?php
util::printfooter();
?>