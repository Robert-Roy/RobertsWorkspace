<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analytics;

class GithubController extends Controller {

    public function index() {
        $analytics = new Analytics("github");
        $analytics->recordView();
        //It would be possible to use post to have several different redirects in one
        //file.
        header('Location: https://github.com/robert-roy');
        die();
    }

}
