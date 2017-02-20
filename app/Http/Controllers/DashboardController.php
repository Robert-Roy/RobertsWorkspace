<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use App\Analytics;

class DashboardController extends Controller {

    public function index() {
        $title = "Robert's Analytics";
        $analytics = new Analytics();
        $analytics->recordView();
        
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

}
