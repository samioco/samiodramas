<?php

?>
<br />
<table width="1000" align="center" border="2" cellpadding="5">
<tr>
	<td valign="top">Series Name (English):</td>
	<td valign="top" colspan="1" ><input type="text" size="50" name="series_name_eng" value="<?echo $series_name_eng;?>"></td>
	<td valign="top">Series Name (Asian):</td>
	<td valign="top" colspan="1" ><input type="text" size="50" name="series_name_asian" value="<?echo $series_name_asian;?>"></td>

</tr><tr>
	<td valign="top">Series type:</td>
	<td valign="top"><select name="series_type">
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
		<option value="anime" <?if ($series_type=="anime")echo "selected";?>>anime</option>
		</select></td>
	<td valign="top">Language:</td>
	<td valign="top"><select name="language">
		<option value="Japanese" <?if ($language=="Japanese")echo "selected";?>>Japanese</option>
		<option value="Korean" <?if ($language=="Korean")echo "selected";?>>Korean</option>
		<option value="Taiwanese" <?if ($language=="Taiwanese")echo "selected";?>>Taiwanese</option>
		<option value="Mandarin" <?if ($language=="Mandarin")echo "selected";?>>Mandarin</option>
		<option value="Cantonese" <?if ($language=="Cantonese")echo "selected";?>>Cantonese</option>
		</select></td>
</tr><tr>
	<td valign="top">Subtitles:</td>
	<td valign="top"><select name="subtitles">
		<option value="English" <?if ($subtitles=="English")echo "selected";?>>English</option>
		<option value="Japanese" <?if ($subtitles=="Japanese")echo "selected";?>>Japanese</option>
		<option value="Korean" <?if ($subtitles=="Korean")echo "selected";?>>Korean</option>
		<option value="Chinese" <?if ($subtitles=="Chinese")echo "selected";?>>Chinese</option>
		</select></td>
	<td valign="top">samio_dir_name: </td>
	<td valign="top" colspan="4" ><input type="text" size="50" name="dir_name" value="<?echo $dir_name;?>"></td>
</tr><tr>
	<td valign="top">Network: </td>
	<td valign="top" colspan="1" ><input type="text" size="25" name="network" value="<?echo $network;?>"></td>
	<td valign="top">Broadcast: </td>
	<td valign="top" colspan="1" ><input type="text" size="10" maxlength="10" name="start_date" value="<?if (strlen($start_date)>0) echo $start_date; else echo "0000-00-00";?>">
		to <input type="text" size="10" maxlength="10" name="end_date" value="<?if (strlen($end_date)>0) echo $end_date; else echo "0000-00-00";?>"></td>
</tr><tr>
	<td valign="top">Official site:</td>
	<td valign="top" colspan="1" ><input type="text" size="25" name="site" value="<?echo $site;?>"></td>
	<td valign="top">Viewership Rating:</td>
	<td valign="top" colspan="1" ><input type="text" size="25" name="rating" value="<?echo $rating;?>"></td>
</tr>

<tr>
	<td valign="top">Alt Titles:</td>
	<td valign="top" colspan="1" ><textarea rows="8" cols="50" name="alt_titles" wrap="physical"><?echo stripslashes($alt_titles);?></textarea></td>
	<td valign="top">Synopsis:</td>
	<td valign="top" colspan="3" ><textarea rows="8" cols="75" name="synopsis" wrap="physical"><?echo stripslashes($synopsis);?></textarea></td>
</tr>
	<td>Genres:</td>
	<td><textarea rows="4" cols="50" name="genres" wrap="physical"><?echo stripslashes($genres);?></textarea></td>
	<td>Songs:</td>
	<td><textarea rows="4" cols="75" name="songs" wrap="physical"><?echo stripslashes($songs);?></textarea></td>
<tr>
	
</tr>


<tr><td align="center" width="100%" valign="top" colspan="4">
	<input type="submit" value="Preview SQL INSERT command" name="sql_insert_main" class="red">
</td></tr>
</table>

<table width="1000" align="center" border="2" cellpadding="5">
<tr>
<td align="center" width="150" valign="top">
<input type="submit" value="GRAB Episode Titles" name="ep_titles" class="red">
<br />
<input type="submit" value="Wiki Nar-Ship Ep Titles" name="naruto_shippuden_ep_titles" class="red">
</td>
<td align="center" width="150" valign="top">
<input type="submit" value="MySoju Video links" name="mysoju_videos" class="red">
<br />
<input type="submit" value="Anime-Fart Video links" name="anime-fart_videos" class="red">

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
