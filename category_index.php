<?php
include('../drama_db.php');
include('../drama_vars.php');?><br /><?
include('_banner2.php');?><br /><?
$list_type=str_ireplace("/","",$_SERVER["REQUEST_URI"]);
if (stripos($list_type,"?")){$list_type=substr($list_type,0,stripos($list_type,"?"));}
switch($list_type){
	case "j-drama":
	case "j-movie":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='j-drama' OR origin='j-movie'"));break;
	case "k-drama":
	case "k-movie":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='k-drama' OR origin='k-movie'"));break;
	case "tw-drama":
	case "tw-movie":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='tw-drama' OR origin='tw-movie'"));break;
	case "hk-drama":
	case "hk-movie":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='hk-drama' OR origin='hk-movie'"));break;
	case "ch-drama":
	case "ch-movie":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='ch-drama' OR origin='ch-movie'"));break;
	case "anime":
		$num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas WHERE origin='anime'"));break;
	default: $num_rows=mysql_num_rows(mysql_query("SELECT * FROM dramas"));break;
}

include('../drama_table.php');?><br /><?
include('_banner4.php');
