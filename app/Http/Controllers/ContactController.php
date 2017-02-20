<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analytics;

class ContactController extends Controller {

    public function index() {
        $title = "Leave Me a Message";
        $analytics = new Analytics();
        $analytics->recordView();

        return view("contact", ["title" => $title]);
    }

}

