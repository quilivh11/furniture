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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyB2vZtKgqWTEZctENNfXgovE9vuUIRFSDI",
            authDomain: "verify-shop.firebaseapp.com",
            projectId: "verify-shop",
            storageBucket: "verify-shop.appspot.com",
            messagingSenderId: "185499960946",
            appId: "1:185499960946:web:139f44e65a4d356d5ca4eb",
            measurementId: "G-7B62FQKH3W"
        };
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();

        var signupbtn = document.getElementById("signupbtn")
        var emailsignup = document.getElementById("email")
        var passswordsignup = document.getElementById("password")
        signupbtn.onclick = function() {
            signupbtn.disabled = true;
            signupbtn.textContent = "Registering Your Account! ";
            firebase.auth().createUserWithEmailAndPassword(emailsignup.value, passswordsignup.value).then(function(response) {
                    sendingVerifyEmail(signupbtn);
                    console.log(response);
                })
                .catch(function(error) {
                    signupbtn.disabled = false;
                    signupbtn.textContent = "Sign Up";
                    console.log(error);
                })

        }

        function sendingVerifyEmail(button) {
            firebase.auth().currentUser.sendEmailVerification().then(function(response) {

                    signupbtn.textContent = "Please check your email";
                    signupbtn.disabled = true;
                    sessionStorage.setItem('registeredEmail', emailsignup.value);
                    console.log(response);
                    window.location.href = "/php/status.php";
                })
                .catch(function(error) {
                    signupbtn.disabled = false;
                    signupbtn.textContent = "Sign up";
                    console.log(error);
                })
        }
    </script>
</body>

</html>