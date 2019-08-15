<?php
	$delete_array=$_POST["delete"];
	$title_num_array = $_POST["ep_num"];
	$type_array=$_POST["ep_type"];
	$title_array = $_POST["ep_title"];
	$add_rows=$_POST["add_rows"];
	$column=$_POST["title_col"];
	$plot_array=$_POST["ep_plot"];
	
	?><table width="850" align="center">
	<tr><td align="left" valign="top">
	<textarea rows="25" cols="175" name="sql_inserts" wrap="physical"><?
	$i=1;
	while ($title_num_array[$i]) {
		if ($delete_array[$i]!="DELETE"){ 
			$q=mysql_query("SELECT * FROM episodes WHERE drama_name_eng='$series_name_noslash' AND eps_type='$type_array[$i]' AND eps_num='$title_num_array[$i]'");
			if (mysql_num_rows($q)==0){
				echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title,eps_plot) values (";
				echo "\"".$series_name_eng."\",\"".$type_array[$i]."\",\"".$title_num_array[$i]."\",\"".$title_array[$i]."\",\"".$plot_array[$i]."\");";
			} else {
				#$q=$mysql_query("UPDATE episodes SET eps_title='$title_array[$i]' WHERE drama_name_eng='$series_name_eng' AND eps_type='$type_array[$i]' AND eps_num='$title_num_array[$i]'");
				#$r=mysql_query($q);
				echo "UPDATE episodes SET eps_title='$title_array[$i]',eps_plot='$plot_array[$i]' WHERE drama_name_eng='$series_name_noslash' AND eps_type='$type_array[$i]' AND eps_num='$title_num_array[$i]';";
			}
			echo "\r\n";
		}
		$i++;
	}
	?></textarea></td>
	</tr></table><br /><?
	
	
	?><table width="1000" align="center" border="2" cellpadding="5">
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="100" align="center">Episode Type</td>
	<td class="boldText" width="10" align="center">Episode #</td>
	<td class="boldText" width="200" align="center" colspan="1"><?echo $series_name_eng." ";?>Episode Titles (from Episodes chart, column <?echo $column;?>)
	</td>
	<td class="boldText" width="100%" align="center" colspan="1">Episode Plot</td></tr><?
	$i=1;
	$row=1;
	while ($title_num_array[$i]) {
		#echo $title_num_array[$i]." ".$title_array[$i];		
		if ($delete_array[$i]!="DELETE"){ 
			?><tr>
			<td valign="top"><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
				<option value="episode"<?if ($type_array[$i]=="episode"){echo "selected";}?>>episode</option>
				<option value="special"<?if ($type_array[$i]=="special"){echo "selected";}?>>special</option>
				<option value="movie"<?if ($type_array[$i]=="movie"){echo "selected";}?>>movie</option></td>
			<td width="10" valign="top" colspan="1" ><input type="text" size="10" name="ep_num[<?echo $row;?>]" value="<?echo $title_num_array[$i];?>">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="50" name="ep_title[<?echo $row;?>]" value="<?echo stripslashes($title_array[$i]);?>">
			</td>
			<td valign="top" colspan="1" >
			<textarea rows="3" cols="75" name="ep_plot[<?echo $row;?>]" wrap="physical"><?echo stripslashes($plot_array[$i]);?></textarea></td>
			</tr><?
			$row++;
		}
		$i++;
	}
	
	for ($j=1;$j<=$add_rows;$j++) {
		?><tr>
			<td valign="top"><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
				<option value="episode">episode</option><option value="special">special</option><option value="movie">movie</option></td>
			<td width="10" valign="top" colspan="1"><input type="text" size="10" name="ep_num[<?echo $row;?>]" value="<?echo $i;?>">
			</td>
			<td valign="top" colspan="1"><input type="text" size="50" name="ep_title[<?echo $row;?>]" value="">
			</td>
			<td valign="top" colspan="1" >
			<textarea rows="3" cols="75" name="ep_plot[<?echo $row;?>]" wrap="physical"></textarea></td>
		</tr><?
		$i++;
		$row++;
	}
	?>
	<tr><tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="100" align="center">Episode Type</td>
	<td class="boldText" width="10" align="center">Episode #</td>
		<td class="boldText" width="200" align="center" colspan="1"><?echo $series_name_eng." ";?>Episode Titles (from Episodes chart, column <?echo $column;?>)
	</td>
	<td class="boldText" width="100%" align="center" colspan="1">Episode Plot</td></tr>
	<tr><td colspan="8" width="100%">Add <input type="text" size="4" maxlength="4" name="add_rows" value="0"> more rows.</td></tr>
	<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_ep_titles" class="red">
	</td></tr>
	</table>
	<br /><br /><?
	
	
	