<?php

namespace App\Http\Controllers;

use App\Analytics;
use App\Project;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    private function loggedIn() {
        // returns true or false depending on if somebody is logged in
        if (null !== session('user')) {
            return true;
        }
        return false;
    }

    private function checkLogIn() {
        // if not logged in and trying to access a critical page, go to sign in page
        if (!$this->loggedIn()) {
            header('Location: signin');
            die();
        }
    }

    private function logAnalytics($pageName) {
        // Logs pageview to analytics
        $analytics = new Analytics();
        $analytics->recordView($pageName);
    }

    public function index() {
        $this->checkLogIn();
        return $this->admindashboard();
    }

    public function admindashboard() {
        $this->checkLogIn();
        $pagename = "admin";
        $this->logAnalytics($pagename);
        //return $this->signin();
        return $this->project();
    }

    private function projectcreate() {
        $this->checkLogIn();
        return view("newproject");
    }

    public function project() {
        $this->checkLogIn();
        if (Input::has('title') && Input::has('description')) {
            $title = Input::get('title');
            $codeLink = "";
            if (Input::has('code-link')) {
                $codeLink = Input::get('code-link');
            }
            $projectLink = "";
            if (Input::has('project-link')) {
                $projectLink = Input::get('project-link');
            }
            $description = Input::get('description');
            $project = new Project();
            $project->create($projectLink, $codeLink, $title, $description);
            return $this->projectcreate();
        } else {
            return $this->projectcreate();
        }
    }

    private function projectviewall() {
        $this->checkLogIn();
        $projects = Project::all();
        echo view("partials.admineditheader");
        foreach ($projects as $thisProject) {
            echo view("partials.projectedit", $thisProject->getViewData());
        }
        return view("partials.admineditfooter");
    }

    public function signout() {
        $this->checkLogIn();
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
        $this->checkLogIn();
        $sessionMinutes = ini_get('session.gc_maxlifetime') / 60;
        return view("signedin", compact("sessionMinutes"));
    }

}
