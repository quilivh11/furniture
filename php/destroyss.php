<?php 
sleep(1);
session_start();
session_destroy(); 
header("Location: /php/Homepage.php");