<?php
include("/verify/dbcon.php");

if(isset($_POST['signupbtn'] )){
    $username = $_POST['email'];
    $password = $_POST['password'];
    // $status = "disable";
    $userProperties = [
        'email' => $username,
        'emailVerified' => false,
        // 'phoneNumber' => '+84' $phone,
        'password' => 'secretPassword', 
        // 'displayName' => 'John Doe',
        // 'photoUrl' => 'http://www.example.com/12345678/photo.png',
        'disabled' => false,
    ];
    $createdUser = $auth->createUser($userProperties);
    if($createdUser){
        $_SESSION['status'] = " Create successfully!";
        $auth->sendEmailVerificationLink($username);
        header("Location: /php/status.php");
        exit();
        
    }else{
        $_SESSION['status'] = " Create not successful!";
        header("Location: register.php");
        exit();
    }
}
