<?php
session_start();
session_unregister("id");
header("location:index.php");
?>
