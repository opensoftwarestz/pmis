<?php
include ("authentication.php");
if($_REQUEST["from"]=="process") {
	if (mysql_query("insert into project (name,description,parent,start_date,end_date,technician_id,technician_fee) values ('$_REQUEST[project_name]','$_REQUEST[descriptions]','$_REQUEST[parent]','$_REQUEST[start_date]','$_REQUEST[end_date]','$_REQUEST[technician_id]','$_REQUEST[fee]')") or die(mysql_error()))
	echo "Project Added Successfully";
	else
	echo "Failed To Add Project,Try Again";
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