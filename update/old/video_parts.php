<?php
$video_start_str = "<param name=\"movie\" value=\"";
$video_end_str = "\"/>";

for ($i=1;$i<=4;$i++) {
	if ($i==1){
		$eps_type = "episode";
		$target_start_str = "/".$drama_dir."/".$eps_type."-";
	} else if ($i==2) {#special (only single special exists)
		$eps_type = "special";
		$target_start_str = "/".$drama_dir."/".$eps_type."/part-";
	} else if ($i==3) {#special (multiple specials exist)
		$eps_type = "special";
		$target_start_str = "/".$drama_dir."/".$eps_type."-episode-";
	} else if ($i==4) {#movie format
		$eps_type = "movie";
		$target_start_str = "/".$drama_dir."/the-movie/part-";
	}
	
	$target_end_str = "\"";
	
	$target_str_startpos = stripos($file, $target_start_str);
	$target_str_endpos = stripos($file, $target_end_str, $target_str_startpos);
	$ripped_str = substr($file, $target_str_startpos, $target_str_endpos - $target_str_startpos);
	$target_sub_link = $target_domain.$ripped_str;
	
	if ($target_str_startpos>0) {
		if ($i==1){#episode
			$ep_startpos = strlen($target_start_str);
			$episode = substr($ripped_str, $ep_startpos, stripos($ripped_str, "/", $ep_startpos) - $ep_startpos);
			$part_startpos = strlen($target_start_str.$episode."/part-");
			$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
			
			#GET EPISODE TITLE FROM WIKI PAGE!!!
			if (($wiki_capable) &&($part==1)) {	include('get_wiki_title.php');}
			
		} else if ($i==2) { #special (only single special exists)
			$part_startpos = strlen($target_start_str);
			$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
		} else if ($i==3) {#special (multiple specials exist)
			$ep_startpos = strlen($target_start_str);
			$episode = substr($ripped_str, $ep_startpos, stripos($ripped_str, "/", $ep_startpos) - $ep_startpos);
			$part_startpos = strlen($target_start_str.$episode."/part-");
			$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
		} else if ($i==4) {#movie format ( only single movie exists)
			$part_startpos = strlen($target_start_str);
			$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
		}	
	}

	#while ((strlen($checked_str)>0)) {
	while (($target_str_startpos>0)) {
		echo "insert into episode_parts (drama_name_eng,eps_type,eps_num,part_num,video_link,video_source,last) values (";
		echo "\"".$drama_name."\",\"".$eps_type."\",\"".$episode."\",\"".$part."\"";
		#echo "NOW PARSING --> ".$target_sub_link;
		#echo "Type: ".$eps_type.", Episode: ".$episode.", Part: ".$part;
		#got drama_dir's episode part site!!! next, get episode#, part# and video link!
		$sub_file = file_get_contents($target_sub_link);
		$video_startpos = stripos($sub_file, $video_start_str) + strlen($video_start_str); #add start_string to startpos to start substr from desired location
		$video_endpos = stripos($sub_file, $video_end_str, $video_startpos);
		$length = $video_endpos - $video_startpos;
		#echo $video_startpos." ".$video_endpos." ".$length;
		$ripped_video_str = substr($sub_file, $video_startpos, $video_endpos - $video_startpos);
		#$video_type_startpos = stripos($ripped_video_str, );
		echo ",\"".$ripped_video_str."\",\"\",\"0\");";?><br /><?
		
		$target_str_startpos = stripos($file, $target_start_str, $target_str_endpos);
		if ($target_str_startpos>0) {$target_str_endpos = stripos($file, $target_end_str, $target_str_startpos);} else {$target_str_endpos = 0;}
		$new_ripped_str = substr($file, $target_str_startpos, $target_str_endpos - $target_str_startpos);
		
		while ($new_ripped_str == $ripped_str) {
			$target_str_startpos = stripos($file, $target_start_str, $target_str_endpos);
			$target_str_endpos = stripos($file, $target_end_str, $target_str_startpos);
			$new_ripped_str = substr($file, $target_str_startpos, $target_str_endpos - $target_str_startpos);
		}
		$ripped_str = $new_ripped_str;
		$target_sub_link = $target_domain.$ripped_str;
		
		if ($target_str_startpos>0) {
			if ($i==1){#episode
				$ep_startpos = strlen($target_start_str);
				$episode = substr($ripped_str, $ep_startpos, stripos($ripped_str, "/", $ep_startpos) - $ep_startpos);
				$part_startpos = strlen($target_start_str.$episode."/part-");
				$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
				#GET EPISODE TITLE FROM WIKI PAGE!!!
				if (($wiki_capable) &&($part==1)) {	include('get_wiki_title.php');}
				
				
			} else if ($i==2) { #special (only single special exists)
				$part_startpos = strlen($target_start_str);
				$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
			} else if ($i==3) {#special (multiple specials exist)
				$ep_startpos = strlen($target_start_str);
				$episode = substr($ripped_str, $ep_startpos, stripos($ripped_str, "/", $ep_startpos) - $ep_startpos);
				$part_startpos = strlen($target_start_str.$episode."/part-");
				$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
			} else if ($i==4) {#movie format
				$part_startpos = strlen($target_start_str);
				$part = substr($ripped_str, $part_startpos, stripos($ripped_str, "/", $part_startpos) - $part_startpos);
			}	
		}
		#if ($target_str_startpos==0) {echo "TARGET_STR_STARTPOS = 0!!!";}
		#if ($target_str_endpos==0) {echo "TARGET_STR_ENDPOS = 0!!!";}
	}#end: while (($target_str_startpos>0)) {

}#end: for ($i=1;$i<=3;$i++)
