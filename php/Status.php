<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel="icon" href="/Image/icon.png"> -->
    <title>Status</title>
    <link rel="stylesheet" href="/css/Account.css">
</head>

<body>
    <h1>Please check your email for verify</h1>
    <p>Click Reload after you was verify your email</p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mã JavaScript của bạn ở đây
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

        function checkEmailVerificationStatus() {
            // Lấy email từ Session
            var registeredEmail = sessionStorage.getItem('registeredEmail');

            if (registeredEmail) {
                // Kiểm tra trạng thái xác thực của email từ Firebase
                firebase.auth().onAuthStateChanged(function(user) {
                    if (user) {
                        if (user.email === registeredEmail) {
                            if (user.emailVerified) {
                                console.log("Email has been verified.");
                                window.location.href = "/php/Homepage.php";
                                
                            } else {
                                console.log("Email has not been verified yet.");
                            }
                        } else {
                            console.log("User is not associated with the registered email.");
                        }
                    } else {
                        console.log("User is not logged in.");
                    }
                });
            } else {
                console.log("No registered email found in the session.");
            }
        }

        // Gọi hàm kiểm tra trạng thái khi tải trang status
        checkEmailVerificationStatus();
    });
</script>

</body>

</html>