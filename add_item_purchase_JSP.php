<?php
require_once("authentication.php");
require_once("includes/connection.php");
if($_REQUEST["from"]=="process") {
	$date=date("Y-m-d",strtotime($_REQUEST["purchase_date"]));
	if (mysqli_query($connect,"insert into project_implementation (item_name,description,project_id,quantity,price,date_implemented) values ('$_REQUEST[item_name]','$_REQUEST[descriptions]','$_REQUEST[project]','$_REQUEST[quantity]','$_REQUEST[price]','$date')"))
	echo "Purchase/Expenditures Added Successfully";
	else
	echo "Failed To Add Purchase/Expenditures,Try Again";
	}
	
else if($_REQUEST["from"]=="populate_projects") {
	$data="[";
	$results=mysqli_query($connect,"select * from project");
	while($row=mysqli_fetch_array($results, MYSQLI_ASSOC)) {
		if($row["parent"]==0)
		$parent=-1;
		else
		$parent=$row["parent"];
		$counter++;
		if($counter==1)
		$data=$data.'{"id":"'.$row["id"].'",
							"parentid":"'.$parent.'",
							"text":"'.$row["name"].'",
							"value":"'.$row["id"].'"}';
		else
		$data=$data.',{"id":"'.$row["id"].'",
							"parentid":"'.$parent.'",
							"text":"'.$row["name"].'",
							"value":"'.$row["id"].'"}';
		}
		$data=$data."]";
		echo $data;		
	}
?>
