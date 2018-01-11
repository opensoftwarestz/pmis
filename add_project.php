<?php
require_once("authentication.php");
require_once("includes/connection.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script src="jquery-1.11.1.min.js"></script>    
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxpanel.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxtree.js"></script>
<script type="text/javascript">
function process() {
	document.getElementById("infomsg").innerHTML="<center><font><img width=\"50\" height=\"50\" src=\"images/loading1.gif\">Saving Data.... please wait.... </font></center>";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {    	
    document.getElementById("infomsg").innerHTML="<font color='green'><img src='images/information.jpg' width='30' height='30'>"+xmlhttp.responseText+"</font>";
    document.getElementById("errmsg").innerHTML="";
    document.add_project.project_name.value="";
    document.add_project.descriptions.value="";
    document.getElementById("technician_id").selectedIndex=0;
    populate_projects();      
    }
  }

	xmlhttp.open("GET","add_project_JSP.php?from=process&project_name="+document.add_project.project_name.value+"&parent="+document.add_project.parent.value+"&descriptions="+document.add_project.descriptions.value+"&start_date="+document.add_project.date_started.value+"&end_date="+document.add_project.date_ended.value+"&technician_id="+document.add_project.technician_id.value+"&fee="+document.add_project.fee.value,true);
xmlhttp.send();	
	}
	
function populate_projects() {
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
                $(document).ready(function () {
                var data = xmlhttp.responseText         
                // prepare the data
                var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'parentid' },
                        { name: 'text' },
                        { name: 'value' }
                    ],
                    id: 'id',
                    localdata: data
                };
                // create data adapter.
                var dataAdapter = new $.jqx.dataAdapter(source);
                // perform Data Binding.
                dataAdapter.dataBind();
                // get the tree items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents 
                // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter 
                // specifies the mapping between the 'text' and 'label' fields.  
                var records = dataAdapter.getRecordsHierarchy('id', 'parentid', 'items', [{ name: 'text', map: 'label'}]);
                $('#jqxWidget').jqxTree({ source: records, width: '300px'});
                $('#jqxWidget').on('select', function (event) {
						document.add_project.parent.value=event.args.element.id;
            		});
            });
    }
  }
  
xmlhttp.open("GET","add_project_JSP.php?from=populate_projects",true);
xmlhttp.send();	
	}
	
function verify() {
	document.getElementById("infomsg").innerHTML="";
	if(document.add_project.project_name.value=="") {
		document.getElementById("errmsg").innerHTML="<font color='red'><b>Project Name Must Be Filled</b></font>";
		return false;
		}
	
	if(document.add_project.fee.value!="" && isNaN(document.add_project.fee.value)) {
		document.getElementById("errmsg").innerHTML="<font color='red'><b>Consultation Fee Must Be A Number</b></font>";
		return false;
		}

		
	process();
	}
</script>
<script type="text/javascript" src="calendarDateInput.js">
</script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Sajili Bidhaa</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Beginning of compulsory code below -->

<link href="menu/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="menu/css/dropdown/themes/mtv.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!--[if lt IE 7]>
<script type="text/javascript" src="menu/jquery.js"></script>
<script type="text/javascript" src="menu/jquery.dropdown.js"></script>
<![endif]-->

<!-- / END -->
</head>
<body style="background-color:white;" onload="populate_projects()">
<!-- start header -->
<div id="logo">
		<?php include ("logo.php"); ?>
</div>

<div id="menu">
<?php
include ("includes/menu.php");
?>
</div>
<!-- end header -->
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	<center>
<div id="errmsg"></div>
<div id="infomsg"></div>
<form name="add_project">
<table>
<tr><td colspan="2" align="center"><h3>Add Project/Sub-project</h3></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Project Name<font color="red">*</font></td><td><input type="text" name="project_name"></td></tr>
<tr style='background-color:#BCC6CC;'><td align="right">Parent Project</td><td id='jqxWidget'></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Project Descriptions</td><td><textarea name="descriptions" rows='5'></textarea></td></tr>
<tr style='background-color:#BCC6CC;'><td align='right'>Project Start Date<font color="red">*</font></td><td align='left'><script>DateInput('date_started', true, 'YYYY-MM-DD')</script></td></tr>
<tr style='background-color:#C0C0C0;'><td align='right'>Project End Date</td><td align='left'><script>DateInput('date_ended', true, 'YYYY-MM-DD')</script></td></tr>
<tr style='background-color:#BCC6CC;'><td align='right'>Technician Assigned</td><td align='left'><select name="technician_id" id="technician_id">
<option value="-1">---Select---</option>
<?php
$results=mysqli_query($connect,"select id,full_name from technicians");
while(list($tech_id, $tech_name)=mysqli_fetch_array($results, MYSQLI_NUM)) {
	echo "<option value='$tech_id'>$tech_name</option>";
	}
?>
</select></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Technician Total Consultation Fee</td><td><input type="text" name="fee"></td></tr>
<tr style='background-color:#BCC6CC;'><td colspan="2" align="center"><input type="button" name="button" value="Add" onclick="verify()"></td></tr>
</table>
<input type="hidden" name="parent">
</form>
				</center>
		</div>
	<!-- end content -->
	<!-- start sidebars -->
	
	
	<!-- end sidebars -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<?php
include("footer.html");
?>
</body>
</html>
