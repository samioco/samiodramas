<?php

?>
<br />
<table width="1000" align="center" border="2" cellpadding="5">
<tr>
	<td valign="top">Series Name (English):</td>
	<td valign="top" colspan="4" ><input type="text" size="150" name="series_name_eng" value="<?echo $series_name_eng;?>"></td>
</tr><tr>
	<td valign="top">Series Name (Asian):</td>
	<td valign="top" colspan="4" ><input type="text" size="150" name="series_name_asian" value="<?echo $series_name_asian;?>"></td>

</tr><tr>
	<td valign="top">Series type:</td>
	<td valign="top"	><select name="series_type">
		<option value="j-drama" <?if ($series_type=="j-drama")echo "selected";?>>j-drama</option>
		<option value="j-movie" <?if ($series_type=="j-movie")echo "selected";?>>j-movie</option>
		<option value="hk-drama" <?if ($series_type=="hk-drama")echo "selected";?>>hk-drama</option>
		<option value="hk-movie" <?if ($series_type=="hk-movie")echo "selected";?>>hk-movie</option>
		<option value="k-drama" <?if ($series_type=="k-drama")echo "selected";?>>k-drama</option>
		<option value="k-movie" <?if ($series_type=="k-movie")echo "selected";?>>k-movie</option>
		<option value="tw-drama" <?if ($series_type=="tw-drama")echo "selected";?>>tw-drama</option>
		<option value="tw-movie" <?if ($series_type=="tw-movie")echo "selected";?>>tw-movie</option>
		<option value="ch-drama" <?if ($series_type=="ch-drama")echo "selected";?>>ch-drama</option>
		<option value="ch-movie" <?if ($series_type=="ch-movie")echo "selected";?>>ch-movie</option>
		</select></td>
	<td valign="top">Language:</td>
	<td valign="top"	><select name="language">
		<option value="Japanese" <?if (($series_type=="j-drama")||($series_type=="j-movie"))echo "selected";?>>Japanese</option>
		<option value="Korean" <?if (($series_type=="k-drama")||($series_type=="k-movie"))echo "selected";?>>Korean</option>
		<option value="Taiwanese" <?if (($series_type=="tw-drama")||($series_type=="tw-movie"))echo "selected";?>>Taiwanese</option>
		<option value="Chinese (Mandarin)" <?if (($series_type=="ch-drama")||($series_type=="ch-movie"))echo "selected";?>>Mandarin</option>
		<option value="Chinese (Cantonese)" <?if (($series_type=="hk-drama") ||($series_type=="hk-movie"))echo "selected";?>>Cantonese</option>
		</select></td>
	<td valign="top">Subtitles:</td>
	<td valign="top"><select name="subtitles">
		<option value="English" <?if ($subtitles=="English")echo "selected";?>>English</option>
		<option value="Japanese" <?if ($subtitles=="Japanese")echo "selected";?>>Japanese</option>
		<option value="Korean" <?if ($subtitles=="Korean")echo "selected";?>>Korean</option>
		<option value="Chinese" <?if ($subtitles=="Chinese")echo "selected";?>>Chinese</option>
</tr><tr>
	<td valign="top">samio_dir_name: </td>
	<td valign="top" colspan="4" ><input type="text" size="150" name="dir_name" value="<?echo $dir_name;?>"></td>
</tr><tr>
	<td valign="top">Broadcast: </td>
	<td valign="top" colspan="4" ><input type="text" size="10" maxlength="10" name="start_date" value="<?if (strlen($start_date)>0) echo $start_date; else echo "0000-00-00";?>">
		to <input type="text" size="10" maxlength="10" name="end_date" value="<?if (strlen($end_date)>0) echo $end_date; else echo "0000-00-00";?>"></td>
</tr><tr>
	<td valign="top">Network: </td>
	<td valign="top" colspan="1" ><input type="text" size="150" name="network" value="<?echo $network;?>"></td>
	<td valign="top">Viewership Rating:</td>
	<td valign="top" colspan="1" ><input type="text" size="150" name="rating" value="<?echo $rating;?>"></td>
	<td valign="top">Official site:</td>
	<td valign="top" colspan="1" ><input type="text" size="150" name="site" value="<?echo $site;?>"></td>
</tr><tr>
	<td valign="top">Synopsis:</td>
	<td valign="top" colspan="4" ><textarea rows="10" cols="150" name="synopsis" wrap="physical"><?echo stripslashes($synopsis);?></textarea></td>
</tr>

<tr><td align="center" width="100%" valign="top" colspan="5">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_main" class="red">
</td></tr>
</table>

<table width="1000" align="center" border="2" cellpadding="5">
<tr>
<td align="center" width="150" valign="top">
<input type="submit" value="GRAB Episode Titles" name="ep_titles" class="red">
</td>
<td align="center" width="150" valign="top">
<input type="submit" value="GRAB Video links" name="videos" class="red">
</td>
<td align="center" width="150" valign="top">
<input type="submit" value="CAST / CREDITS" name="credits" class="red">
</td>
<td align="center" width="150" valign="top">
<input type="submit" value="AWARDS" name="awards" class="red">
</td>

<td align="center" width="150" valign="top">
<input type="submit" value="RESET" name="reset" class="red">
</td>
</tr>
</table>
<br />

