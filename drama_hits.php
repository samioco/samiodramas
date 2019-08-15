<?php

$hits_q=mysql_query("SELECT * FROM drama_hits WHERE id='$drama_id'");
if (mysql_num_rows($hits_q)==0){mysql_query("INSERT INTO drama_hits (id,hits) VALUES ('$drama_id','1')");}
$hits_r=mysql_fetch_array($hits_q);
$hits=$hits_r[hits]+1;
mysql_query("UPDATE drama_hits SET hits='$hits' WHERE id='$drama_id'");