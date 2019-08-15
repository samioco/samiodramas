<?php


#BELOW IS USED ALONE FOR PARSING WIKI PAGE ONLY for episode titles (NOT TO BE INCLUDED WITH VIDEO_PARTS.PHP)
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

/* FOR BEING REFERENCED FROM GET_VIDEO_PARTS.php
#$episode known
#$eps_type known
$ep_start_str = "<td> ";
$ep_end_str = " </td><td> ";

if ($episode<10) { 
	$title_startpos = stripos($wiki_file, $ep_start_str."0".$episode.$ep_end_str);
	$offset = strlen($ep_start_str."0".$episode.$ep_end_str);
} else { 
	$title_startpos = stripos($wiki_file, $ep_start_str.$episode.$ep_end_str);
	$offset = strlen($ep_start_str.$episode.$ep_end_str);
}
$title_startpos = $title_startpos + $offset;
$title_endpos = stripos($wiki_file, $ep_end_str, $title_startpos);
$title = substr($wiki_file, $title_startpos, $title_endpos - $title_startpos);

echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title,video_source,video_link) values (";
echo "\"".$drama_name."\",\"".$eps_type."\",\"".$episode."\",\"".$title."\",\"\",\"\");";?><br /><?

*/