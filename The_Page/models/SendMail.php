<?php

require_once 'Config.php';

/**
 * Using PHPMailer class
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Load Composer's autoloader
 */
require '../vendor/autoload.php';

class SendMail extends Config
{
    /**
     * Send Email Using PHPMailer 
     *
     * @param string $to         Recipient email
     * @param string $subject    Email subject
     * @param string $message    Email body
     * @param string $attachment Email attachment
     * @param array  $cc         Email Carbon Copy
     *
     * @return bool              True or false
     */
    public function sendMailSMTP(
        $to,
        $subject,
        $message,
        $attachment = null,
        $cc = array()
    ) {

        $retval = true;

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;  // enables SMTP debug information (for testing)
        if (CONFIG::EMAIL_SMTP_METHOD == "yes") {
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true;    // enable SMTP authentication
            //$mail->SMTPSecure = "tls"; // sets the prefix to the servier
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = CONFIG::SYSTEM_EMAIL_HOST;
            $mail->Port = CONFIG::SYSTEM_PORT_NO;
            $mail->Username = CONFIG::SYSTEM_EMAIL_ID;
            $mail->Password = CONFIG::SYSTEM_EMAIL_PASSWORD;
        }

        $mail->SetFrom(
            CONFIG::SYSTEM_EMAIL_ID,
            CONFIG::SYSTEM_EMAIL_SENDER_NAME
        );

        if (count($cc) > 0) {

            foreach ($cc as $p) {
                $mail->AddBCC($p);
            }
        } else {
            $mail->AddAddress($to);
        }

        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($message);

        //send the message, check for errors
        try {
            $mail->send();
        } catch (Exception $ex) {
            $retval = false;
            // die($ex->getMessage());
            die("Error: Something went wrong!");
        }
        return $retval;
    }
}
