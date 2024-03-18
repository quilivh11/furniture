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
    $username = $_POST['email'];
    $stmt = $conn->prepare("SELECT username FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $stmt = $conn->prepare("SELECT username FROM verify WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $stmt = $conn->prepare("SELECT username FROM verify WHERE username = ? AND otpcode IS NULL");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $_SESSION["username"] = $username;
                include('phpmailer.php');
            } else {
                echo '<script> alert("Please check your email");</script>';
                header("Location: /reset.php");
            }
        }else{
            $insertAccountStmt = $conn->prepare("INSERT INTO verify (username) VALUES (?)");
            $insertAccountStmt->bind_param("s",$username);
            if ($insertAccountStmt->execute()) {
                include('phpmailer.php');
            }else{
                echo 'Please reload!';
            }
        }
       
    } else {
        echo 'Email is never Sign up yet';
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/css/Account.css">
<title>Recovery</title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="login-container" id="login-container">
        <div class="form">
            <img id="imglogo1" src="/images/LoGoMinhTam_preview_rev_1.png" alt="img1">
            <h2>Recovery</h2>
            <p>Please input information!</p>

            <form id="form" method="post" style="text-align: center; width: 60%; margin: auto; max-width: 500px; " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <button type="submit" id="signupbtn" name="signupbtn" required>Submit</button>
                    <a href="/register.php">Dont have an account? Click here</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>