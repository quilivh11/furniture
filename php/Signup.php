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
                    <label for="phone">Phone number:</label>
                    <input type="tel" id="phone" name="phone" maxlength="10" pattern="^0.*[0-9].*" title="phone number is not true" minlength="10" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" pattern=".*[A-Z].*[!@#$%^].*"  minlength="8" maxlength="16" title="Password must contain at least one special character" required>
                </div>
                <div class="form-group">
                    <label for="cfpassword">Confirm Password:</label>
                    <input type="password" id="cfpassword" name="cfpassword" required>
                </div>
                <div class="form-group" id="formget" >
                    <label for="verifier">Verify code:</label>
                    <input type="number" id="verifier" name="verifier" onKeyPress="if(this.value.length==6) return false;"required>
                    <button type="button" id="sender" >Get code</button>
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
            $username = $_POST["phone"];
            $password = $_POST["password"];
            $cfpassword = $_POST["cfpassword"];
            $stmt = $conn->prepare("SELECT username FROM accounts WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                echo '<script>alert("Already exist. Please try another Phone number!");</script>';
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
    
<script>
    // Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyB2vZtKgqWTEZctENNfXgovE9vuUIRFSDI",
  authDomain: "verify-shop.firebaseapp.com",
  projectId: "verify-shop",
  storageBucket: "verify-shop.appspot.com",
  messagingSenderId: "185499960946",
  appId: "1:185499960946:web:139f44e65a4d356d5ca4eb",
  measurementId: "G-7B62FQKH3W"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

function render(){
    window.recaptchaVerifier = new firebase.auth.recaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
function phoneAuth(){
    var number = document.getElementById('phone')
    firebase.auth(),signInWithPhoneNumber(number,window.recaptchaVerifier).then(function(confirmationResult){
        coderesult =confirmationResult;
        // document.getElementById()
    })
}
</script>
</body>

</html>