<?php 
session_start();
session_destroy(); 
header("Location: /php/Homepage.php");