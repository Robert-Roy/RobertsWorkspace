<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analytics;

class PrivacyController extends Controller {

    public function index() {
        $title = "Privacy Policy";
        $analytics = new Analytics();
        $analytics->recordView("privacy");

        return view('privacy', compact("title"));
    }

}
