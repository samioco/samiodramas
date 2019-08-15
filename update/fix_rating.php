<?php

include('../drama_db.php');
$q=mysql_query("SELECT * FROM dramas");
while($r=mysql_fetch_array($q)){
	$id=$r[id];
	$rating=$r[rating];
	/*if ($rating){
		echo $rating." --> ";
		$rating=trim(str_ireplace("kanto","",$rating));
		$rating=sprintf("%02.2f",$rating);
		mysql_query("UPDATE dramas SET rating='$rating' WHERE id='$id'");
	}*/
	if (($rating)&&($rating<10)){
		$rating="0".$rating;
		mysql_query("UPDATE dramas SET rating='$rating' WHERE id='$id'");
	}
	echo $rating."<br />";
	$rating="";
}
