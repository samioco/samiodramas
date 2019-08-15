<?php
	$delete_array=$_POST["delete"];
	$cast_name_array = $_POST["cast_name"]; 
	$cast_role_array = $_POST["cast_role"];
	$cast_detail_array = $_POST["cast_detail"];
	$main_cast_array = $_POST["main_cast"];
	$add_rows=$_POST["add_rows"];
	?><table width="1000" align="center" border="2" cellpadding="5">
	<tr>
	<td class="boldText" width="25" align="center">Delete</td>
	<td class="boldText" width="25" align="center">#</td>
	<td class="boldText" width="350" align="center">Cast Name</td>
	<td class="boldText" width="150" align="center">Cast Role</td>
	<td class="boldText" width="350" align="center">Cast Detail</td>
	<td class="boldText" width="25" align="center">Main (0/1)</td>
	</tr><?
	$row=1;
	$i=1;
	while ($cast_name_array[$i]) {
		if ($delete_array[$i]!="DELETE"){ 
			?><tr><td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
			<td><?echo $row;?></td>
			<td><input type="text" size="50" name="cast_name[<?echo $row;?>]" value="<?echo $cast_name_array[$i];?>"></td>
			<td><input type="text" size="25" name="cast_role[<?echo $row;?>]" value="<?echo $cast_role_array[$i];?>"></td>
			<td><input type="text" size="50" name="cast_detail[<?echo $row;?>]" value="<?echo $cast_detail_array[$i];?>"></td>
			<td><input type="text" size="3" maxlength="1" name="main_cast[<?echo $row;?>]" value="<?echo $main_cast_array[$i];?>"></td>
			</tr><?
			$row++;
		}
		$i++;
	}
	
	for ($i=1;$i<=$add_rows;$i++) {
		?><tr><td><input type="checkbox" name="delete[<?echo $row;?>]" value="DELETE"></td>
		<td><?echo $row;?></td>
		<td><input type="text" size="50" name="cast_name[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="25" name="cast_role[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="50" name="cast_detail[<?echo $row;?>]" value=""></td>
		<td><input type="text" size="3" maxlength="1" name="main_cast[<?echo $row;?>]" value=""></td>
		</tr><?
		$row++;
	}
	
	?>
	<tr><td class="boldText" width="25" align="center">Delete</td>
	<td colspan="6" width="100%">Add <input type="text" size="2" maxlength="2" name="add_rows" value="0"> more rows.</td></tr>
	<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_cast" class="red">
	</td></tr>
	</table>
	<br /><br /><?
	$i=1;
	#ECHO OUT the INSERT STATEMENTS!
	while ($cast_name_array[$i]) {
		if ($delete_array[$i]!="DELETE"){ 
			echo "insert into cast (name_eng,drama_name_eng,cast_role,role_detail,main_actor) values (";
			echo "\"".$cast_name_array[$i]."\",\"".$series_name."\",\"".$cast_role_array[$i]."\",\"".$cast_detail_array[$i]."\",\"".$main_cast_array[$i]."\");";	
			 ?><br /><?
		}
		$i++;
	}
	?><br /><br /><?
?>