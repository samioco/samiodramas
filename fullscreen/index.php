<?php



$drama_name_eng = $_GET["drama"];
$eps_type = $_GET["type"];
$episode = $_GET["ep"];
$part = $_GET["part"];
#$special_occurs_after_episode_num = $_GET["spae"];
$next_ep = 0;
$next_part = 0;
$next_eps_type = "N/A";
include('../drama_db.php');
#include('../drama_vars.php');
include('../_header_tags.php');

$curr_info_q = mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$drama_name_eng'");
if ($curr_info_q){
	$curr_info_r=mysql_fetch_array($curr_info_q);
	$drama_id=$curr_info_r[id];
	$origin = $curr_info_r[origin];
	$dir_name = $curr_info_r[dir_name];
	$drama_dir = $origin."/".$dir_name."/";
	include('../'.$drama_dir.'drama_name.php');
	
	include('../drama_hits.php');
}

$video_q = mysql_query("SELECT * FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$eps_type' AND eps_num='$episode' AND part_num='$part'");
if ($video_q) {
	$video_r = mysql_fetch_array($video_q);
	$video_link = $video_r[video_link];
	$last_ep = $video_r[last];
	#$eps_type = $video_r[eps_type];	
}

include('../drama_next_ep.php');

$next_fs_path = $domain_path."/fullscreen/index.php?drama=".$drama_name_eng."&spae=".$special_occurs_after_episode_num."&type=".$next_eps_type."&ep=".$next_ep."&part=".$next_part;
$num_parts_q = mysql_query("SELECT part_num FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$next_eps_type' AND eps_num='$next_ep'");
$num_parts = mysql_num_rows($num_parts_q);

?>
<body onresize="fullscreen();" onload="fullscreen();" class="blackBack"> 
	<object type="application/x-shockwave-flash" data="<?echo $video_link;?>" width="100%" height="100%" id="player"> 
	<param name="movie" value="<?echo $video_link;?>"/> 
	<param name="allowfullscreen" value="true"/> 
	<param name="allowscriptaccess" value="always"/> 
	<param name="bgcolor" value="#000000"/> 
	<param name="quality" value="high"/>
	</object> 

<div class="bar">
<?if ($last_ep) {?><b>[ END OF SERIES ]</b> <?}
else {?><b>[watch next: <a href="<?echo $next_fs_path;?>"><?echo $drama_name_eng." ".ucfirst($next_eps_type)." ".$next_ep.", Part ".$next_part."/".$num_parts;?></a>]</b><?}?>
</div>
</body></html>
