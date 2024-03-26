<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $insertAccountStmt = $conn->prepare("UPDATE accounts SET password = ? WHERE username = ?");
    $insertAccountStmt->bind_param("ss", $password, $username);
    if ($insertAccountStmt->execute()) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        header("Location: /Sucess.php");
    }
    $insertAccountStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/css/Account.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="login-container" id="login-container">
        <div class="form">
            <img id="imglogo1" src="/images/LoGoMinhTam_preview_rev_1.png" alt="img1">
            <h2>Final Step</h2>
            <p>Please complete for get your account back!</p>

            <form id="form" method="post" style="text-align: center; width: 60%; margin: auto; max-width: 500px; ">
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" pattern=".*[A-Z].*[!@#$%^&*()-=_+{}[];':.,/<>?`~].*" minlength="8" maxlength="16" title="Password must contain at least one UPPERCASE and special character" required>
                </div>
                <div class="form-group">
                    <label for="cfpassword">Confirm Password:</label>
                    <input type="password" id="cfpassword" name="cfpassword" title="The confirm password not match" required>
                </div>
                <div class="form-group">
                    <button type="submit" id="signupbtn" name="signupbtn" required>Change Password</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>