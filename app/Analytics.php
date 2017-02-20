<?php

class Analytics {

    //TODO: Clean up logUniqueIP()
    //TODO: Add a date to table so that if an IP visits again 6 months after the first
    //visit, it gets its information rechecked

    private $conn;

    public function __construct() {
        $util = new util();
        $this->conn = $util->getConn();
    }

    public function recordView($page) {
        global $isLocalServer; // defind in constants.php
        if (!$this->conn){
            handleerror("Failed to make SQL connection for analytics");
            return false;
        }
        if (!$isLocalServer) {
            if($page === ""){
                $page = "home";
            }
            $time = getTime();
            $IP = getUserIP();
            $this->pageViewToSQL($page, $time, $IP);
            $this->logUniqueIP($IP, $time);
        }
    }

    private function pageViewToSQL($page, $time, $IP) {
        try {
            $statement = $this->conn->prepare('INSERT INTO PageViews VALUES (?, ?, NOW())');
            $statement->execute([$IP, $page]);
        } catch (Exception $ex) {
            handleerror("Analytics failed for some reason at $time for $IP CODE 3");
        }
    }

    private function logUniqueIP($IP, $time) {
        try {
            //Check if IP is unique, add to unique IP table if so.
            $statement = $this->conn->prepare('SELECT ID FROM UniqueIPs where IP = ?');
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
                        $statement = $this->conn->prepare("INSERT INTO UniqueIPs (IP, COUNTRY, STATE, CITY, ORGANIZATION) VALUES (?, ?, ?, ?, ?)");
                        $statement->execute([$IP, $country, $regionName, $city, $org]);
                    } else {
                        handleerror("Analytics failed for some reason at $time for $IP CODE 2");
                    }
                } else {
                    handleerror("Analytics failed for some reason at $time for $IP CODE 1");
                }
            }
        } catch (Exception $ex) {
            handleerror("Analytics failed for some reason at $time for $IP CODE 4 " . $ex->getMessage());
        }
    }

}

?>