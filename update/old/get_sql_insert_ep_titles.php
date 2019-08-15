<?php
	$delete_array=$_POST["delete"];
	$title_num_array = $_POST["ep_num"];
	$title_array = $_POST["ep_title"];
	$add_rows=$_POST["add_rows"];
	$column=$_POST["title_col"];
	
	?><table width="1000" align="center" border="2" cellpadding="5">
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="10" align="center">Episode #</td>
	<td class="boldText" width="100%" align="center" colspan="2"><?echo $series_name_eng." ";?>Episode Titles (from Episodes chart, column <?echo $column;?>)
	</td></tr><?
	$i=1;
	$row=1;
	while ($title_num_array[$i]) {
		#echo $title_num_array[$i]." ".$title_array[$i];		
		if ($delete_array[$i]!="DELETE"){ 
			?><tr>
			<td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td width="10" valign="top" colspan="1" ><input type="text" size="10" name="ep_num[<?echo $row;?>]" value="<?echo $title_num_array[$i];?>">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="150" name="ep_title[<?echo $row;?>]" value="<?echo stripslashes($title_array[$i]);?>">
			</td>
			</tr><?
			$row++;
		}
		$i++;
	}
	
	for ($j=1;$j<=$add_rows;$j++) {
		?><tr>
			<td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td width="10" valign="top" colspan="1" ><input type="text" size="10" name="ep_num[<?echo $row;?>]" value="<?echo $i;?>">
			</td>
			<td valign="top" colspan="1" ><input type="text" size="150" name="ep_title[<?echo $row;?>]" value="">
			</td>
		</tr><?
		$i++;
		$row++;
	}
	?>
	<tr><tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="10" align="center">Episode #</td>
	<td class="boldText" width="100%" align="center"><?echo $series_name_eng." ";?>Episode Titles</td></tr>
	<tr><td colspan="8" width="100%">Add <input type="text" size="2" maxlength="2" name="add_rows" value="0"> more rows.</td></tr>
	<tr><td align="center" width="100%" valign="top" colspan="3">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_ep_titles" class="red">
	</td></tr>
	</table>
	<br /><br /><?
	$i=1;
	while ($title_num_array[$i]) {
		if ($delete_array[$i]!="DELETE"){ 
			echo "insert into episodes (drama_name_eng,eps_type,eps_num,eps_title) values (";
			echo "\"".$series_name_eng."\",\""."episode"."\",\"".$title_num_array[$i]."\",\"".$title_array[$i]."\");";?><br /><?
		}
		$i++;
	}
	?><br /><br /><?
	