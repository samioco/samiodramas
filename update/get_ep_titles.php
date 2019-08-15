<?php

#$episode known from video_parts
#$eps_type known from video_parts

#BELOW IS USED ALONE FOR PARSING WIKI PAGE ONLY for episode titles (NOT TO BE INCLUDED WITH VIDEO_PARTS.PHP)
$wiki_file = file_get_contents($wiki_page);


#LOCATE EPISODE TITLE INFORMATION CHART START and END
$chart_start_str = "name=\"Episode_Information\"";
$chart_startpos = stripos($wiki_file, $chart_start_str); #GIVEN - NEVER CHANGES
$chart_next_div_pos = stripos($wiki_file, "<div", $chart_startpos); #GIVEN - NEVER CHANGES


#method 1: wiki template that uses SPACES between every tag
#$ep_start_str01 = "<td> 01";
#$ep_start_str = "<td> ";
$ep_end_str = "</td><td>";
$offset = strlen($ep_end_str);

if ($_POST["title_col"]) {$column = $_POST["title_col"];} else {$column =1;}
#method 2: wiki template that has NO SPACES between every tag
#

/*
$title_startpos = stripos($wiki_file, $ep_start_str01.$ep_end_str) + strlen($ep_start_str01.$ep_end_str); 
$title_endpos = stripos($wiki_file, $ep_end_str, $title_startpos);
$title = substr($wiki_file, $title_startpos, $title_endpos - $title_startpos);
echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title,video_source,video_link) values (";
echo "(\"".$series_name_eng."\",\""."episode"."\",\"".$episode."\",\"".$title."\",\"\",\"\");";?><br /><?
$episode++;
*/
$title_startpos = $chart_startpos; #start searching from beginning of episode chart
if ($episode<10) { 
	$title_startpos = stripos($wiki_file, "0".$episode, $title_startpos);#locate episode row
} else { 
	$title_startpos = stripos($wiki_file, "$episode", $title_startpos);#locate episode row
}
$title_startpos = stripos($wiki_file, $ep_end_str, $title_startpos); #ACTUAL ep_title_startpos begins after the </td><td> tag
if ($column>1) {
	for ($i=1;$i<$column;$i++) {$title_startpos = stripos($wiki_file, $ep_end_str, $title_startpos + strlen($ep_end_str));}
}
?>
<br />
<table width="1000" align="center" border="2" cellpadding="5">
<tr><td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="100" align="center">Episode Type</td>
<td class="boldText" width="25" align="center">Ep #</td>
<td class="boldText" width="100%" align="center" colspan="2"><?echo $series_name_eng." ";?>Episode Titles (from Episodes chart, column <?echo $column;?>)
</td></tr><?
$episode = 1;
$row=1;
while (($title_startpos>0) && ($title_startpos<$chart_next_div_pos)){
	$title_startpos += $offset;
	$title_endpos = stripos($wiki_file, $ep_end_str, $title_startpos);
	$title = substr($wiki_file, $title_startpos, $title_endpos - $title_startpos);
	$title = str_ireplace("<br />"," ",$title);
	$title = str_ireplace("&nbsp;"," ",$title);
	$title = trim($title);
	$title_array[$episode] = $title;
	?><tr>
	<td valign="top"><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
	<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
		<option value="episode">episode</option><option value="special">special</option><option value="movie">movie</option></td>
	<td width="10" valign="top" colspan="1" ><input type="text" size="3" name="ep_num[<?echo $row;?>]" value="<?echo $episode;?>">
	</td>
	<td valign="top" colspan="2" ><input type="text" size="150" name="ep_title[<?echo $row;?>]" value="<?echo $title;?>">
	</td>
	</tr><?
/*
	echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title) values (";
	echo "\"".$series_name_eng."\",\""."episode"."\",\"".$episode."\",\"".$title."\");";?><br /><?
*/
	$episode++;
	$row++;
	if ($episode<10) { 
		$title_startpos = stripos($wiki_file, "0".$episode, $title_startpos);#locate episode row
	} else { 
		$title_startpos = stripos($wiki_file, "$episode", $title_startpos);#locate episode row
	}
	$title_startpos = stripos($wiki_file, $ep_end_str, $title_startpos); #ACTUAL ep_title_startpos begins after the </td><td> tag
	if (($title_startpos>0) && ($title_startpos<$chart_next_div_pos)) {
		if ($column>1) {
			for ($i=1;$i<$column;$i++) {$title_startpos = stripos($wiki_file, $ep_end_str, $title_startpos + strlen($ep_end_str));}
		}
	}
	
}


?>
<tr><td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="100" align="center">Episode Type</td>
<td class="boldText" width="25" align="center">Ep #</td>
<td class="boldText" width="100%" align="center" colspan="2"><?echo $series_name_eng." ";?>Episode Titles</td>
</tr>
<tr><td colspan="3" width="30%">Add <input type="text" size="4" maxlength="4" name="add_rows" value="0"> more rows.</td>
<td width="70%" colspan="1" align="right"> Titles not showing properly? Try grabbing another column:
<input type="text" size="1" maxlength="1" name="title_col" value="<?echo $column;?>"><input type="submit" value="UPDATE Titles" name="ep_titles" class="red">
</td>
</tr>
<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="UPDATE FORM / VIEW SQL INSERTS" name="sql_insert_ep_titles" class="red">
</td></tr>
</table><?
?><br /><br /><?
/*for ($i=1;$i<$episode;$i++) {
	echo $i." ".$title_array[$i];?><br ><?
}*/

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