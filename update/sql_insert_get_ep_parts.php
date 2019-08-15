<?php

	$type_array=$_POST["ep_type"]; 
	$delete_array=$_POST["delete"];
	$eps_num_array=$_POST["eps_num"];
	$part_num_array=$_POST["part_num"];
	$source_array=$_POST["source"];
	$last_array=$_POST["last"];
	$link_array=$_POST["link"];
	$add_rows=$_POST["add_rows"];
	$j=1;
	
	?><table width="850" align="center">
	<tr><td align="left" valign="top">
	<textarea rows="25" cols="175" name="sql_inserts" wrap="physical"><?
	while ($type_array[$j]){
		if ($delete_array[$j]!="DELETE"){ 
			
			echo "insert into episode_parts (drama_name_eng,eps_type,eps_num,part_num,video_link,video_source,last) values (";
			echo "\"".$series_name_eng."\",\"".$type_array[$j]."\",\"".$eps_num_array[$j]."\",\"".$part_num_array[$j]."\"";
			echo ",\"".$link_array[$j]."\",\"".$source_array[$j]."\",\"".$last_array[$j]."\");";
			echo "\r\n";
		}
		$j++;
	}
	?></textarea></td>
	</tr></table><br /><br /><?
	
	
	
	#$deleted=0;
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
	$j=1;
	$row=1;
	while ($type_array[$j]){
		if ($delete_array[$j]!="DELETE"){ 
			?><tr>
			<td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td><?echo $row;?></td>
			<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
				<option value="episode"<?if ($type_array[$j]=="episode"){echo "selected";}?>>episode</option>
				<option value="special"<?if ($type_array[$j]=="special"){echo "selected";}?>>special</option>
				<option value="movie"<?if ($type_array[$j]=="movie"){echo "selected";}?>>movie</option></td>
			
			<td><input type="text" size="3" name="eps_num[<?echo $row;?>]" value="<?echo $eps_num_array[$j];?>"></td>
			<td><input type="text" size="3" name="part_num[<?echo $row;?>]" value="<?echo $part_num_array[$j];?>"></td>
			<td><input type="text" size="5" name="source[<?echo $row;?>]" value="<?echo $source_array[$j];?>"></td>
			<td><input type="text" size="1" name="last[<?echo $row;?>]" value="<?echo $last_array[$j];?>"></td>
			<td><input type="text" size="75" name="link[<?echo $row;?>]" value="<?echo $link_array[$j];?>"></td>
			</tr><?
			$row++;
		}
		$j++;
	}
	
	for ($i=1;$i<=$add_rows;$i++) {
		?><tr>
		<td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
		<td><?echo $row;?></td>
		<td width="10" valign="top" colspan="1" ><select name="ep_type[<?echo $row;?>]">
			<option value="episode">episode</option>
			<option value="special">special</option>
			<option value="movie">movie</option></td>
		<td><input type="text" size="3" name="eps_num[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="3" name="part_num[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="5" name="source[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="1" name="last[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="75" name="link[<?echo $row;?>]" value=""></td>
		</tr><?
		$row++;
	}
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
	<br /><br /><?
	
	
	