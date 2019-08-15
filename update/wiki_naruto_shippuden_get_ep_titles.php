<?php

#BELOW IS USED ALONE FOR PARSING WIKI PAGE ONLY for episode titles (NOT TO BE INCLUDED WITH VIDEO_PARTS.PHP)
$file = file_get_contents($naruto_shippuden_page);


#LOCATE EPISODE TITLE INFORMATION CHART START and END
$chart_start_str = "Edit section: Episode Listing";
$chart_startpos = stripos($file, $chart_start_str); #GIVEN - NEVER CHANGES



$episode = 1;
$row=1;
$offset=strlen("id=\"".$ep."\">");
$ep_startpos=stripos($file,"id=\"ep".$episode."\">",$chart_startpos);#start searching from beginning of episode chart
?>
<br />
<table width="1000" align="center" border="2" cellpadding="5">
<tr><td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="100" align="center">Episode Type</td>
<td class="boldText" width="25" align="center">Ep #</td>
<td class="boldText" width="200" align="center" colspan="1"><?echo $series_name_eng." ";?>Titles</td>
<td class="boldText" width="100%" align="center" colspan="1">Episode Plot</td>
</tr><?
echo $ep_startpos;?><br /><?
while ($ep_startpos>0){
	$ep_startpos=$ep_startpos+$offset;
	$title_startpos=stripos($file,"<b>\"",$ep_startpos) + strlen("<b>\"");
	$title_endpos=stripos($file,"\"</b>",$title_startpos);
	$title="<b>".trim(substr($file,$title_startpos,$title_endpos-$title_startpos))."</b>";
	$title_asian_startpos=stripos($file,"<i>\"",$title_endpos) + strlen("<i>\"");
	$title_asian_endpos=stripos($file,"\"</i>",$title_asian_startpos);
	$title_asian=trim(substr($file,$title_asian_startpos,$title_asian_endpos-$title_asian_startpos));
	$asian_char_startpos=stripos($file,"<span",$title_asian_endpos);
	$asian_char_startpos=stripos($file,">",$asian_char_startpos)+strlen(">");
	$asian_char_endpos=stripos($file,"</span>",$asian_char_startpos);
	$asian_char=substr($file,$asian_char_startpos,$asian_char_endpos-$asian_char_startpos);
	$title_asian=trim($title_asian." ".$asian_char);

	$ep_plot_startpos=stripos($file,"<td style=",$title_endpos);
	$ep_plot_startpos=stripos($file,">",$ep_plot_startpos)+strlen(">");
	$ep_plot_endpos=stripos($file,"&#160",$ep_plot_startpos);
	$ep_plot=trim(substr($file,$ep_plot_startpos,$ep_plot_endpos-$ep_plot_startpos));
	/*
	echo "ep#: ".$episode."<br />";
	echo "title: ".$title."<br />";
	echo "title_asian: ".$title_asian."<br />"; 
	echo "story: ".$ep_plot."<br />";
*/

	
	
	$title_array[$episode] = $title;
	$plot_array[$episode] = $ep_plot;
	
	?><tr>
	<td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
	<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
		<option value="episode">episode</option><option value="special">special</option><option value="movie">movie</option></td>
	<td width="10" valign="top" colspan="1" ><input type="text" size="3" name="ep_num[<?echo $row;?>]" value="<?echo $episode;?>">
	</td>
	<td valign="top" colspan="1" ><input type="text" size="50" name="ep_title[<?echo $row;?>]" value="<?echo $title." ".$title_asian;?>">
	</td>
	<td valign="top" colspan="1" >
	<textarea rows="3" cols="75" name="ep_plot[<?echo $row;?>]" wrap="physical"><?echo $ep_plot;?></textarea>
	</td>
	</tr><?
/*
	echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title) values (";
	echo "\"".$series_name_eng."\",\""."episode"."\",\"".$episode."\",\"".$title."\");";?><br /><?
*/
	$episode++;
	$row++;
	$ep_startpos=stripos($file,"id=\"ep".$episode."\">",$ep_startpos);	
}


?>
<tr><td class="boldText" width="25" align="center">Delete</td>
<td class="boldText" width="100" align="center">Episode Type</td>
<td class="boldText" width="25" align="center">Ep #</td>
<td class="boldText" width="200" align="center" colspan="1"><?echo $series_name_eng." ";?>Titles</td>
<td class="boldText" width="100%" align="center" colspan="1">Episode Plot</td>
</tr>
<tr><td colspan="3" width="30%">Add <input type="text" size="4" maxlength="4" name="add_rows" value="0"> more rows.</td>
<td width="70%" colspan="2" align="right"> Titles not showing properly? Try grabbing another column:
<input type="text" size="1" maxlength="1" name="title_col" value="<?echo $column;?>"><input type="submit" value="UPDATE Titles" name="ep_titles" class="red">
</td>
</tr>
<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="UPDATE FORM / VIEW SQL INSERTS" name="sql_insert_ep_titles" class="red">
</td></tr>
</table><?
?><br /><br /><?

