<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/signup.css">
    <title>Sign up</title>
</head>
<body>
    <div id="logreg-forms">
        <form class="form-signin" accept="#">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            
            <button class="btn btn-success btn-block" id="loginbtn" type="button"><i class="fas fa-sign-in-alt"></i> Sign in</button>

            <p style="text-align:center"> OR  </p>
            <input type="text" id="inputPhone" class="form-control" placeholder="PHONE" required="" autofocus="">
            <div id="recaptcha-container"></div>
            <button class="btn btn-success btn-block" type="button" id="phoneloginbtn"><i class="fas fa-sign-in-alt"></i> SEND OTP</button>
            <input type="otp" id="inputOtp" class="form-control" placeholder="OTP" required="">
            <button class="btn btn-success btn-block" type="button" id="verifyotp"><i class="fas fa-sign-in-alt"></i> VERIFY OTP</button>
            


            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
            </form>

            <form action="/reset/password/" class="form-reset">
                <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            
            <form action="#" class="form-signup">

                <input type="email" id="useremail" class="form-control" placeholder="Email address" required autofocus="">
                <input type="password" id="userpass" class="form-control" placeholder="Password" required autofocus="">

                <button class="btn btn-primary btn-block" type="button" id="signupbtn"><i class="fas fa-user-plus"></i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <br>
            
    </div>
    <script>
function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
});

</script> 
    
    </p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>


<script>
  // Your web app's Firebase configuration
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
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  var signupbtn=document.getElementById("signupbtn")
  var emailsignup=document.getElementById("useremail")
  var passswordsignup=document.getElementById("userpass")


  //================Signup With Email and Password==========================
  signupbtn.onclick=function(){
      signupbtn.disabled=true;
      signupbtn.textContent="Registering Your Account! Please Wait";
      firebase.auth().createUserWithEmailAndPassword(emailsignup.value,passswordsignup.value).then(function(response){
        sendingVerifyEmail(signupbtn);
            console.log(response);
      })
      .catch(function(error){
        signupbtn.disabled=false;
        signupbtn.textContent="Sign Up";
          console.log(error);
      })


  }

  function sendingVerifyEmail(button){
     firebase.auth().currentUser.sendEmailVerification().then(function(response){
                signupbtn.disabled=false;
        signupbtn.textContent="Sign Up S";

        console.log(response);
     })
     .catch(function(error){
                signupbtn.disabled=false;
        signupbtn.textContent="Sign Up S";

         console.log(error);
     })
  }
  //================End Signup With Email and Password======================

  //==========================Sign in With Email and Password============================

   var loginemail=document.getElementById("inputEmail");
   var loginpassword=document.getElementById("inputPassword");
   var loginbtn=document.getElementById("loginbtn");


   loginbtn.onclick=function(){
    loginbtn.disabled=true;
    loginbtn.textContent="Logging In Please Wait.."
       firebase.auth().signInWithEmailAndPassword(loginemail.value,loginpassword.value).then(function(response){
           console.log(response);
           loginbtn.disabled=false;
    loginbtn.textContent="Sign In"
            var userobj=response.user;
            var token=userobj.xa;
            var provider="email";
            var email=loginemail.value;
            if(token!=null && token!=undefined && token!=""){
            sendDatatoServerPhp(email,provider,token,email);
            }
       })
       .catch(function(error){
           console.log(error);
           loginbtn.disabled=false;
        loginbtn.textContent="Sign In"

       })
   }
  //======================Sign With Email and Password


   //===================Saving Login Details in My Server Using AJAX================
   function sendDatatoServerPhp(email,provider,token,username){
       
        var xhr = new XMLHttpRequest();
        //xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            console.log(this.responseText);
            if(this.responseText=="Login Successfull" || this.responseText=="User Created"){
                alert("Login Successfull");
                location='/php/HomePage.php';
            }
            else if(this.responseText=="Please Verify Your Email to Get Login"){
                alert("Please Verify Your Email to Login")
            }
            else{
                alert("Error in Login");
            }
        }
        });

        xhr.open("POST", "http://localhost/firebase/auth/login.php?email="+email+"&provider="+provider+"&username="+username+"&token="+token);
        xhr.send();
   }
   //===========================End Saving Details in My Server=======================
   //=========================Login With Phone==========================
   var loginphone=document.getElementById("phoneloginbtn");
   var phoneinput=document.getElementById("inputPhone");
   var otpinput=document.getElementById("inputOtp");
   var verifyotp=document.getElementById("verifyotp");

   loginphone.onclick=function(){
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': function(response) {
        },
        'expired-callback': function() {
        }
        });

        var cverify=window.recaptchaVerifier;

        firebase.auth().signInWithPhoneNumber(phoneinput.value,cverify).then(function(response){
            console.log(response);
            window.confirmationResult=response;
        }).catch(function(error){
            console.log(error);
        })
   }

   verifyotp.onclick=function(){
       confirmationResult.confirm(otpinput.value).then(function(response){
           console.log(response);
            var userobj=response.user;
            var token=userobj.xa;
            var provider="phone";
            var email=phoneinput.value;
            if(token!=null && token!=undefined && token!=""){
            sendDatatoServerPhp(email,provider,token,email);
            }
       })
       .catch(function(error){
           console.log(error);
       })
   }
   //=================End Login With Phone=========================

   ///=================Login With google===========================
   var googleLogin=document.getElementById("googleLogin");

   googleLogin.onclick=function(){
       var provider=new firebase.auth.GoogleAuthProvider();

       firebase.auth().signInWithPopup(provider).then(function(response){
           var userobj=response.user;
            var token=userobj.xa;
            var provider="google";
            var email=userobj.email;
            if(token!=null && token!=undefined && token!=""){
            sendDatatoServerPhp(email,provider,token,userobj.displayName);
            }

           console.log(response);
       })
       .catch(function(error){
           console.log(error);
       })


   }
   //=======================End Login With Google==================
   //======================Login With Facebook==========================
   var facebooklogin=document.getElementById("facebooklogin");
   facebooklogin.onclick=function(){
    var provider=new firebase.auth.FacebookAuthProvider();

firebase.auth().signInWithPopup(provider).then(function(response){
    var userobj=response.user;
     var token=userobj.xa;
     var provider="facebook";
     var email=userobj.email;
     if(token!=null && token!=undefined && token!=""){
     sendDatatoServerPhp(email,provider,token,userobj.displayName);
     }

    console.log(response);
})
.catch(function(error){
    console.log(error);
})


   }
   //======================End Login With Facebook==========================
</script>
</body>
</html>