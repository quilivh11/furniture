<?php
include("dbcon.php");
try {
    $user = $auth->getUser($username);
    if ($user->emailVerified) {
        header("Location: /resetpass.php");
        exit;
   
        // echo 'Hi, ';
        // echo $username;
        // echo 'Please check your email to change your password.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

