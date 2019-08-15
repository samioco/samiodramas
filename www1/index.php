<?php


include('drama_db.php');
include('drama_vars.php');

echo "http://www.samiodrama.com";?><br /><?
$q=mysql_query("SELECT * FROM dramas order by start_date DESC");
while($r=mysql_fetch_array($q)){
	echo "http://www.samiodrama.com/".$r[origin]."/".$r[dir_name]."/";?><br /><?
}

/*
echo "samio drama dramas movie movies anime animation japanese korean chinese taiwanese hong kong watch stream video episode special ";

$q=mysql_query("SELECT * FROM dramas order by start_date DESC");
while($r=mysql_fetch_array($q)){
	echo $r[drama_name_eng]." ";
}

$q=mysql_query("SELECT * FROM details_list WHERE detail_type='alt_title'");
while($r=mysql_fetch_array($q)){
	echo $r[detail_info]." ";
}

$q=mysql_query("SELECT * FROM dramas");
while($r=mysql_fetch_array($q)){
	echo $r[drama_name_asian]." ";
}
*/

?>