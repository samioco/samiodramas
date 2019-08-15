<?php

#define('PATH',dirname('ROOT_DIR.php');
$ROOT= "http://www.samio.co/drama";
?><link rel='stylesheet' type='text/css' href='style.php' /><?
include('_header.php');
include('drama_db.php');
include('drama_vars.php');
/*
?><table align="center" width="900"><tr><td align="center"><br /><?
include('_banner2.php');
?></td></tr></table><?
*/
$drama_id=-1;
include('drama_hits.php');
#$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas"));
?><br /><?
include('_banner2.php');?><br /><?

for ($i=1;$i<=5;$i++){
	$num_rows=10;
	switch($i){
		case 1: $list_type="j-drama";break;
		case 2: $list_type="k-drama";break;
		case 3: $list_type="tw-drama";break;
		case 4: $list_type="hk-drama";break;
		case 5: $list_type="anime";break;
		
	}
	include('drama_table.php');?><br /><?
}
$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas"));$list_type="all";
include('drama_table.php');?><br /><?
include('_banner4.php');?><br /><?
include('_footer.php') ?>