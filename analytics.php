<?php

include_once "util.php";
$util = new util();
$conn = $util->getConn();
$page = htmlspecialchars(\filter_var(\trim($_SERVER['PHP_SELF']), FILTER_SANITIZE_STRING));
$time = date("Y-m-d H:i:s");
$IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
$json = file_get_contents("http://ip-api.com/json/$IP");
$array = json_decode($json);

try {
    //Log Pageview
    $statement = $conn->prepare('INSERT INTO PageViews VALUES (?, ?, NOW())');
    $statement->execute([$IP, $page]);
} catch (Exception $ex) {
    util::handleerror("Analytics failed for some reason at $time for $IP CODE 3");
}


if (is_object($array)) {
    $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
    if ($status === "success") {
        //Clean Up Text
        $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
        $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
        $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
        $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));

        try {
            //Check if IP is unique, add to unique IP table if so.
            $statement = $conn->prepare('SELECT ID FROM UniqueIPs where IP = ?');
            $result = $statement->execute([$IP]);
            $instance = false;
            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {
                    $instance = true;
                    break;
                }
            }
            if ($instance === false) {
                $statement = $conn->prepare("INSERT INTO UniqueIPs (IP, COUNTRY, STATE, CITY, ORGANIZATION) VALUES (?, ?, ?, ?, ?)");
                $statement->execute([$IP, $country, $regionName, $city, $org]);
            }
        } catch (Exception $ex) {
            util::handleerror("Analytics failed for some reason at $time for $IP CODE 4");
        }
    } else {
        util::handleerror("Analytics failed for some reason at $time for $IP CODE 2");
    }
} else {
    util::handleerror("Analytics failed for some reason at $time for $IP CODE 1");
}
?>
