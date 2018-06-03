<?php

namespace App\Http\Controllers;

use App\Analytics;

class SignOutController extends Controller {

    public function index() {
        $title = "Sign Out";
        
        $analytics = new Analytics();
        $analytics->recordView("signout");
        
        session()->flush();
        
        return view("signout");
    }

}
