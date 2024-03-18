<?php
include("dbcon.php");
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];

try {
    $user = $auth->getUserByEmail($username);
    if ($user->emailVerified) {
        echo 'Email is verified';
        $status = "active";

        $insertAccountStmt = $conn->prepare("UPDATE accounts SET status = ? WHERE username = ?");
        $insertAccountStmt->bind_param("ss", $status, $username);
        if ($insertAccountStmt->execute()) {
            $insertAccountStmt = $conn->prepare("INSERT INTO customer (username) VALUES (?)");
            $insertAccountStmt->bind_param("s",$username);
            if ($insertAccountStmt->execute()) {
            header("Location: /php/Homepage.php");
            }else{
                echo 'Email is not verified';
            }
           
        }
    } else {
        echo 'Hi,';
        echo $username;
        echo '</br></br>';
        echo'Please check your email to complete! After that comeback and reload this page';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
