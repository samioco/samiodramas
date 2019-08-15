<?php 
?><table width="800" border="0" align="center" cellpadding="10"><?
$eps_q = mysql_query("SELECT * FROM episodes WHERE drama_name_eng='$drama_name_eng' AND eps_type='$eps_type' AND eps_num='$episode'");
if ($eps_q) {
	$eps_r = mysql_fetch_array($eps_q);
	?><tr><td colspan="2" class="bigBold" align="left">
	<?
	$title=$eps_r[eps_title];
	if (stripos($title,"<br />")) {
		$title=str_ireplace("<br />"," (",$title);
		$title=$title.")";
	}
	echo ucfirst($eps_type)." ".$episode.": ".$title.", Part ".$part.":";?>
	</td></tr><?
}
$part_q = mysql_query("SELECT * FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$eps_type' AND eps_num='$episode' AND part_num='$part'");
if ($part_q) {
	$part_r = mysql_fetch_array($part_q);
	$link = $part_r[video_link];?>
	<tr><td colspan="2" align="left">
		<object type="application/x-shockwave-flash" data="<?echo $link;?>" width="800" height="640">
		<param name="movie" value="<?echo $link;?>"/> 
		<param name="allowfullscreen" value="true"/> 
		<param name="allowscriptaccess" value="always"/> 
		<param name="bgcolor" value="#ffffff"/> 
		<param name="quality" value="high"/> 
		<param name="width" value="800"/> 
		<param name="height" value="640"/> 
		</object>
	</td>
	</tr>
	</table>
<? }