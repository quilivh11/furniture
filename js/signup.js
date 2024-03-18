
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