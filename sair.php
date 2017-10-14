<?php session_start();

unset($_SESSION['conta']);
header("Location:index.php");

?>