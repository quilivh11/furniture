<!-- <?php
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
    $_SESSION["username"] = $username;
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
        $insertAccountStmt = $conn->prepare("UPDATE accounts SET password = ? WHERE username = ?");
        $insertAccountStmt->bind_param("ss", $password, $username);
        if ($insertAccountStmt->execute()) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("Location: /php/Homepage.php");
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
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" pattern=".*[A-Z].*[!@#$%^].*" minlength="8" maxlength="16" title="Password must contain at least one special character" required>
                </div>
                <div class="form-group">
                    <label for="cfpassword">Confirm Password:</label>
                    <input type="password" id="cfpassword" name="cfpassword" required>
                </div>
                <div class="form-group">
                    <button type="submit" id="signupbtn" name="signupbtn" required>Change Password</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html> -->
<?php
include("dbcon.php");

if(isset($_POST['signupbtn'] )){
    $username = $_POST['email'];
    $password = $_POST['password'];
    // $status = "disable";
    $userProperties = [
        // 'email' => $username,
        // 'emailVerified' => false,
        'phoneNumber' => '+84'+ $phone,

        'password' => 'secretPassword', 
        // 'displayName' => 'John Doe',
        // 'photoUrl' => 'http://www.example.com/12345678/photo.png',
        'disabled' => false,
    ];
    $createdUser = $auth->createUser($userProperties);
    if($createdUser){
        $_SESSION['status'] = " Create successfully!";
        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        } catch (Exception $e) {
            echo 'The token is invalid: '.$e->getMessage();
        }
        
        $uid = $verifiedIdToken->claims()->get('sub');
        
        $user = $auth->getUser($uid);
    }else{
        $_SESSION['status'] = " Create not successful!";
        header("Location: register.php");
        exit();
    }
}
