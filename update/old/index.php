<?php
$today = "2009-02-27";
$drama_name = "Attention Please";
$drama_dir = "gokusen-3";
$wiki_page = "http://wiki.d-addicts.com/Attention_Please";
$wiki_capable = true;
/*
$target_domain = "http://www.mysoju.com";
$target_link = "http://www.mysoju.com/".$drama_dir."/";
include('get_drama_info.php');
$file = file_get_contents($target_link); #grab mysoju page
if ($wiki_capable) {$wiki_file = file_get_contents($wiki_page);} #grab wiki page if capable
include('video_parts.php'); #initiate sequence 'strip mysoju bare!'
*/

#grab cast info from wiki
if ($wiki_capable) {$wiki_file = file_get_contents($wiki_page);} #grab wiki page if capable


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

for ($i=1;$i<=2;$i++) { 
	if ($i==1){	#CAST
		?><br /><?echo "PARSING CAST: ";?><br /><?
		$cast_startpos = stripos($wiki_file, $cast_start_str, $castlist_startpos) + $cast_offset;
		$next_div_class_pos = stripos($wiki_file, "<div class=", $cast_startpos);#guests div class marker
	} else if ($i==2) { #GUESTS
		?><br /><?echo "PARSING GUESTS: ";?><br /><?
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_endpos);
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

		echo "insert into cast (name_eng,drama_name_eng,cast_role,role_detail,main_actor) values (";
		echo "\"".$ripped_cast_str."\",\"".$drama_name."\",\""."actor"."\",\"";
		if (!stripos($ripped_castrole,"<")) {
			$ripped_castrole_str = str_ireplace("as ", "", $ripped_castrole_str);
			
			echo $ripped_castrole_str;
		}
		echo "\",\"0\");";
		?><br /><?
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_startpos + $cast_offset) + $cast_offset;
		$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
		$castrole_startpos = stripos ($wiki_file, $castrole_start_str, $cast_endpos) + $castrole_offset;
		$castrole_endpos = stripos ($wiki_file, $castrole_end_str, $castrole_startpos);
		$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos);#grab actor name
	}
	?><br /><?
}

#START GRABBING PRODUCTION CREDITS!
echo "PARSING PRODUCTION CREDITS: "?><br /><?
$next_div_class_pos = stripos($wiki_file, "<div class=", $cast_startpos);
$screenwriter_startpos = stripos($wiki_file, "Screenwriter", $credits_startpos); 
$producer_startpos = stripos($wiki_file, "Producer", $credits_startpos);
$director_startpos = stripos($wiki_file, "Director", $credits_startpos); 
$music_startpos = stripos($wiki_file, "Music:", $credits_startpos);
$planning_startpos = stripos($wiki_file, "Planning:", $credits_startpos);

for ($i=1;$i<=4;$i++) {
	if ($i==1) {
		#echo "SCREENWRITERS: ";
		$cast_startpos = stripos($wiki_file, $cast_start_str, $screenwriter_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $screenwriter_startpos);
	} else if ($i==2) {
		#echo "PRODUCERS: ";
		$cast_startpos = stripos($wiki_file, $cast_start_str, $producer_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $producer_startpos);
	} else if ($i==3) {
		#echo "DIRECTORS: ";
		$cast_startpos = stripos($wiki_file, $cast_start_str, $director_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $director_startpos);
	} else if ($i==4) {
		#echo "MUSIC: ";
		$cast_startpos = stripos($wiki_file, $cast_start_str, $music_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $music_startpos);
	} /*else if ($i==5) {
		echo "PLANNING: ";echo $planning_startpos;?><br /><?
		$cast_startpos = stripos($wiki_file, $cast_start_str, $planning_startpos) + $cast_offset;
		$next_li_pos = stripos($wiki_file, "</li>", $planning_startpos);
	}*/ #FUCK THE PLANNER! cuz dwiki cant spell plaNNNing!

	while (($cast_startpos<$next_li_pos) && ($cast_start_pos<$next_div_class_pos)) {
		$cast_endpos = stripos ($wiki_file, $cast_end_str, $cast_startpos);
		$ripped_cast_str = substr($wiki_file, $cast_startpos, $cast_endpos - $cast_startpos); 
		echo "insert into cast (name_eng,drama_name_eng,cast_role,role_detail,main_actor) values (";
		echo "\"".$ripped_cast_str."\",\"".$drama_name."\",\"";
		if ($i==1) {echo "screenwriter";} else if ($i==2) {echo "producer";} else if ($i==3){echo "director";} else if ($i==4){echo "music";}
		echo "\",\""."\",\"0\");";
		$cast_startpos = stripos($wiki_file, $cast_start_str, $cast_startpos + $cast_offset) + $cast_offset;
		#if ($cast_startpos<$next_li_pos) {echo ", ";}
		?><br /><?
	}
	
}




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
?>

