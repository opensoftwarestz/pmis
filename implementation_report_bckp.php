<?php
require_once("authentication.php");
//require_once("includes/connection.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script src="jquery-1.11.1.min.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxtree.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script>          
    
        <script type="text/javascript">
        function show_report() {
            var url = "implementation_report_JSP.php?from=view_report&project="+document.view_report.project.value+"&start_date="+document.view_report.date_started.value+"&end_date="+document.view_report.date_ended.value;
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'sn' },
                    { name: 'project' },
                    { name: 'itemname'},
                    { name: 'descriptions'},
                    { name: 'date'},
                    { name: 'quantity', type: 'int' },
                    { name: 'price' },
                    { name: 'total' }
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#report").jqxGrid(
            {
                width: 1260,
                source: dataAdapter,
                autoheight: true,
                altrows: true,
                selectionmode: 'multiplecellsadvanced',                
                columnsresize: true,
                columns: [
						{ text: 'SN', dataField: 'sn', width: 10 },                  
                  { text: 'Project', dataField: 'project', width: 320 },
                  { text: 'Item Name', dataField: 'itemname', width: 180 },
                  { text: 'Descriptions', dataField: 'descriptions', width: 265 },
                  { text: 'Date Implemented', dataField: 'date', width: 130 },
                  { text: 'Quantity', dataField: 'quantity', width: 100, cellsalign: 'right' },
                  { text: 'Unit Price', dataField: 'price', width: 120, cellsalign: 'right' },
                  { text: 'Total', dataField: 'total', cellsalign: 'right', width: 120 }
                ]
            });
        }
    </script>
<script type="text/javascript">
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
						document.view_report.project.value=event.args.element.id;
            		});
            });
    }
  }
  
xmlhttp.open("GET","add_project_JSP.php?from=populate_projects",true);
xmlhttp.send();
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
<form name="view_report">
<table>
<tr><td colspan="7" align="center"><h3>PROJECT IMPLEMENTATION REPORT</h3></td></tr>

<tr style='background-color:#BCC6CC;'><td align="right">Project/Sub-project</td><td id='jqxWidget'></td><td align='right'>Project Start Date<font color="red">*</font></td><td align='left'><script>DateInput('date_started', true, 'YYYY-MM-DD')</script></td><td align='right'>Project End Date</td><td align='left'><script>DateInput('date_ended', true, 'YYYY-MM-DD')</script></td>
<td align="center"><input type="button" name="button" value="View Report" onclick="show_report()"></td></tr>
</table>
<input type="hidden" name="project">
</form>
<div id="report"></div>
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
