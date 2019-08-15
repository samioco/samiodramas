<?php

$num_parts_q = mysql_query("SELECT part_num FROM episode_parts WHERE drama_name_eng='$drama_name_eng' AND eps_type='$eps_type' AND eps_num='$episode'");
$num_parts = mysql_num_rows($num_parts_q);

if ($part<$num_parts) {
	$next_part = $part + 1;
	$next_ep = $episode;
} else {
	$next_part = 1;
	$next_ep = $episode + 1;
}
if ((!$last_ep)&&($eps_type=="episode")&&($special_occurs_after_episode_num==$episode) && ($part==$num_parts)) {
	$next_eps_type = "special";	$next_ep = 1;}
else if ((!$last_ep)&&($eps_type=="special")) {$next_eps_type = "special";} 
else if ((!$last_ep)&&($eps_type=="episode")) {$next_eps_type = "episode";}
else if ((!$last_ep)&&($eps_type=="movie")) { $next_eps_type="movie";}
 
#$next_page = $drama_path."episode.php?drama=".$drama_name_eng."&spae=".$special_occurs_after_episode_num."&type=".$next_eps_type."&ep=".$next_ep."&part=".$next_part;
$next_page = $drama_path."episode.php?drama=".$drama_name_eng."&type=".$next_eps_type."&ep=".$next_ep."&part=".$next_part;
?>