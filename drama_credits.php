<?php 

$song_q=mysql_query("SELECT * FROM songs WHERE drama_name_eng='$drama_name'");
$num_songs = mysql_num_rows($song_q);
$actor_q = mysql_query("SELECT * FROM cast WHERE drama_name_eng='$drama_name' AND cast_role IN ('actor','actress') ORDER BY main_actor DESC");
$num_actors = mysql_num_rows($actor_q);
$stage_cast_q = mysql_query("SELECT * FROM cast WHERE drama_name_eng='$drama_name' AND cast_role NOT IN ('actor' ,'actress')");
$num_stage_cast = mysql_num_rows($stage_cast_q);
$awards_q = mysql_query("SELECT * FROM awards WHERE related_drama='$drama_name'");
$num_awards = mysql_num_rows($awards_q);

?><table width="800" border="0" align="center" cellpadding="10">
<tr><td align="left" valign="top" cellpadding="10" width="50%">
<?
if ($num_songs>0 || $num_actors>0 || $num_stage_cast>0) {?>
	<b>Production Credits:</b><br /><br />
	<?if ($num_songs>=1){
		?><b>Theme Song<?
		if ($num_songs>1){?>s:</b><br /><?} else {?>:</b><br /><?}
		while ($song_r=mysql_fetch_array($song_q)){
			if ($song_r[song_info_link]){?><a href="<?echo $song_r[song_info_link];?>"><?}
			echo $song_r[song_name_eng];
			if ($song_r[song_name_asian]){echo " (".$song_r[song_name_asian].")";}
			if ($song_r[song_info_link]){?></a><?}
			echo ", by ";
			if ($song_r[artist_info_link]){?><a href="<?echo $song_r[artist_info_link];?>"><?}
			echo $song_r[artist_name_eng];
			if ($song_r[artist_name_asian]){echo " (".$song_r[artist_name_asian].")";}
			if ($song_r[song_info_link]){?></a><?}
			?><br /><?
		}
	?><br /><br /><?
	}
	if ($num_actors>=1 || $num_stage_cast>=1){
		?><b>Cast:</b><br /><?
		#Main Actors first
		$actor_q1 = mysql_query("SELECT * FROM cast WHERE drama_name_eng='$drama_name' AND cast_role IN ('actor','actress') AND main_actor='1' ORDER BY id");
		while ($actors_r = mysql_fetch_array($actor_q1)) {
			$people_q = mysql_query("SELECT * FROM people WHERE name_eng='$actors_r[name_eng]'");
			if ($people_q){
				$people_r=mysql_fetch_array($people_q);
				if ($people_r[info_link]){?><a href="<?echo $people_r[info_link];?>" target="_blank"><?}
				else if ($people_r[pic_link]){?><a href="<?echo $people_r[pic_link];?>" target="_blank"><?}
				echo str_ireplace("\\","",$actors_r[name_eng]);
				if ($people_r[name_asian]){echo " (".$people_r[name_asian].")";}
				if ($people_r[info_link] || $people_r[pic_link]){?></a><?}
			} else {
				if ($actors_r[info_link]){?><a href="<?echo $actors_r[info_link];?>" target="_blank"><?}
				else if ($actors_r[pic_link]){?><a href="<?echo $actors_r[pic_link];?>" target="_blank"><?}
				echo stripslashes($actors_r[name_eng]);
				if ($actors_r[info_link] || $actors_r[pic_link]){?></a><?}
			}
			$role=str_ireplace("\\","",$actors_r[role_detail]);
			if ($actors_r[role_detail]) {echo ", as ".$role;?><br /><?}
		}
		#non-main actors next
		$actor_q1 = mysql_query("SELECT * FROM cast WHERE drama_name_eng='$drama_name' AND cast_role IN ('actor','actress') AND main_actor='0'");
		while ($actors_r = mysql_fetch_array($actor_q1)) {
			$people_q = mysql_query("SELECT * FROM people WHERE name_eng='$actors_r[name_eng]'");
			if ($people_q){
				$people_r = mysql_fetch_array($people_q);
				if ($people_r[info_link]){?><a href="<?echo $people_r[info_link];?>" target="_blank"><?}
				else if ($people_r[pic_link]){?><a href="<?echo $people_r[pic_link];?>" target="_blank"><?}
				echo str_ireplace("\\","",$actors_r[name_eng]);
				if ($people_r[name_asian]){echo " (".$people_r[name_asian].")";}
				if ($people_r[info_link] || $people_r[pic_link]){?></a><?}
			} else {
				if ($actors_r[info_link]){?><a href="<?echo $actors_r[info_link];?>" target="_blank"><?}
				else if ($actors_r[pic_link]){?><a href="<?echo $actors_r[pic_link];?>" target="_blank"><?}
				echo str_ireplace("\\","",$actors_r[name_eng]);
				if ($actors_r[info_link] || $actors_r[pic_link]){?></a><?}
			}
			$role=str_ireplace("\\","",$actors_r[role_detail]);
			if ($actors_r[role_detail]) {echo ", as ".$role;?><br /><?}
			else {?><br /><?}			
		}
		
		
		?><br /><?
		while ($stage_cast_r =  mysql_fetch_array($stage_cast_q)){
			?><b><?echo ucfirst(strtolower($stage_cast_r[cast_role])).": ";?></b><?
			$people_q = mysql_query("SELECT * FROM people WHERE name_eng='$stage_cast_r[name_eng]'");
			if ($people_q){
				$people_r = mysql_fetch_array($people_q);
				if ($people_r[info_link]){?><a href="<?echo $people_r[info_link];?>" target="_blank"><?}
				else if ($people_r[pic_link]){?><a href="<?echo $people_r[pic_link];?>" target="_blank"><?}
				echo str_ireplace("\\","",$stage_cast_r[name_eng]);
				if ($people_r[name_asian]){echo " (".$people_r[name_asian].")";}
				if ($people_r[info_link] || $people_r[pic_link]){?></a><?}
			} else {
				if ($stage_cast_r[info_link]){?><a href="<?echo $stage_cast_r[info_link];?>" target="_blank"><?}
				else if ($stage_cast_r[pic_link]){?><a href="<?echo $stage_cast_r[pic_link];?>" target="_blank"><?}
				echo str_ireplace("\\","",$stage_cast_r[name_eng]);
				if ($stage_cast_r[info_link] || $stage_cast_r[pic_link]){?></a><?}
			}
			?><br /><?
		}
	}?><br /><?
}
if($num_awards>0){
	?><b>Recognitions & Awards:</b><br /><?
	while($awards_r=mysql_fetch_array($awards_q)){
		echo $awards_r[award_name].": ".$awards_r[category]." - ".$awards_r[winner];?><br /><?
	}?><br /><?
}

if(strlen($official_site)>0) {?><b><a href="<?echo $official_site;?>" target="_blank">Visit the official site of <?echo $drama_name_eng;?>!</a></b><br /><?}
?>
<br /></td>

</tr></table>
