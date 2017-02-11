<?php
require_once "util.php";
//TODO: Add a date to table so that if an IP visits again 6 months after the first
//visit, it gets its information rechecked
$util = new util();
$conn = $util->getConn();
$page = util::getPage();
$time = util::getTime();
$IP = util::getUserIP();
try {
//Log Pageview
    $statement = $conn->prepare('INSERT INTO PageViews VALUES (?, ?, NOW())');
    $statement->execute([$IP, $page]);
} catch (Exception $ex) {
    util::handleerror("Analytics failed for some reason at $time for $IP CODE 3");
}
try {
    //Check if IP is unique, add to unique IP table if so.
    $statement = $conn->prepare('SELECT ID FROM UniqueIPs where IP = ?');
    $statement->execute([$IP]);
    if ($statement->rowcount() === 0) {
        //Fetch json with information about the IP
        $json = file_get_contents("http://ip-api.com/json/$IP");
        $array = json_decode($json);
        if (is_object($array)) {
            $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
            //json returns this if it is successful
            if ($status === "success") {
                //JSON to vars
                $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
                $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
                $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
                $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));
                //Insert into SQL
                $statement = $conn->prepare("INSERT INTO UniqueIPs (IP, COUNTRY, STATE, CITY, ORGANIZATION) VALUES (?, ?, ?, ?, ?)");
                $statement->execute([$IP, $country, $regionName, $city, $org]);
            } else {
                util::handleerror("Analytics failed for some reason at $time for $IP CODE 2");
            }
        } else {
            util::handleerror("Analytics failed for some reason at $time for $IP CODE 1");
        }
    }
} catch (Exception $ex) {
    util::handleerror("Analytics failed for some reason at $time for $IP CODE 4 " . $ex->getMessage());
}
?>