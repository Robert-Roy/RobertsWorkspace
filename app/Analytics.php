<?php

namespace App;

use Request;
use Illuminate\Support\Facades\DB;

class Analytics {

    //TODO: Clean up logUniqueIP()
    //TODO: recheck uniqueIPs that are 6 months+ old
    //TODO: recheck unknowns
    private $ip_id;
    private $requestPage;
    private $requestIP;
    private $now;

    public function recordView($requestPage) {
        $this->requestPage = $requestPage;
        $this->requestIP = Request::ip();
        $this->now = $this->getTime();
        $this->logUniqueIP($this->requestIP);
        $this->pageViewToSQL($this->requestPage, $this->ip_id, $this->requestIP);
    }

    function getTime() {
        return $time = date("Y-m-d H:i:s");
    }

    private function pageViewToSQL($page, $ip_id) {
        DB::table('pageviews')->insert(
                ['ip_id' => $ip_id,
                    'page' => $page,
                    'created_at' => $this->now]);
        //DB::table("pageviews")->;
//        try {
//            $statement = $this->conn->prepare('INSERT INTO PageViews VALUES (?, ?, NOW())');
//            $statement->execute([$IP, $page]);
//        } catch (Exception $ex) {
//            handleerror("Analytics failed for some reason at $time for $IP CODE 3");
//        }
    }

    private function setIPID($ip_id) {
        $this->ip_id = $ip_id;
    }

    private function logUniqueIP($IP) {
        $ipQuery = DB::table('uniqueips')->where("ip", "=", $this->requestIP);
        if ($ipQuery->count() === 0) {
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
                    $ip_id = $DB::table('uniqueips')->insertGetId(
                            ['ip' => $this->requestIP,
                                'country' => $country,
                                'state' => $region,
                                'city' => $city,
                                "organization" => $org,
                                "created_at" => $this->now,
                                "updated_at()" => $this->now]);
                    $this->setIPID($ip_id);
                    return;
                }
            }
            // fill what we can if failure
            $ip_id = DB::table('uniqueips')->insertGetId(
                    ['ip' => $this->requestIP,
                        'country' => 'unknown',
                        'state' => 'unknown',
                        'city' => 'unknown',
                        "organization" => 'unknown',
                        "created_at" => $this->now,
                        "updated_at" => $this->now]);
            $this->setIPID($ip_id);
            return;
        }
        $this->setIPID($ipQuery->get(['ip_id'])[0]->ip_id);
    }

}

?>