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
                $stmt->close();
                if (password_verify($password, $dbpassword)) {
                    header("Location: /php/Homepage.php");
                    exit();
                } else {
                    echo 'alert("Tên người dùng hoặc mật khẩu không đúng.");';
                    header("Refresh:0");
                }
            } else {
                echo 'alert("Tên người dùng hoặc mật khẩu không đúng.");';
                header("Refresh:0");
            }
        } 
        session_start();
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
                $stmt->close();
                if (password_verify($password, $dbpassword)) {
                    header("Location: /php/Homepage.php");
                    exit();
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
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" minlength="10" maxlength="10" id="phone" name="phone" pattern="^0.*[0-9].*" title="phone number is not true" required>
                </div>
                <div class="form-group">
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
</body>


</html>