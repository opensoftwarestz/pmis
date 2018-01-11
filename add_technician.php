<?php
require_once("authentication.php");
require_once("includes/connection.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
.multiselect {
    width:20em;
    height:5em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}
</style>
<script src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">

//this jquery controls the multiple selection
jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
};
$(function() {
     $(".multiselect").multiselect();
});

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
    document.technician.full_name.value="";
    document.technician.phone.value="";       
    }
  }

	var tech_category = new Array();
	check_box_len=document.getElementsByName("option[]").length;	
	for (k=0;k<check_box_len;k++) {		
		if(document.getElementsByName("option[]")[k].checked)
		tech_category[k]=document.getElementsByName("option[]")[k].value;
		}

	xmlhttp.open("GET","add_technician_JSP.php?from=process&full_name="+document.technician.full_name.value+"&phone="+document.technician.phone.value+"&tech_category="+tech_category,true);
xmlhttp.send();	
	}
	
function verify() {
	document.getElementById("infomsg").innerHTML="";
	check_box_len=document.getElementsByName("option[]").length;
	found_checked=false;
	for (k=0;k<check_box_len;k++) {
		if(document.getElementsByName("option[]")[k].checked)
		found_checked=true;
		}
	if(found_checked==false) {
		document.getElementById("errmsg").innerHTML="<font color='red'><b>Select Atleast One Technician Category</b></font>";
		return false;		
		}		
	if(document.technician.full_name.value=="") {
		document.getElementById("errmsg").innerHTML="<font color='red'><b>Technician Name Must Be Filled</b></font>";
		return false;
		}
		
	process();
	}
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
<body style="background-color:white;">
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
<form name="technician">
<table>
<tr><td colspan="2" align="center"><h3>Add Technician</h3></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Technician Full Name<font color="red">*</font></td><td><input type="text" name="full_name"></td></tr>
<tr style='background-color:#BCC6CC;'><td align="right">Technician Type<font color="red">*</font></td><td class="multiselect">
<option value="-1">---Select---</option>
<?php
$results=mysqli_query($connect, "select id,name from technician_category");
while($row=mysqli_fetch_array($results, MYSQLI_ASSOC)) {	
	echo "<label><input type='checkbox' name='option[]' value='$row[id]' />$row[name]</label>";
	}
?>
</td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Cell Phone</td><td><input type="text" name="phone"></td></tr>

<tr style='background-color:#BCC6CC;'><td colspan="2" align="center"><input type="button" name="button" value="Add" onclick="verify()"></td></tr>
</table>
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
