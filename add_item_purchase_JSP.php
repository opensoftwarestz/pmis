<?php
include ("authentication.php");
if($_REQUEST["from"]=="process") {
	$date=date("Y-m-d",strtotime($_REQUEST["purchase_date"]));
	if (mysql_query("insert into project_implementation (item_name,description,project_id,quantity,price,date_implemented) values ('$_REQUEST[item_name]','$_REQUEST[descriptions]','$_REQUEST[project]','$_REQUEST[quantity]','$_REQUEST[price]','$date')"))
	echo "Purchase/Expenditures Added Successfully";
	else
	echo "Failed To Add Purchase/Expenditures,Try Again";
	}
	
else if($_REQUEST["from"]=="populate_projects") {
	$data="[";
	$results=mysql_query("select * from project");
	while($row=mysql_fetch_array($results)) {
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