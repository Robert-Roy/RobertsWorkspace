<?php

namespace App\Http\Controllers;

use App\Analytics;
use App\Project;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    private function logAnalytics($pageName) {
        $analytics = new Analytics();
        $analytics->recordView($pageName);
    }

    public function index() {
        if (null !== session('user')) {
            return $this->admindashboard();
        } else {
            return $this->signIn();
        }
    }

    public function admindashboard() {
        $pagename = "admin";
        $this->logAnalytics($pagename);

        $projects = Project::all();
        echo view("partials.admineditheader");
        foreach ($projects as $thisProject) {
            echo view("partials.projectedit", $thisProject->getViewData());
        }
        return view("partials.admineditfooter");
        //return $this->signin();
    }

    public function signout() {
        $pagename = "signout";
        $this->logAnalytics($pagename);

        session()->flush();

        return view("signout");
    }

    public function signin() {
        $pagename = "signin";
        $this->logAnalytics($pagename);

        session_start();
        if (null !== session('user')) {
            // if already logged in
            return $this->signedin();
        } else if (Input::has('username') && Input::has('pw')) {
            // if login attempt
            $username = Input::get('username');
            $pass = Input::get('pw');
            if (Auth::attempt(array('name' => $username, 'password' => $pass))) {
                session(['user' => $username]);
                return $this->signedin();
            } else {
                $message = "Invalid Login. Please try again.";
                return view("signin", compact("message"));
            }
        } else {
            // if first accessing the login page
            $message = "";
            return view("signin", compact("message"));
        }
    }

    private function signedin() {
        $sessionMinutes = ini_get('session.gc_maxlifetime') / 60;
        return view("signedin", compact("sessionMinutes"));
    }

}
