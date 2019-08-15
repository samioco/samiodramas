<?php
#already have mysoju full drama url. need to split into sub-dir
$target_domain="http://www.mysoju.com";


$mysoju_dir = substr($mysoju_page, strlen($target_domain), strlen($mysoju_page) - strlen($target_domain));
$mysoju_dir = str_ireplace("/","",$mysoju_dir);

$file = file_get_contents($mysoju_page); #grab mysoju page
$video_start_str = "<param name=\"movie\" value=\"";
$video_end_str = "\"/>";

$j=1;
?><table width="1000" align="center" border="2" cellpadding="5">
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="125" align="center">Ep. Type</td>
	<td class="boldText" width="100" align="center">Ep #</td>
	<td class="boldText" width="100" align="center">Part #</td>
	<td class="boldText" width="100" align="center">Source</td>
	<td class="boldText" width="25" align="center">Last?</td>
	<td class="boldText" width="500" align="center">Link</td>
	</tr><?

for ($i=1;$i<=4;$i++) {
	if ($i==1){
		$eps_type = "episode";
		$target_start_str = "/".$mysoju_dir."/".$eps_type."-";
	} else if ($i==2) {#special (only single special exists)
		$eps_type = "special";
		$target_start_str = "/".$mysoju_dir."/".$eps_type."/part-";
	} else if ($i==3) {#special (multiple specials exist)
		$eps_type = "special";
		$target_start_str = "/".$mysoju_dir."/".$eps_type."-episode-";
	} else if ($i==4) {#movie format
		$eps_type = "movie";
		$target_start_str = "/".$mysoju_dir."/the-movie/part-";
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
			
			#GET EPISODE TITLE FROM WIKI PAGE. This part was split into another function called GET EPISODES
			#if (($wiki_capable) &&($part==1)) {	include('get_wiki_title.php');}
			
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
		
		#echo "NOW PARSING --> ".$target_sub_link;
		#echo "Type: ".$eps_type.", Episode: ".$episode.", Part: ".$part;
		#got drama_dir's episode part site!!! next, get episode#, part# and video link!
		$sub_file = file_get_contents($target_sub_link);
		$video_startpos = stripos($sub_file, $video_start_str) + strlen($video_start_str); #add start_string to startpos to start substr from desired location
		$video_endpos = stripos($sub_file, $video_end_str, $video_startpos);
		$length = $video_endpos - $video_startpos;
		#echo $video_startpos." ".$video_endpos." ".$length;
		$ripped_video_str = substr($sub_file, $video_startpos, $video_endpos - $video_startpos);
		
		$source_endpos = stripos($ripped_video_str, ".com");
		/*$next_source_endpos=stripos($ripped_video_str,".com",$source_endpos)+strlen(".com");
		while($next_source_endpos>0){
			$source_endpos=$next_source_endpos;
			$next_source_endpos=stripos($ripped_video_str,".com",$next_source_endpos)+strlen(".com");
		}*/
		$source_startpos = stripos($ripped_video_str, ".") + strlen("."); 
		/*$next_source_startpos=stripos($ripped_video_str, ".",$source_startpos) + strlen(".");
		while($next_source_startpos<$source_endpos){
			$source_startpos=$next_source_startpos;
			$next_source_startpos=stripos($ripped_video_str, ".",$next_source_startpos) + strlen(".");
		}*/
		$source = substr($ripped_video_str, $source_startpos, $source_endpos - $source_startpos);
		$source = ucwords($source); 
		if($source=="Msn"){$source=strtoupper($source);} if($source=="Yimg"){$source="Yahoo";}
		#$video_type_startpos = stripos($ripped_video_str, );
		/*
		echo "insert into episode_parts (drama_name_eng,eps_type,eps_num,part_num,video_link,video_source,last) values (";
		echo "\"".$series_name_eng."\",\"".$eps_type."\",\"".$episode."\",\"".$part."\"";
		echo ",\"".$ripped_video_str."\",\"\",\"0\");";?><br /><?
		*/
		
		?><tr>
		<td><input type="checkbox" name="delete[<?echo $j;?>]" value="DELETE"></td>
		<td><?echo $j;?></td>
		<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $j;?>]">
			<option value="episode" <?if ($eps_type=="episode"){echo "SELECTED";}?>>episode</option>
			<option value="special" <?if ($eps_type=="special"){echo "SELECTED";}?>>special</option>
			<option value="movie" <?if ($eps_type=="movie"){echo "SELECTED";}?>>movie</option></td>
		
		<td><input type="text" size="5" name="eps_num[<?echo $j;?>]" value="<?echo $episode;?>"></td>
		<td><input type="text" size="5" name="part_num[<?echo $j;?>]" value="<?echo $part;?>"></td>
		<td><input type="text" size="10" name="source[<?echo $j;?>]" value="<?echo $source;?>"></td>
		<td><input type="text" size="1" name="last[<?echo $j;?>]" value="<?echo "0";?>"></td>
		<td><input type="text" size="75" name="link[<?echo $j;?>]" value="<?echo $ripped_video_str;?>"></td>
		</tr><?
		
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
				#if (($wiki_capable) &&($part==1)) {	include('get_wiki_title.php');}
				
				
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
		$j++;
		#if ($target_str_startpos==0) {echo "TARGET_STR_STARTPOS = 0!!!";}
		#if ($target_str_endpos==0) {echo "TARGET_STR_ENDPOS = 0!!!";}
	}#end: while (($target_str_startpos>0)) {

}#end: for ($i=1;$i<=4;$i++)
?>
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="125" align="center">Ep. Type</td>
	<td class="boldText" width="100" align="center">Ep #</td>
	<td class="boldText" width="100" align="center">Part #</td>
	<td class="boldText" width="100" align="center">Source</td>
	<td class="boldText" width="25" align="center">Last?</td>
	<td class="boldText" width="500" align="center">Link</td>
	</tr>
	<tr><td colspan="8" width="100%">Add <input type="text" size="4" maxlength="4" name="add_rows" value="0"> more rows.</td></tr>
	<tr><td align="center" width="100%" valign="top" colspan="8">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_ep_parts" class="red">
</td></tr></table>
<?
?><br /><br /><?
