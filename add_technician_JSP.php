<?php
require_once("authentication.php");
require_once("includes/connection.php");
if($_REQUEST["from"]=="process") {
	if (mysqli_query($connect, "insert into technicians (full_name,technician_category,contacts) values ('$_REQUEST[full_name]','$_REQUEST[tech_category]','$_REQUEST[phone]')"))
	echo "Technician Added SUccessfully";
	else
	echo "Failed To Add Technician,Try Again";
	}	
?>
