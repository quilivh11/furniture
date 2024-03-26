<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "store";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if (!empty($_SESSION)) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    // echo $username;
    // echo $password;
    $stmt = $conn->prepare("SELECT username FROM employees WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        header("Location: /php/Admin.php");
    }else{
        echo "<script>
            function Menu() {
                var option = document.querySelector('.optionlogged');
                option.classList.toggle('visible');
                var button = document.querySelector('.menubtn');
                button.classList.toggle('roll');
            }
            </script>";
    }
    
}else {
    echo "<script>
    function Menu() {
        var option = document.querySelector('.option');
        option.classList.toggle('visible');
        var button = document.querySelector('.menubtn');
        button.classList.toggle('roll');
    }
    </script>";
}
   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/homepage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>

<body>
    <!-- header -->
    <div class="header">
        <!-- <img class="cover" alt="" src="/images/group-1@2x.png" /> -->
        <img class="logo" alt="" src="/images/rectangle-17@2x.png" />
        <!-- <img class="shopicon" alt="" src="/images/vector.svg"> -->
        <div class="menu">
            <button class="menubtn" onclick="Menu()">|||</button>
        </div>
    </div>
    <div class="product">
        <a href="/php/Homepage.php" id="link">
            <button id="optionbar">Home</button>
        </a>
        <a href="/php/Homepage.php" id="link">
            <button id="optionbar">Branch</button>
        </a>
        <a href="/php/Homepage.php" id="link">
            <button id="optionbar">Contact</button>
        </a>
        <a href="/php/Homepage.php" id="link">
            <button id="optionbar">About us</button>
        </a>
        <a id="searchbox" class="searchbox">
            <input type="search" class="font" id="optionbar" class="search" placeholder="Find something here...">
        </a>
        <a href="#" class="searchicon">
            <img src="/images/search.png" id="searchicon" style="color: blue;">
        </a>
    </div>
    <div class="option">
        <a href="/php/Login.php" class="link">
            <button id="optionbtn">Sign in</button>
        </a>
        <a href="/register.php" class="link">
            <button id="optionbtn">Sign up</button>
        </a>
    </div>
    <div class="optionlogged">
        <h1>Hi user, <?php echo "$username"; ?>!</h1>
        <a href="/php/Login.php  " class="link">
            <button id="optionbtn">Account</button>
        </a>
        <a href="/php/destroyss.php" class="link">
            <button id="optionbtn">Log out</button>
        </a>
    </div>
    <div>
        <h1>All product</h1>
        <!-- <?php
        $vd = 0;
        $stmt = $conn->prepare("SELECT PName,prices,image,validproduct FROM product WHERE validproduct > ?");
        $stmt->bind_param("s", $vd);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            if ($result->num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $rows = array_reverse($rows);
                foreach ($rows as $row) {
                    echo "<div class='productform'>";
                    echo "<div class='imgsize'><img id='imgsize' src='/images/" . $row["image"] . "' ></div>";
                    echo "<div class='priceform'>";
                    echo "<p class = 'pdname' >" . $row["PName"] . "</p>";
                    echo "<p class = 'pnum'>" . $row["prices"] . " VND</p>";
                    echo "<p>Available: " . $row["validproduct"] . "</p>";
                    echo "<p><button class='minus'>-</button><input type='text' class='numberss' value='0'><button class='plus'>+</button></p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        } else {
            echo "Dont have valid product";
        }
        $conn->close();
        ?> -->
        

    </div>
    <!-- <div>
        <a href="#" >
            <img src="/images/cart.png" id="cart" >
        </a>
    </div> -->
</body>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var plusButtons = document.querySelectorAll('.plus');
        var minusButtons = document.querySelectorAll('.minus');
        var inputFields = document.querySelectorAll('.numberss');

        plusButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var inputField = this.previousElementSibling;
                var currentValue = parseInt(inputField.value);
                var newValue = currentValue + 1;
                inputField.value = newValue;
            });
        });

        minusButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var inputField = this.nextElementSibling;
                var currentValue = parseInt(inputField.value);
                var newValue = Math.max(currentValue - 1, 0);
                inputField.value = newValue;
            });
        });
    });
</script> -->
</html>