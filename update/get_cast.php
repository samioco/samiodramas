<?php

#grab cast info from wiki
$wiki_file = file_get_contents($wiki_page); 


#FIND CASTLIST startpos
$castlist_startpos = stripos($wiki_file, "name=\"cast");#find starting position of cast list
$castlist_startpos = stripos($wiki_file, "<li>", $castlist_startpos);#find starting position of cast list
#CASTLIST STARTING POSITION FOUND!! begin loop to rip off names

$cast_start_str = "title=\"";
$cast_end_str = "\"";
$guestslist_startpos = stripos($wiki_file, "name=\"Guests\"");
$credits_startpos = stripos($wiki_file, "name=\"production_credits\"");
$cast_start_str = "title=\"";
$cast_end_str = "\">";
$cast_offset = strlen($cast_start_str);
$castrole_start_str = "</a> ";
$castrole_end_str = "<";
$castrole_offset = strlen($castrole_start_str);

#insert into cast values (name_eng,drama_name_eng,cast_role,role_detail) values (
$num_cast=1;
?><table width="1000" align="center" border="2" cellpadding="5">
<tr><td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="25" align="center">#</td>
<td class="boldText" width="350" align="center">Cast Name</td>
<td class="boldText" width="150" align="center">Cast Role</td>
<td class="boldText" width="350" align="center">Cast Detail</td>
<td class="boldText" width="25" align="center">Main (0/1)</td>
</tr><?

for ($i=1;$i<=2;$i++) { 
	if ($i==1){	#CAST
		$cast_startpos = stripos($wiki_file, $cast_start_str, $castlist_startpos) + $cast_offset;
		$next_div_class_pos = stripos($wiki_file, "<div class=", $cast_startpos);#guests div class marker
	} else if ($i==2) { #GUESTS
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_endpos) + $cast_offset;
		$next_div_class_pos = stripos($wiki_file, "<div class=", $cast_startpos);#prod credits div class marker
	}
	$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
	$castrole_startpos = stripos ($wiki_file, $castrole_start_str, $cast_endpos) + $castrole_offset;
	$castrole_endpos = stripos ($wiki_file, $castrole_end_str, $castrole_startpos);
	$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos);#grab actor name
	
	while ($cast_startpos<$next_div_class_pos){
	#while((($i==1 &&(($cast_startpos<$guestslist_startpos) && ($castrole_startpos<$guestslist_startpos))) 	|| ($i==2 && (($cast_startpos<$credits_startpos) && ($castrole_startpos<$credits_startpos))))&&adsf){
		$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos);#grab actor name
		$ripped_castrole_str = substr($wiki_file, $castrole_startpos, $castrole_endpos - $castrole_startpos);
		if (!stripos($ripped_castrole,"<")) {
			$ripped_castrole_str = str_ireplace("as ", "", $ripped_castrole_str);
			$ripped_castrole_str = trim($ripped_castrole_str);
			#echo $ripped_castrole_str;
		} else {$ripped_castrole_str="";}
		
			?><tr>
			<td><input type="checkbox" name="delete[<?echo $num_cast;?>]" value="DELETE"></td>
			<td valign="top" colspan="1" ><?echo $num_cast;?>
			</td>
			<td valign="top" colspan="1" ><input type="text" size="50" name="cast_name[<?echo $num_cast;?>]" value="<?echo $ripped_cast_str;?>">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="25" name="cast_role[<?echo $num_cast;?>]" value="actor">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="50" name="cast_detail[<?echo $num_cast;?>]" value="<?echo $ripped_castrole_str;?>">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="3" maxlength="1" name="main_cast[<?echo $num_cast;?>]" value="0">
			</td>
			</tr><?
			
			
		
		
		/*echo "insert into cast (name_eng,drama_name_eng,cast_role,role_detail,main_actor) values (";
		echo "\"".$ripped_cast_str."\",\"".$series_name."\",\""."actor"."\",\"".$ripped_castrole_str;	
		if ($i==1) {echo "\",\"1\");";} else if ($i==2) {echo "\",\"0\");";}*/
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_startpos + $cast_offset) + $cast_offset;
		$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
		$castrole_startpos = stripos ($wiki_file, $castrole_start_str, $cast_endpos) + $castrole_offset;
		$castrole_endpos = stripos ($wiki_file, $castrole_end_str, $castrole_startpos);
		$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos);#grab actor name
		$num_cast++;
		$ripped_castrole_str=""; $ripped_cast_str="";
	}

}
$castrole=""; $ripped_castrole_str=""; $ripped_cast_str="";

#START GRABBING PRODUCTION CREDITS!
$next_div_class_pos = stripos($wiki_file, "<div class=", $cast_startpos);
$screenwriter_startpos = stripos($wiki_file, "Screenwriter", $credits_startpos); 
$producer_startpos = stripos($wiki_file, "Producer", $credits_startpos);
$director_startpos = stripos($wiki_file, "Director", $credits_startpos); 
$music_startpos = stripos($wiki_file, "Music:", $credits_startpos);
$planning_startpos = stripos($wiki_file, "Planning:", $credits_startpos);

