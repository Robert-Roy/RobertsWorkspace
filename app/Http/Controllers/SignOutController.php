<?php

namespace App\Http\Controllers;

use App\Analytics;

class SendmailController extends Controller {

    public function index() {
        $title = "Sign Out";
        
        $analytics = new Analytics();
        $analytics->recordView("signout");
        
        session_start();
        session_destroy();
        $_SESSION = array();
        
        return view("signout");
    }

}
