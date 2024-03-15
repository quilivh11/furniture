<?php
require(__DIR__ . './vendor/autoload.php');

use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withProjectId('php-web-a41b7-default-rtdb')
    ->withDatabaseUri('https://php-web-a41b7-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/path/to/firebase_credentials.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();

// Xử lý dữ liệu đăng ký từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tạo một đối tượng user
    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    // Thêm user mới vào Firebase
    $newUser = $database->getReference('users')->push($user);

    if ($newUser) {
        echo "Đăng ký tài khoản thành công!";
    } else {
        echo "Đã xảy ra lỗi khi đăng ký tài khoản.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
</head>

<body>
    <h2>Đăng ký tài khoản</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Đăng ký">
    </form>
</body>

</html>