<?php
include ("authentication.php");
if($_REQUEST["from"]=="process") {
	if (mysql_query("insert into technicians (full_name,technician_category,contacts) values ('$_REQUEST[full_name]','$_REQUEST[tech_category]','$_REQUEST[phone]')"))
	echo "Technician Added SUccessfully";
	else
	echo "Failed To Add Technician,Try Again";
	}	
?>