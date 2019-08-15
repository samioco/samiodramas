<?php
include('drama_hits.php');
?>
<table width="800" border="0" align="center" cellpadding="10">
<tr>	<td colspan="2" class="hugeBold" align="left">
	<a href="<?echo $drama_path;?>"><?echo $drama_name_eng;?></a>
	<?if ($drama_name_asian){?><a href="<?echo $drama_path;?>"><?echo " (".$drama_name_asian.")";?></a><?}?>
</td></tr>

<tr>
<td width="1" valign="top"><img title="<?echo $drama_name_eng." | ".$drama_name_asian." logo";?>" alt="<?echo $drama_name_eng." | ".$drama_name_asian;?>" src="<?echo $logo_path;?>" /></td>
<td width="100%" align="left" valign="top">

<?$result1 = mysql_query("SELECT detail_info FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='alt_title' ORDER BY detail_info");
#$num_rows = mysql_num_rows($result1);
if (($num_rows = mysql_num_rows($result1))>0) {
	if ($result1){
		?><b>Alternate Titles:</b><br /><?
		for ($i=1; $i<=$num_rows; $i++){$row = mysql_fetch_array($result1);echo $row[detail_info];if ($i<$num_rows) echo ", ";}
	}
	?><br /><br /><?
}

$result1 = mysql_query("SELECT detail_info FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='genre' ORDER BY detail_info");
$num_rows = mysql_num_rows($result1);
if ($num_rows>0) {
	if ($result1){
		?><b>Genre: </b><?
		for ($i=1; $i<=$num_rows; $i++){$row = mysql_fetch_array($result1);echo $row[detail_info];if ($i<$num_rows) echo ", ";}
	}
	?><br /><br /><?
}?>

<b>Language:</b> <?echo $language; 
if ($language_asian_display){echo " / ".$language_asian_display;}?><br />
<b>Subtitles:</b> <?echo $subtitles;
if ($subtitles_asian_display){echo " / ".$subtitles_asian_display;}?>
<br /><br />

<b>Broadcast period:</b> <?echo $date_range_eng;?><br />
<?echo $date_range_asian;?>

<?if ($network) {?><br /><br /><b>Broadcast network:</b> <?echo $network;}
if ($rating) {?><br /><br /><b>Viewership ratings:</b> <?echo $rating;}?>

<?$related_q = mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='related_series' ORDER BY detail_info");
$num_rows = mysql_num_rows($related_q);
if ($num_rows>0) {
	?><br /><br /><b>Related Series:</b><br /><?
	while ($related_r = mysql_fetch_array($related_q)) {
		$find_drama_q = mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$related_r[detail_info]'");
		if ($find_drama_r = mysql_fetch_array($find_drama_q)) {
			?><a href="<?echo $domain_path."/".$find_drama_r[origin]."/".$find_drama_r[dir_name]."/";?>"><?
			echo $related_r[detail_info]; ?></a><br /><?
		} else {echo $related_r[detail_info]; ?><br /><?}
	}
}?>
<br /><br /><b>Views: </b><?echo $hits;?></b>
</td></tr>
<tr><td colspan="2" align="left">
<?$main_cast_q = mysql_query("SELECT name_eng FROM cast WHERE drama_name_eng='$drama_name' AND main_actor='1' ORDER BY id");
$num_rows = mysql_num_rows($main_cast_q);
if ($num_rows>0){
	?><b>Main Cast:</b><br /> <?
	for ($i=1; $i<=$num_rows; $i++){
		$main_cast_r = mysql_fetch_array($main_cast_q);
		$people_q = mysql_query("SELECT * FROM people WHERE name_eng='$main_cast_r[name_eng]'");
		if ($people_q){
			$people_r = mysql_fetch_array($people_q);
			if ($people_r[info_link]){?><a href="<?echo $people_r[info_link];?>" target="_blank"><?}
			else if ($people_r[pic_link]){?><a href="<?echo $people_r[pic_link];?>" target="_blank"><?}
			echo $main_cast_r[name_eng];
			if ($people_r[name_asian]){echo " (".$people_r[name_asian].")";}
			if ($people_r[info_link] || $people_r[pic_link]){?></a><?}
		} else {
			if ($main_cast_r[info_link]){?><a href="<?echo $main_cast_r[info_link];?>" target="_blank"><?}
			else if ($main_cast_r[pic_link]){?><a href="<?echo $main_cast_r[pic_link];?>" target="_blank"><?}
			echo $main_cast_r[name_eng];
			if ($main_cast_r[info_link] || $main_cast_r[pic_link]){?></a><?}
		}
		/*?><a href="<?echo $people_r[info_link];?>"><?echo $people_r[name_eng]." (".$people_r[name_asian].")";?></a><?*/
		if ($i<$num_rows) echo ", ";
	}?><br /><br /><?
}?>
<b>Synopsis:</b><br /><?echo $synopsis;?><br />
</td></tr></table>