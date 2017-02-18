<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        $title = "<div style='display:inline-block'>Web Development</div> <div style='display:inline-block'>Done Right</div>";

        return view("home", ["title" => $title]);
    }

}
