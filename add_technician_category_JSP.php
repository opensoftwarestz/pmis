<?php
require_once("authentication.php");
require_once("includes/connection.php");
if($_REQUEST["from"]=="process") {
	if (mysqli_query($connect, "insert into technician_category (name) values ('$_REQUEST[tech_name]')"))
	echo "Technician Category Added SUccessfully";
	else
	echo "Failed To Add Technician Category,Try Again";
	}	
?>
