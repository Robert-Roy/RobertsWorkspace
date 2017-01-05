<?php
include_once "util.php";
//todo Log This Serverside
$page = $_SERVER['PHP_SELF'];
$time = date("Y-m-d H:i:s");
$IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
$json = file_get_contents("http://ip-api.com/json/$IP");
$array = json_decode($json);
if (is_object($array)) {
    $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
    if ($status === "success") {
        $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
        $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
        $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
        $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));
        util::mailadmin("Pageload Logged", "$IP loaded $page at $time
        
Information about this ip:
    Country: $country
    City: $city
    Region: $regionName
    Organization: $org
    ");
    } else {
        util::mailadmin("Analytics Failure", "Analytics failed for some reason at $time for $IP CODE 2"); //TODO Log error locally
    }
} else {
    util::mailadmin("Analytics Failure", "Analytics failed for some reason at $time for $IP CODE 1"); //TODO Log error locally
}
?>
