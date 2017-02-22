<?php

namespace App;

use Request;

class Mailer {

    //There's probably a framework specific way to do this. Will investigate in the future.
    //For now, this will have to do
    
    public function mailAdmin($subject, $message){
        if(Request::ip() === "::1"){
            echo "attempted to send mail locally";
        }
        mail(config('constants.ADMINEMAIL'), $subject, $message, "From: <".config('constants.ADMINEMAIL').">");
    }
    

}
