<?php
session_start();
include('dbcon.php');

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];
    $status = "disable";
    $password = password_hash($password, PASSWORD_DEFAULT);
        $insertAccountStmt = $conn->prepare("INSERT INTO accounts (username, password,status) VALUES (?, ?, ?)");
        $insertAccountStmt->bind_param("sss", $username, $password,$status);
        if ($insertAccountStmt->execute()) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $user = [
                'username' => $username,
                'password' => $password,
                'status' => $status
            ];
            $newUser = $database->getReference('users')->push($user);
        
            if ($newUser) {
                include("verify.php");
            } else {
            }
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
            <h2>Sign in to the system</h2>
            <p>Please input information!</p>

            <form id="form" method="post" style="text-align: center; width: 60%; margin: auto; max-width: 500px; " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" pattern=".*[A-Z].*[!@#$%^].*" minlength="8" maxlength="16" title="Password must contain at least one special character" required>
                </div>
                <div class="form-group">
                    <label for="cfpassword">Confirm Password:</label>
                    <input type="password" id="cfpassword" name="cfpassword" required>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="ok" required>
                    <label for="ok" id="ok">I agree to all <a id="fs" href="/php/privacy.php">privacy policies</a></label>
                </div>
                <div class="form-group">
                    <button type="submit" id="signupbtn" name="signupbtn" required>Sign up</button>
                    <a href="/php/Login.php">Already have an account? Click here</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>