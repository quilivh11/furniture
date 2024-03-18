<?php
if (!empty($_SESSION)) {
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
}