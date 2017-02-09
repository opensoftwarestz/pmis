<?php
session_start();
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Login To Rafiki Kilimo SIS</title>
    <link href="styles/screen.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 7]>
 <link href="/squaredeye/styles/ie7.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
 <link href="/squaredeye/styles/ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
</head>
  <body id="login">
    <div id="container">
      <div id="content">
    <?php
	if(isset($_GET['error'])){
		$error = urldecode($_GET['error']);
		echo $error;
		}
	?>
        <div id="loginBox">
          <h2>Login to PMIS</h2>
          <form id="loginform" action="includes/login.php" method="post" style="position:relative;top:30px">
            <label for="loginName">User Name:</label>
            <input id="loginName" class="textFieldLogin" name="uname" type="text" value="" />
            <label for="loginPass">Password:</label>
            <input id="loginPass" class="textFieldLogin" name="passwd" type="password" value="" />            
            <div class="MBbuttonLogin">
              <input type="submit" id="loginButton" name="loginbutton" value="Login..." />
            </div>
          </form>
          <div class="close" />
        </div>
      </div>
    </div>    
  </body>
</html>
