<?php

include_once "util.php";
$util = new util();
$conn = $util->getConn();
$page = $_SERVER['PHP_SELF'];
$time = date("Y-m-d H:i:s");
$IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
$json = file_get_contents("http://ip-api.com/json/$IP");
$array = json_decode($json);
if (is_object($array)) {
    $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
    if ($status === "success") {
        //Clean Up Text
        $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
        $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
        $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
        $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));
        try{
            //Check if IP is unique, add to unique IP table if so.
            $conn->prepare('SELECT ID FROM UniqueIPs where IP = ?');
            $result = $conn->execute([$IP]);
            $instance = false;
            foreach ($result as $row) {
                $instance = true;
            }
            if ($instance === false) {
                $test->prepare("INSERT INTO UniqueIPs (IP, COUNTRY, STATE, CITY, ORGANIZATION) VALUES (?, ?, ?, ?, ?)");
                $test->execute([$IP, $country, $regionName, $city, $org]);
            }
            } catch (Exception $ex) {
            util::handleerror("Analytics failure code 2 at $time");
        }
    } else {
        util::handleerror("Analytics failed for some reason at $time for $IP CODE 2"); //TODO Log error locally
    }
} else {
    util::handleerror("Analytics failed for some reason at $time for $IP CODE 1"); //TODO Log error locally
}
?>
