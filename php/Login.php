<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["phone"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $dbpassword = $row['password'];
        if (password_verify($password, $dbpassword)) {
            $stmt = $conn->prepare("SELECT username FROM employees WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                header("Location: /php/Admin.php");
            } else {
                header("Location: /php/Homepage.php");
                exit();
            }
        } else {
    //         echo "<script>
    //         function Menu() {
    //             setTimeout(function() {
    //                 var option = document.querySelector('.popup');
    //                 option.classList.add('visible');
    //             }, 200);
    //             option.classList.add('hidden');
    //             var button = document.querySelector('#gotit');
    //             button.classList.toggle('roll');
    //         }   
    //         Menu(); 
    // </script>";
    echo "Wrong password!";
        }
    
    } else {
        echo "The user not exist!";
    }
}
if (!empty($_SESSION)) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
}
$stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $dbpassword = $row['password'];
    if (password_verify($password, $dbpassword)) {
        $stmt = $conn->prepare("SELECT username FROM employees WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            header("Location: /php/Admin.php");
        } else {
            header("Location: /php/Homepage.php");
            exit();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" href="/Image/icon.png"> -->
    <title>Sign in</title>
    <link rel="stylesheet" href="/css/Account.css">
</head>

<body>
    <div class="login-container">
        <div class="form">
            <img id="imglogo" src="/images/LoGoMinhTam_preview_rev_1.png" alt="img1">
            <h2>Sign in to the system</h2>
            <p>Please input information!</p>

            <form id="form" action="/php/Login.php" method="post">
                <div class="form-group" id="num">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" minlength="10" maxlength="10" id="phone" name="phone" pattern="^0.*[0-9].*" title="phone number is not true" required>
                </div>
                <div class="form-group" id="pass">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <a id="fs" href="/php/Forgot.php">Forgetten password?</a><a> or </a><a href="/php/Signup.php" id="fs">Sign up</a>
                </div>
                <div class="form-group">
                    <input type="submit" value="Sign in">
                </div>
            </form>
        </div>
        <div class="intro">
            <h1 class="wc">Welcome to the furnature shop</h1>
            <p>The best shop about furnature top 1 Viet Nam</p>
            <img id="cc" src="/images/cua-cuon-sieu-truong-st100-16-8737.png" alt="scrolling door">
        </div>
    </div>
    <div class="popup">
        <!-- <div id="popup" > -->
        <h1>X</h1>
        <p>Wrong password</p>
        <button id="gotit">Got it</button>
        <!-- </div> -->
    </div>
</body>

</html>