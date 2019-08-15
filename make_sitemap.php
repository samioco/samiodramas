<?php

include('drama_db.php');
include('drama_vars.php');
$f = fopen("sitemap.txt", "w");
$domain="http://www.samiodramas.com";
fwrite($f,$domain."\n");echo $domain;?><br /><?

$query = mysql_query("SELECT * FROM dramas");
while($row = mysql_fetch_array($query)){
	$origin=$row[origin];
	$dir_name=$row[dir_name];
	$url=$domain."/".$origin."/".$dir_name."/";
	fwrite($f, $url."\n");
	echo $url;?><br /><?
}

fclose($f);
?>