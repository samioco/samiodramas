<?php
#already have mysoju full drama url. need to split into sub-dir
$target_domain="http://animefart.com";

$a_f_dir=$dir_name;
#$a_f_dir = substr($a_f_page, strlen($target_domain), strlen($a_f_page) - strlen($target_domain));
#$a_f_dir = str_ireplace("/","",$a_f_dir);

$file = file_get_contents($a_f_page); #grab mysoju page
$video_start_str = "<embed src=\"";
$video_end_str = "\"";

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

for ($i=1;$i<=1;$i++) {
	if ($i==1){
		$eps_type = "episode";
		$target_start_str = $target_domain."/".$a_f_dir."/";
	}/* else if ($i==2) {#special (only single special exists)
		$eps_type = "special";
		$target_start_str = "/".$a_f_dir."/".$eps_type."/part-";
	} else if ($i==3) {#special (multiple specials exist)
		$eps_type = "special";
		$target_start_str = "/".$a_f_dir."/".$eps_type."-episode-";
	} else if ($i==4) {#movie format
		$eps_type = "movie";
		$target_start_str = "/".$a_f_dir."/the-movie/part-";
	}*/
	#echo $target_start_str;
	$target_end_str = "\"";
	
	$target_str_startpos = stripos($file, $target_start_str); echo $target_str_startpos;?><br /><?
	$target_str_endpos = stripos($file, $target_end_str, $target_str_startpos);
	$ripped_str = substr($file, $target_str_startpos, $target_str_endpos - $target_str_startpos);
	$target_sub_link = trim($ripped_str);
	echo $target_sub_link;?><br /><?
	
	if ($target_str_startpos>0) {
		if ($i==1){#episode
			echo "here<br />";
			$ep_str_raw=substr($ripped_str,strlen($target_start_str),strlen($ripped_str)-strlen($target_start_str));
			$ep_str_raw=str_ireplace("-episode","",$ep_str_raw);
			$ep_startpos=stripos($ep_str_raw,"-")+strlen("-");
			$episode=substr($ep_str_raw,$ep_startpos,stripos($ep_str_raw,".")-$ep_startpos);
			echo $episode;?><br /><?
			$part=1;
		}
	}
	while (($target_str_startpos>0)) {
		#echo "NOW PARSING --> ".$target_sub_link;
		#echo "Type: ".$eps_type.", Episode: ".$episode.", Part: ".$part;
		#got drama_dir's episode part site!!! next, get episode#, part# and video link!
		echo "file_get_contents..<br />";
		$sub_file = file_get_contents($target_sub_link);
		$video_startpos = stripos($sub_file, $video_start_str) + strlen($video_start_str); #add start_string to startpos to start substr from desired location
		$video_endpos = stripos($sub_file, $video_end_str, $video_startpos);
		$length = $video_endpos - $video_startpos;
		#echo $video_startpos." ".$video_endpos." ".$length;
		$ripped_video_str = substr($sub_file, $video_startpos, $video_endpos - $video_startpos);
		echo $ripped_video_str."<br />";#1st video GOOD!
		
		$source_endpos = stripos($ripped_video_str, ".com");
		$source_startpos = stripos($ripped_video_str, ".") + strlen("."); 
		$source = substr($ripped_video_str, $source_startpos, $source_endpos - $source_startpos);
		$source = ucwords($source); 
		if($source=="Msn"){$source=strtoupper($source);} if($source=="Yimg"){$source="Yahoo";}
		
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
		/*
		while ($new_ripped_str == $ripped_str) {
			$target_str_startpos = stripos($file, $target_start_str, $target_str_endpos);
			$target_str_endpos = stripos($file, $target_end_str, $target_str_startpos);
			$new_ripped_str = substr($file, $target_str_startpos, $target_str_endpos - $target_str_startpos);
		}*/
		$ripped_str = $new_ripped_str;
		$target_sub_link = trim($ripped_str);
		echo $target_sub_link;?><br /><?
		if ($target_str_startpos>0) {
			if ($i==1){#episode
				echo "here<br />";
				$ep_str_raw=substr($ripped_str,strlen($target_start_str),strlen($ripped_str)-strlen($target_start_str));
				$ep_str_raw=str_ireplace("-episode","",$ep_str_raw);
				$ep_startpos=stripos($ep_str_raw,"-")+strlen("-");
				$episode=substr($ep_str_raw,$ep_startpos,stripos($ep_str_raw,".")-$ep_startpos);
				$part=1;
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
