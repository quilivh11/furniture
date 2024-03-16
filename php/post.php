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
}
$stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    echo "<script>
    function Menu() {
        var option = document.querySelector('.optionlogged');
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
    <link rel="stylesheet" href="/css/post.css">
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
        <a href="/php/Admin.php" id="link">
            <button id="optionbar">Home</button>
        </a>
        <a href="#" id="link">
            <button id="optionbar">Branch</button>
        </a>
        <a href="#" id="link">
            <button id="optionbar">Contact</button>
        </a>
        <a href="#" id="link">
            <button id="optionbar">About us</button>
        </a>
        <a id="searchbox" class="searchbox">
            <input type="search" class="font" id="optionbar" class="search" placeholder="Find something here...">
        </a>
        <a href="#" class="searchicon">
            <img src="/images/search.png" id="searchicon" style="color: blue;">
        </a>
    </div>
    <div class="optionlogged">
        <h1>Hi admin, <?php echo "$username"; ?>!</h1>
        <a href="#" class="link">
            <button id="optionbtn">Manage Account</button>
        </a>
        <a href="#" class="link">
            <button id="optionbtn">Post</button>
        </a>
        <a href="/php/destroyss.php" class="link">
            <button id="optionbtn">Log out</button>
        </a>
    </div>
    <div class="layout">
        <form class="flayout">
            <div class="postlist">
                <label for="combobox">Product Catalog</label>
                <select class="combobox">
                    <option>Accessory</option>
                    <option>Taiwan Scroll Door</option>
                    <option>Aluminum Door</option>
                    <option>Star Door</option>
                    <option>AU Door</option>
                    <option>Tech Door</option>
                </select>
                <div class="postlist">
                    <div class="postlist">
                        <label for="name">Product Name</label>
                        <input type="text" name="name">
                    </div>
                    <div class="postlist">
                        <label for="price">Price</label>
                        <input type="text" name="price">
                    </div>
                    <div class="imglist" id="imglist">
                        <input id="file" type="file" name="file" multiple required>
                        <label for="file">Upload </label>
                        <span id="upstt" style="margin-left: 20px;">None</span>
                        <input id="postbtn" type="button" value="Post">
                    </div>
                </div>
        </form>
    </div>
    <script>
        // let uploaded = 'Uploaded';
        let upload = document.getElementById('file');
        let upstt = document.getElementById('upstt')
        upload.addEventListener('change', function(event) {
            let uploadedfile = event.target.files.length;
            upstt.textContent = uploadedfile + ' image uploaded';
        })
    </script>
</body>

</html>