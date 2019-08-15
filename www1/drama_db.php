<?php
$hostname= "samio_dramas.db.3892897.hostedresource.com"; #alternate: "97.74.31.183"
$username= "samio_dramas";
$password= "L1lp0ppa";
$dbname= "samio_dramas";
mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
mysql_select_db($dbname);
$var=mysql_query("SET NAMES 'utf8'");
$rs = mysql_query("SHOW VARIABLES LIKE 'character_set_%'");
mysql_query("SET CHARACTER SET utf-8");
mysql_query("SET character_set_results = 'utf8'");

