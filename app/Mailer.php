<?php

namespace App;

use Request;

class Mailer {

    //There's probably a framework specific way to do this. Will investigate in the future.
    //For now, this will have to do

    public function mailAdmin($subject, $message) {
        if (Request::ip() === "::1") {
            // don't send locally.
            echo "attempted to send mail locally";
        } else {
           // mail(config('constants.ADMINEMAIL'), $subject, $message, "From: <" . config('constants.ADMINEMAIL') . ">");
        }
    }

}
