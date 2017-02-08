<?php
session_start();
session_destroy("id");
header("location:index.php");
?>
