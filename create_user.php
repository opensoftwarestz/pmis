<?php
include('authentication.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function verify()
{
if(document.account.fname.value=="") {
	document.getElementById("errmsg").innerHTML="Enter First Name";
	return false;
	}
if(document.account.lname.value=="") {
	document.getElementById("errmsg").innerHTML="Enter Last Name";
	return false;
	}
if(document.account.uname.value=="") {
	document.getElementById("errmsg").innerHTML="Enter Username";
	return false;
	}
if(document.account.passwd.value=="" || document.account.cpasswd.value=="") {
	document.getElementById("errmsg").innerHTML="Enter Password";
	return false;
	}
if(document.account.passwd.value != document.account.cpasswd.value) {
	document.getElementById("errmsg").innerHTML="Passwords Missmatch";
	return false;
	}
process();
}
	
function process()
{
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
    	document.getElementById("errmsg").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","create_user_JSP.php?fname="+document.account.fname.value+"&mname="+document.account.mname.value+"&lname="+document.account.lname.value+"&uname="+document.account.uname.value+"&passwd="+document.account.passwd.value,true);
xmlhttp.send();
}
</script>
<title>Edit Item</title>
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Beginning of compulsory code below -->

<link href="menu/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="menu/css/dropdown/themes/mtv.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!--[if lt IE 7]>
<script type="text/javascript" src="menu/jquery.js"></script>
<script type="text/javascript" src="menu/jquery.dropdown.js"></script>
<![endif]-->

<!-- / END -->
<script type="text/javascript" src="calendarDateInput.js">
</script>
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
<center><div id="errmsg" style="color:red;font-weight:bold;"></div></center>
<form name="account" method="POST" action="#">
<table align="center" id="changePasswd">
<tr><td colspan="2" align="center"><h3>Create New Account</h3></td></tr>
<tr style='background-color:#BCC6CC;'><td align="right">First Name</td><td><input type="text" name="fname"></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Midle Name</td><td><input type="text" name="mname"></td></tr>
<tr style='background-color:#BCC6CC;'><td align="right">Last Name</td><td><input type="text" name="lname"></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Username</td><td><input type="text" name="uname"></td></tr>
<tr style='background-color:#BCC6CC;'><td align="right">Password</td><td><input type="password" name="passwd"></td></tr>
<tr style='background-color:#C0C0C0;'><td align="right">Confirm Password</td><td><input type="password" name="cpasswd"></td></tr>
<tr style='background-color:#BCC6CC;'><td colspan="2" align='center'><input type="button" onclick="return verify()" value="Create Account"></td></tr>
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
<div id="footer">
	<p>&copy;2012 All Rights Reserved. &nbsp;&bull;&nbsp; Developed by Ally Shaban
</div>
</body>
</html>