for ($i=1;$i<=4;$i++) {
	$pass=false;
	if ($i==1 && $screenwriter_startpos) {
		#echo "SCREENWRITERS: ";
		$pass=true;
		$cast_startpos = stripos($wiki_file, $cast_start_str, $screenwriter_startpos) + $cast_offset; 
		$next_li_pos = stripos($wiki_file, "</li>", $screenwriter_startpos);
		$castrole="screenwriter";
	} else if ($i==2 && $producer_startpos) {
		#echo "PRODUCERS: ";
		$pass=true;
		$cast_startpos = stripos($wiki_file, $cast_start_str, $producer_startpos) + $cast_offset; 
		$next_li_pos = stripos($wiki_file, "</li>", $producer_startpos);
		$castrole="producer";
	} else if ($i==3 && $director_startpos) {
		#echo "DIRECTORS: ";
		$pass=true;
		$cast_startpos = stripos($wiki_file, $cast_start_str, $director_startpos) + $cast_offset; 
		$next_li_pos = stripos($wiki_file, "</li>", $director_startpos);
		$castrole="director";
	} else if ($i==4 && $music_startpos) {
		#echo "MUSIC: ";
		$pass=true;
		$cast_startpos = stripos($wiki_file, $cast_start_str, $music_startpos) + $cast_offset; 
		$next_li_pos = stripos($wiki_file, "</li>", $music_startpos);
		$castrole="music";
	} /*else if ($i==5) {
		echo "PLANNING: ";echo $planning_startpos;?><br /><?
		$cast_startpos = stripos($wiki_file, $cast_start_str, $planning_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $planning_startpos);
	}*/ #FUCK THE PLANNER! cuz dwiki cant spell plaNNNing!
	
	while (($cast_startpos<$next_li_pos) && ($cast_start_pos<$next_div_class_pos) && ($pass)) {
		$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
		$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); 
		
		#if ($cast_startpos<$next_li_pos) {echo ", ";}
		
		?><tr>
		<td><input type="checkbox" name="delete[<?echo $num_cast;?>]" value="DELETE"></td>
		<td valign="top" colspan="1" ><?echo $num_cast;?>
		</td>
		<td valign="top" colspan="1" ><input type="text" size="50" name="cast_name[<?echo $num_cast;?>]" value="<?echo $ripped_cast_str;?>">
		</td>
		<td valign="top" colspan="1" ><input type="text" size="25" name="cast_role[<?echo $num_cast;?>]" value="<?echo $castrole;?>">
		</td>
		<td valign="top" colspan="1" ><input type="text" size="50" name="cast_detail[<?echo $num_cast;?>]" value="<?echo $ripped_castrole_str;?>">
		</td>
		<td valign="top" colspan="1" ><input type="text" size="3" maxlength="1" name="main_cast[<?echo $num_cast;?>]" value="0">
		</td>
		</tr><?
		$num_cast++;
		
		#echo "insert into cast (name_eng,drama_name_eng,cast_role,role_detail,main_actor) values (";
		#echo "\"".$ripped_cast_str."\",\"".$series_name."\",\"".$castrole."\",\""."\",\"0\");";
		/*if ($i==1) {echo "screenwriter";} else if ($i==2) {echo "producer";} else if ($i==3){echo "director";} else if ($i==4){echo "music";}*/
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_startpos + $cast_offset) + $cast_offset;
		$ripped_cast_str="";
	}
	
}
?>
<tr>
<td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="25" align="center">#</td>
<td class="boldText" width="350" align="center">Cast Name</td>
<td class="boldText" width="150" align="center">Cast Role</td>
<td class="boldText" width="350" align="center">Cast Detail</td>
<td class="boldText" width="25" align="center">Main (0/1)</td>
</tr>
<tr><td colspan="6" width="100%">Add <input type="text" size="4" maxlength="4" name="add_rows" value="0"> more rows.</td></tr>
<tr><td align="center" width="100%" valign="top" colspan="6">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_cast" class="red">
</td></tr>
</table><?



/*	
	$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
	$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); echo $ripped_cast_str;?><br /><?

	$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
	$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); echo $ripped_cast_str;?><br /><?

	$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
	$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); echo $ripped_cast_str;?><br /><?

	$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
	$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); echo $ripped_cast_str;?><br /><?
*/


/* BELOW IS USED ALONE FOR PARSING WIKI PAGE ONLY for episode titles (NOT TO BE INCLUDED WITH VIDEO_PARTS.PHP)
$ep_start_str01 = "<td> 01";
$ep_start_str = "<td> ";
$ep_end_str = " </td><td> ";
$episode = 1;
$wiki_file = file_get_contents($wiki_page);
$title_startpos = stripos($wiki_file, $ep_start_str01.$ep_end_str) + strlen($ep_start_str01.$ep_end_str); 
$title_endpos = stripos($wiki_file, $ep_end_str, $title_startpos);
$title = substr($wiki_file, $title_startpos, $title_endpos - $title_startpos);

echo "(\"".$drama_name."\",\""."\"eps_type\",\"".$episode."\",\"".$title."\",\"\",\"\");";?><br /><?
$episode++;
if ($episode<10) { 
	$title_startpos = stripos($wiki_file, $ep_start_str."0".$episode, $title_startpos);
	$offset = strlen($ep_start_str."0".$episode.$ep_end_str);
} else { 
	$title_startpos = stripos($wiki_file, $ep_start_str.$episode, $title_startpos);
	$offset = strlen($ep_start_str.$episode.$ep_end_str);
}
while ($title_startpos>0){
	$title_startpos = $title_startpos + $offset;
	$title_endpos = stripos($wiki_file, $ep_end_str, $title_startpos);
	$title = substr($wiki_file, $title_startpos, $title_endpos - $title_startpos);

	echo "(\"".$drama_name."\",\""."\"eps_type\",\"".$episode."\",\"".$title."\",\"\",\"\");";?><br /><?
	$episode++;

	if ($episode<10) { 
		$title_startpos = stripos($wiki_file, $ep_start_str."0".$episode.$ep_end_str, $title_startpos);
		$offset = strlen($ep_start_str."0".$episode.$ep_end_str);
	} else { 
		$title_startpos = stripos($wiki_file, $ep_start_str.$episode.$ep_end_str, $title_startpos);
		$offset = strlen($ep_start_str.$episode.$ep_end_str);
	}
}


*/

#include('../_footer.php');


