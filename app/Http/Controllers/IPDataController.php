<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IPDataController extends Controller {

    public function index() {
        $title = "What your IP says about you:";

        $IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
        if ($IP === "127.0.0.1" || $IP === "::1") {
            $IP = "8.8.8.8";
        }
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
                return view("ipdata", compact(
                        "title",
                        "IP",
                        "country",
                        "countryCode",
                        "region",
                        "regionName",
                        "city",
                        "zip",
                        "lat",
                        "lon",
                        "timezone",
                        "isp",
                        "org",
                        "as"));
            }
        } else {
            //API error occurred
            //this will tell me if i could not get the json file from ip-api.com
            handleerror("35878693671");
        }
        if ($status === "fail") {
            handleerror("68735357732");
        } else {
            handleerror("2531432154235123");
        }
    }

}
