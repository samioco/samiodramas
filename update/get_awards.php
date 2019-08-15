<?php

	$wiki_file = file_get_contents($wiki_page);
	$awards_chart_start_str = "name=\"Recognitions\"";
	$awards_chart_startpos = stripos($wiki_file, $awards_chart_start_str);
	if ($awards_chart_startpos==0){
		$awards_chart_start_str = "name=\"Awards\"";
		$awards_chart_startpos = stripos($wiki_file, $awards_chart_start_str);
	}
	$next_div_pos = stripos($wiki_file, "<div class=", $awards_chart_startpos);
	$award_start_str = "<li>"; $offset = strlen($award_start_str);
	$award_end_str = "</li>";
	$award_startpos = stripos($wiki_file, $award_start_str, $awards_chart_startpos);
	
	?><table width="1000" align="center" border="2" cellpadding="5">
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="300" align="center">Award Name</td>
	<td class="boldText" width="200" align="center">Category</td>
	<td class="boldText" width="200" align="center">Winner</td>
	</tr><?
	
	$i=1;
	while (($award_startpos>0)&&($award_startpos<$next_div_pos)){
		$award_startpos += $offset;
		$award_endpos = stripos($wiki_file, $award_end_str, $award_startpos);
		$award = substr($wiki_file, $award_startpos, $award_endpos - $award_startpos);
		while ($href_startpos=stripos($award,"<a href")) {#remove all links from string
			$href_endpos=stripos($award,">",$href_startpos)+strlen(">");
			$href_str=substr($award,$href_startpos,$href_endpos-$href_startpos);
			$award=str_ireplace($href_str,"",$award);
			$award=str_ireplace("</a>","",$award);
		}
		$award=str_ireplace("<b>","",$award);$award=str_ireplace("</b>","",$award);#cleanup
		$award=str_ireplace("<i>","",$award);$award=str_ireplace("</i>","",$award);$award=trim($award);#cleanup
		
		$award_name=substr($award,0,stripos($award,":"));
		$award_type_startpos=stripos($award,":")+1;
		$award_winner=$series_name_eng;
		if(stripos($award,"-",$award_type_startpos)){#test for endpos of category, and if winner is specified.
			$award_type_endpos=stripos($award,"-",$award_type_startpos);
			$award_winner_startpos = $award_type_endpos + 1;
			$award_winner_endpos=strlen($award);
			$award_winner=substr($award,$award_winner_startpos,$award_winner_endpos-$award_winner_startpos);
			$award_winner=trim($award_winner);
		} else if (stripos($award,":",$award_type_startpos)){
			$award_type_endpos=stripos($award,":",$award_type_startpos);
			$award_winner_startpos = $award_type_endpos + 1;
			$award_winner_endpos=strlen($award);
			$award_winner=substr($award,$award_winner_startpos,$award_winner_endpos-$award_winner_startpos);
			$award_winner=trim($award_winner);
		} else {$award_type_endpos=strlen($award);}
		$award_type=substr($award,$award_type_startpos,$award_type_endpos-$award_type_startpos);
		$award_type=trim($award_type);
		
		?><tr><td><input type="checkbox" name="delete[<?echo $i;?>]" value="DELETE"></td>
		<td><?echo $i;?></td>
		<td valign="top"><input type="text" size="75" name="award_name[<?echo $i;?>]" value="<?echo $award_name;?>"></td>
		<td valign="top"><input type="text" size="50" name="award_type[<?echo $i;?>]" value="<?echo $award_type;?>"></td>
		<td valign="top"><input type="text" size="50" name="award_winner[<?echo $i;?>]" value="<?echo $award_winner;?>"></td>
		</tr><?
		
		
		
		
		/*echo "start: ".$award_startpos." end: ".$award_endpos." award: ".$award_name." :: ".$award_type;
		if ($award_winner!=$series_name_eng) {echo " : ".$award_winner;}
		?><br /><?
		*/
		$award_startpos = stripos($wiki_file, $award_start_str, $award_endpos);
		$i++;
	}
	
	?><tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="300" align="center">Award Name</td>
	<td class="boldText" width="200" align="center">Category</td>
	<td class="boldText" width="200" align="center">Winner</td></tr>
	<tr><td colspan="8" width="100%">Add <input type="text" size="2" maxlength="2" name="add_rows" value="0"> more rows.</td></tr>
	<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="UPDATE FORM / VIEW SQL INSERTS" name="sql_insert_awards" class="red">
	</td></tr>
	
	</table><br /><br /><?
	