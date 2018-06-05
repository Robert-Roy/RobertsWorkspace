<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Request;
use App\Project;
use App\Analytics;

class PortfolioController extends Controller {    
    private function logAnalytics($pageName){
        $analytics = new Analytics();
        $analytics->recordView($pageName);
    }
    
    public function home() {
        $pageName = "home";
        $title = "<div style='display:inline-block'>Web Development</div> <div style='display:inline-block'>Done Right</div>";
        $this->logAnalytics($pageName);

        return view("home", compact('title'));
    }
    
    public function contact() {
        $pageName = "contact";
        $title = "Leave Me a Message";
        $this->logAnalytics($pageName);

        return view("contact", compact('title'));
    }
        
    public function dashboard() {
        $pageName = "dashboard";
        $title = "Robert's Analytics";
        $this->logAnalytics($pageName);
        
        $IP = Request::ip();
        $ip_id = DB::table("uniqueips")->where("ip", "=", $IP)->get(["ip_id"]);
        if ($ip_id->isEmpty()) {
            $ip_id = "511"; // for debugging, should only happen if the user has never ever visited the site, which is
            //impossible if the user is on this page
        } else {
            //get the ip
            $ip_id = $ip_id[0]->ip_id;
        }
        // make counters
        $userTotalViews = 0;
        $allUsersTotalViews = 0;
        $pageViewData = [];
        //Find out how many times IP has viewed current page
        $uniquePage = DB::table("pageviews")->distinct()->get(["page"]);
        // show user views of ALL pages by getting all pages then showing all views

        foreach ($uniquePage as $thisPage) {
            $thisPageName = "" . $thisPage->page;
            // get user's views on current page
            $viewsOnThisPage = DB::table("pageviews")->where("page", "=", $thisPageName);
            $totalViewsOnThisPage = $viewsOnThisPage->count();
            $userViewsOnThisPage = $viewsOnThisPage->where("ip_id", "=", $ip_id)->count();
            $pageViewData[] = ["page" => $thisPageName,
                "userViews" => $userViewsOnThisPage,
                "totalPageViews" => $totalViewsOnThisPage
            ];
            $userTotalViews += $userViewsOnThisPage;
            $allUsersTotalViews += $totalViewsOnThisPage;
        }

        return view("dashboard", compact("title", "pageViewData", "allUsersTotalViews", "userTotalViews"));
    }
    
    public function projects() {
        //TODO: add pictures
        //Still needs improvement. Calling the partials in this way seems sloppy.
        
        $pageName = "projects";
        $title = "My Projects";
        $this->logAnalytics($pageName);
        $projects = Project::all();
        echo view("partials.projectstop", ["title" => $title]);
        foreach ($projects as $thisProject) {
            echo view("partials.project", $thisProject->getViewData());
        }
        return view("partials.projectsbottom");
    }
    
    public function privacy() {
        $pageName = "privacy";
        $title = "Privacy Policy";
        $this->logAnalytics($pageName);

        return view('privacy', compact("title"));
    }
    
    public function sendmail() {
        //TODO better validate information before sending email
        //TODO block banned IPs
        //TODO banip page
        //todo confirm send page
        $pageName = "sendmail";
        $title = "Delivery";
        $this->logAnalytics($pageName);

        $name = htmlspecialchars(\filter_var(\trim($_POST["name"]), FILTER_SANITIZE_STRING));
        $email = htmlspecialchars(\filter_var(\trim($_POST["email"]), FILTER_SANITIZE_STRING));
        $phone = htmlspecialchars(\filter_var(\trim($_POST["phone"]), FILTER_SANITIZE_STRING));
        $message = htmlspecialchars(\filter_var(\trim($_POST["message"]), FILTER_SANITIZE_STRING));
        $IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
        $finalmessage = "Name: " . $name . "\nEmail: " . $email . "\nPhone: " . $phone .
                "\nMessage: " . $message . "\nLogged IP: " . $IP . "\nSent Automatically by www.RobertsWorkspace.com";
        $blnvalidinput = true;

        $strInvalidReasons = "<ul>";
        if ($name === "") {
            $blnvalidinput = false;
            $strInvalidReasons = "<li>No Name Entered</li>";
        }
        if ($email === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Email Address Entered</li>";
        }
        if ($phone === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Phone Number Entered</li>";
        }
        if ($message === "") {
            $blnvalidinput = false;
            $strInvalidReasons = $strInvalidReasons . "<li>No Message Entered</li>";
        }
        $strInvalidReasons = $strInvalidReasons . "</ul>";

        if ($blnvalidinput) {
            $mailer = new Mailer();
            $mailer->mailAdmin('Contact Form Inquiry', $finalmessage);
            return view("sendmailsuccess", compact("title"));
        }
        $title = "Delivery Failed";
        return view("sendmailfailure", compact("title", "strInvalidReasons"));
    }
    
    public function ipdata() {
        $pageName = "ipdata";
        $title = "What your IP says about you:";
        $this->logAnalytics($pageName);

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