<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" href="/Image/icon.png"> -->
    <title>Sign up</title>
    <link rel="stylesheet" href="/css/Account.css">
</head>

<body>
    <div class="login-container">
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
                    <input type="password" id="password" name="password" pattern=".*[A-Z].*[!@#$%^].*"  minlength="8" maxlength="16" title="Password must contain at least one special character" required>
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
                    <input type="submit" value="Sign up" required>
                </div>
            </form>
            
        </div>
    </div>
    <scrip>
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
            $username = $_POST["email"];
            $password = $_POST["password"];
            $cfpassword = $_POST["cfpassword"];
            $stmt = $conn->prepare("SELECT username FROM accounts WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                echo '<script>alert("Already exist. Please try another Email!");</script>';
                // header("Refresh:0");
            } else {
                if ($cfpassword !== $password) {
                    echo '<script>alert("Confirm password not match. Please try again!");</script>';
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $insertAccountStmt = $conn->prepare("INSERT INTO accounts (username, password) VALUES (?, ?)");
                    $insertAccountStmt->bind_param("ss", $username, $password);
                    if ($insertAccountStmt->execute()) {
                        echo '<script>';
                        echo 'alert("Sign up Successfully");';
                        echo 'setTimeout(function(){ window.location = "/php/Homepage.php"; }, 1000);';
                        echo '</script>';
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["password"] = $password;
                    } else {
                        echo '<script>alert("Opps. Try again!");</script>';
                    }
                    $insertStudentStmt->close();
                }
            }
        }
        $conn->close();
        ?>
    </scrip>

</body>

</html>