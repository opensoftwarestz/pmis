<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE);
$connect = mysqli_connect("localhost","pmis","pmis");
mysqli_select_db($connect, "pmis");
?>
