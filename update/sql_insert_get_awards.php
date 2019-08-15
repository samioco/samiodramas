<?php

	$delete_array=$_POST["delete"];
	$name_array=$_POST["award_name"];
	$type_array=$_POST["award_type"];
	$winner_array=$_POST["award_winner"];
	$add_rows=$_POST["add_rows"];
	
	?><table width="850" align="center">
	<tr><td align="left" valign="top">
	<textarea rows="25" cols="175" name="sql_inserts" wrap="physical"><?
	$i=1;
	while ($name_array[$i]) {
		#echo $title_num_array[$i]." ".$title_array[$i];		
		if ($delete_array[$i]!="DELETE"){ 
			echo "insert into awards (award_name,category,winner,related_drama) values (";
			echo "\"".$name_array[$i]."\",\"".$type_array[$i]."\",\"".$winner_array[$i]."\",\"".$series_name_eng."\");";
			echo "\r\n";
		}
		$i++;
	}
	?></textarea></td>
	</tr></table>
	<br /><br /><?
	
	
	?><table width="1000" align="center" border="2" cellpadding="5">
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="300" align="center">Award Name</td>
	<td class="boldText" width="200" align="center">Category</td>
	<td class="boldText" width="200" align="center">Winner</td>
	</tr><?
	$i=1;
	$row=1;
	while ($name_array[$i]) {
		#echo $title_num_array[$i]." ".$title_array[$i];		
		if ($delete_array[$i]!="DELETE"){ 
			?><tr><td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td><?echo $row;?></td>
			<td valign="top"><input type="text" size="75" name="award_name[<?echo $row;?>]" value="<?echo stripslashes($name_array[$i]);?>"></td>
			<td valign="top"><input type="text" size="50" name="award_type[<?echo $row;?>]" value="<?echo stripslashes($type_array[$i]);?>"></td>
			<td valign="top"><input type="text" size="50" name="award_winner[<?echo $row;?>]" value="<?echo stripslashes($winner_array[$i]);?>"></td>
			</tr><?
			$row++;
		}
		$i++;
	}	
	for ($j=1;$j<=$add_rows;$j++) {
		?><tr><td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
		<td><?echo $row;?></td>
		<td valign="top"><input type="text" size="75" name="award_name[<?echo $row;?>]" value=""></td>
		<td valign="top"><input type="text" size="50" name="award_type[<?echo $row;?>]" value=""></td>
		<td valign="top"><input type="text" size="50" name="award_winner[<?echo $row;?>]" value=""></td>
		</tr><?
		$row++;
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
	
	
	
	