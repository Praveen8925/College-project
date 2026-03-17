<?php 
session_start();
session_destroy();
unset($_SESSION["AU"]);
header("Location: index.php");
?>