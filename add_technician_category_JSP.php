<?php
include ("authentication.php");
if($_REQUEST["from"]=="process") {
	if (mysql_query("insert into technician_category (name) values ('$_REQUEST[tech_name]')"))
	echo "Technician Category Added SUccessfully";
	else
	echo "Failed To Add Technician Category,Try Again";
	}	
?>