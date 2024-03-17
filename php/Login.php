<?php
sleep(1);
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $dbpassword = $row['password'];
        if (password_verify($password, $dbpassword)) {
            $stmt = $conn->prepare("SELECT username FROM employees WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                sleep(1);
                header("Location: /php/Admin.php");
                exit();
            } else {
                sleep(1);
                header("Location: /php/Homepage.php");
                exit();
            }
        } else {
            echo "<script>
            function show() {
                setTimeout(function() {
                    var option = document.querySelector('.popup');
                    option.classList.add('visible');
                }, 200);
            }   
            show(); 
            function hide(){    
                var button = document.querySelector('.popup');
                button.classList.add('hidden');
            }
    </script>";
        }
    } else {
        echo "<script>
            function show() {
                setTimeout(function() {
                    var option = document.querySelector('.popup1');
                    option.classList.add('visible');
                }, 200);
            }   
            show(); 
            function hide(){    
                var button = document.querySelector('.popup1');
                button.classList.add('hidden');
            }
    </script>";
    }
}
if (!empty($_SESSION)) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
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
                exit();
            } else {
                header("Location: /php/Homepage.php");
                exit();
            }
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
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email"  required>
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
        <h1>X</h1>
        <p>Wrong password</p>
        <button onclick="hide()" id="gotit">Got it</button>
    </div>
    <div class="popup1">
        <h1>X</h1>
        <p>The user not exist</p>
        <button onclick="hide()" id="gotit">Got it</button>
    </div>
</body>

</html>