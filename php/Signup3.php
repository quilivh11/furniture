<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" href="/Image/icon.png"> -->
    <title>Sign up</title>
    <link rel="stylesheet" href="/css/Account.css">
</head>

<body>
    <div class="login-container" id="login-container">
        <div class="form">
            <img id="imglogo1" src="/images/LoGoMinhTam_preview_rev_1.png" alt="img1">
            <h2>Sign in to the system</h2>
            <p>Please input information!</p>

            <form id="form" method="post" style="text-align: center; width: 60%; margin: auto; max-width: 500px; ">
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
                    <button type="submit" id="signupbtn" required>Sign up</button>
                </div>
            </form>

        </div>
    </div>
    
    <script>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "store";
        session_start();
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = "disable";
        $username = $_POST["email"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $insertAccountStmt = $conn->prepare("INSERT INTO accounts (username, password,status) VALUES (?, ?, ?)");
        $insertAccountStmt->bind_param("sss", $username, $password,$status);
        if ($insertAccountStmt->execute()) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
        }
        $insertAccountStmt->close();
        }
        
        ?>

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
    <script defer  src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>
    <script src='/js/signup.js' ></script>
</body>

</html>