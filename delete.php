<?php
mysql_connect("localhost","root","tajiri");
mysql_select_db("train");
list($score)=mysql_fetch_array(mysql_query("select score from hippo_students_results where id='students_results|17070'"));
echo intval(0);
?>