<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller {

    public function index() {
        $title = "Leave Me a Message";

        return view("contact", ["title" => $title]);
    }

}
