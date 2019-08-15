<?php

?>
<table width="1000" align="center" border="0" cellpadding="2">
<tr>
<td width="800" align="left" class="bigBold" valign="center" colspan="2">Update Form:</td>
<td width="100"align="right" valign="center">Today:</td>
	<td width="100"  colspan="1" align="right" valign="top"><input type="text" size="10" maxlength="10" name="today" value="<? echo Date("Y-m-d"); ?>"></td>
</tr>
</table>

<table width="1000" align="center" border="1" cellpadding="2">
<tr>
	<td colspan="1" valign="top">D-addicts page (*required):</td>
	<td valign="top" colspan="3" ><input type="text" size="50" name="wiki_page" value="<?echo $wiki_page;?>"></td>
	<td colspan="1" valign="top">Mysoju page (*required):</td>
	<td valign="top" colspan="3" ><input type="text" size="50" name="mysoju_page" value="<?echo $mysoju_page;?>">
	</td>
</tr><tr>
	<td colspan="1" valign="top">Anime-Fart page (*required):</td>
	<td valign="top" colspan="3" ><input type="text" size="50" name="a-f_page" value="<?echo $a_f_page;?>"></td>
	<td colspan="1" valign="top">Wikipedia Naruto Shippuden page (*required):</td>
	<td valign="top" colspan="3" ><input type="text" size="50" name="naruto_shippuden_page" value="<?echo $naruto_shippuden_page;?>"></td>
</tr><tr>
	
</tr>
</table>
<table width="1000" align="center" border="0" cellpadding="2">
<tr>
<td align="left" width="50%" valign="top" colspan="1">
	<input type="submit" value="D-Addicts: POPULATE FORM" name="d-addicts" class="red">
</td>
<td align="left" width="50%" valign="top" colspan="1">
	<input type="submit" value="Anime-Fart: POPULATE FORM" name="anime-fart" class="red">
</td>
<td align="right" width="50%" valign="top" colspan="1">
<input type="submit" value="RESET" name="reset" class="red">
</td>
</tr>
</table>
