<?php
include ("authentication.php");
$passwd=md5($_REQUEST["passwd"]);
if (mysql_query("insert into users (fname,lname,mname,passwd,uname) values ('$_REQUEST[fname]','$_REQUEST[lname]','$_REQUEST[mname]','$passwd','$_REQUEST[uname]')"))
echo "Account Created Successfully";
else 
echo "Failed When Creating Account,Try Again";
?>