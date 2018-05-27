<?php

namespace App;

use Request;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer {

    //There's probably a framework specific way to do this. Will investigate in the future.
    //For now, this will have to do

    public function mailAdmin($subject, $message) {
        // uncomment to disable mailing
        //if (Request::ip() === "::1") {
        //    // don't send locally.
        //    echo "attempted to send mail locally";
        //    return;
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // increment to 2 for more detailed information
        $mail->IsSMTP();
        $mail->CharSet = 'utf-8';
        $mail->Host = env('MAIL_HOST');
        $mail->Port = env('MAIL_PORT');
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->setFrom(config("constants.ADMINEMAIL"), "Robert");
        $mail->addAddress(config("constants.ADMINEMAIL"), "Robert");
        if (!$mail->send()) {
            // TODO LOG ERROR
        }
    }
}
