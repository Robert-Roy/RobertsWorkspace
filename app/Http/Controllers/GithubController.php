<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GithubController extends Controller {

    public function index() {
        //It would be possible to use post to have several different redirects in one
        //file.
        header('Location: https://github.com/robert-roy');
        die();
    }

}
