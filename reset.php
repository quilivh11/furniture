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
    $code = $_POST['code'];
    $stmt = $conn->prepare("SELECT otpcode FROM verify WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $otpcode = $row['otpcode'];
        if ($code === $otpcode) {
            $insertAccountStmt = $conn->prepare("UPDATE verify SET otpcode = NULL WHERE username = ?");
            $insertAccountStmt->bind_param("s", $username);
            if ($insertAccountStmt->execute()) {
                
                header("Location: /resetpass.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/css/Account.css">
<title>Status</title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="login-container" id="login-container">
        <div class="form">
            <img id="imglogo1" src="/images/LoGoMinhTam_preview_rev_1.png" alt="img1">
            <h2>Sent code!</h2>
            <form id="form" method="post" style="text-align: center; width: 60%; margin: auto; max-width: 500px; ">
                <div class="form-group">
                    <label for="code">Please check your email:</label>
                    <input type="number" id="code" name="code" placeholder="OTP code" required>
                </div>
                <div class="form-group">
                    <button type="submit" id="signupbtn" name="signupbtn" required>Change Password</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>