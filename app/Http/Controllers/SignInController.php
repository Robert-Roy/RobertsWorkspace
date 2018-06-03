<?php

namespace App\Http\Controllers;

use App\Analytics;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller {

    public function index() {
        $title = "Sign In";

        $analytics = new Analytics();
        $analytics->recordView("signin");

        session_start();
        if (null !== session('user')) {
            // if already logged in
            $sessionMinutes = ini_get('session.gc_maxlifetime') / 60;
            return view("signedin", compact("sessionMinutes"));
        } else if (Input::has('username') && Input::has('pw')) {
            // if login attempt
            $username = Input::get('username');
            $pass = Input::get('pw');
            $hashedPass = Hash::make($pass);
            if (Auth::attempt(array('name'=> $username, 'password' => $pass))){
                session(['user' => $username]);
                return view("signedin", compact($sessionMinutes));
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
}