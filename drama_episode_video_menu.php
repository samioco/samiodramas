<?php
$num_parts_q = mysql_query("SELECT part_num FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$next_eps_type' AND eps_num='$next_ep'");
$num_parts = mysql_num_rows($num_parts_q);
$last_q = mysql_query("SELECT last FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$eps_type' AND eps_num='$episode' AND part_num='$part'");
if ($last_q) {
	$last_r = mysql_fetch_array($last_q);
	$last_ep = $last_r[last];
}
#$fs_path = $drama_path.$eps_type."/".$episode."/part/".$part."/fs/";
#$fs_path = $domain_path."/fullscreen/index.php?drama=".$drama_name_eng."&spae=".$special_occurs_after_episode_num."&type=".$eps_type."&ep=".$episode."&part=".$part;
$fs_path = $domain_path."/fullscreen/index.php?drama=".$drama_name_eng."&type=".$eps_type."&ep=".$episode."&part=".$part;
?>
<table width="800" border="0" align="center" cellpadding="10">
<tr><td width="100" align="left">
	[<a href="<?echo $fs_path;?>" title="Open FULL SCREEN in new window!" target="_blank"><b>[ FULL SCREEN ]</b></a>
</td><td align="right">
	<?if ($last_ep) {
		?><b>[ END OF SERIES ]</b> <?
		?></td></tr><tr><td width="100%" colspan="2" align="center" class="bigBold">
			Thank you for watching <?echo ucwords($drama_name_eng);?>!<br /> We hope you enjoyed it as much as we did!</td></tr><?
	}
	else {
		?><b>[ watch next: <a href="<?echo $next_page;?>"><?echo $drama_name_eng." ".ucfirst($next_eps_type)." ".$next_ep.", Part ".$next_part."/".$num_parts;?></a> ]</b>
<?	}?>
</td></tr></table><br />

