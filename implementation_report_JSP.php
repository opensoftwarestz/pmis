<?php
include ("authentication.php");
$project=$_REQUEST["project"];
$start_date=date("Y-m-d",strtotime($_REQUEST["start_date"]));
$end_date=date("Y-m-d",strtotime($_REQUEST["end_date"]));
$projects_id=array();
get_project_name($project);
$projects_id[$project]=$name;
$name="";
get_child_project($project);

foreach($projects_id as $id=>$name) {
	$results=mysql_query("select * from project_implementation where project_id='$id' and date_implemented between '$start_date' and '$end_date'");
	while($row=mysql_fetch_array($results)) {
		$project_name[]=$name;
		$item_names[]=$row["item_name"];
		$descriptions[]=$row["description"];
		$date_implemented[]=date("d-m-Y",strtotime($row["date_implemented"]));
		$quantity[]=$row["quantity"];
		$price[]=number_format($row["price"]);
		$total_price[]=number_format($row["quantity"]*$row["price"]);
		}
	}

	$i=0;
	while($i < count($item_names))
	{
	  $counter++;
	  $row = array();
	  $row["project"] = $project_name[$i];
	  $row["itemname"] = $item_names[$i];
	  $row["descriptions"] = $descriptions[$i];
	  $row["date"] = $date_implemented[$i];
	  $row["quantity"] = $quantity[$i];
	  $row["price"] = $price[$i];
	  $row["total"] = $total_price[$i];
	  $overall_price=$overall_price+str_replace(",","",$total_price[$i]);
	  $row["sn"]=$counter;
	  $data[$i] = $row;
	  $i++;	  	  
	}
	$row["total"]=number_format($overall_price);
	$row["project"]="";
	$row["itemname"] = "";
	$row["descriptions"] = "";
	$row["date"] = "";
	$row["quantity"] = "";
	$row["price"] = "";
	$row["sn"]="";
	$data[count($data)]=$row;
	

function get_child_project($id) {
	global $projects_id,$name;
	$results=mysql_query("select id,name from project where parent='$id'") or die(mysql_error());
	if(mysql_num_rows($results)>0) {		
	while($row=mysql_fetch_array($results)) {
		get_project_name($row["id"]);		
		$projects_id[$row["id"]]=$name;
		$name="";
		get_child_project($row["id"]);
		}
		}
	else {
		get_project_name($id);
		$projects_id[$id]=$name;
		$name="";	
		}
	}
	
function get_project_name($id) {
	global $name;
	$results1=mysql_query("select name from project where id='$id'");
	while($row1=mysql_fetch_array($results1)) {
		list($parent)=mysql_fetch_array(mysql_query("select parent from project where id='$id'"));
		if($parent>0) {
			get_project_name($parent);
			}
		if($name=="")
		$name=$row1["name"];
		else
		$name=$name."->".$row1["name"];
		}		
	}
	 
	header("Content-type: application/json"); 
	echo "{\"data\":" .json_encode($data). "}";
?>