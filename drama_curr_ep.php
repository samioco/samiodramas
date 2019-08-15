<?php
$drama_name_eng = $_GET["drama"];
$drama_name_eng = ucwords($drama_name_eng);
$eps_type = $_GET["type"];
$eps_type = strtolower($eps_type);
$episode = $_GET["ep"];
$part = $_GET["part"];
#$special_occurs_after_episode_num = $_GET["spae"];

#$next_ep = 0;
#$next_part = 0;
#$next_eps_type = "N/A";
#echo "eps#: ".$episode;
#echo "part#: ".$part;
#echo "eps type: ".$eps_type;
#echo "drama dir: ".$drama_dir;

$result = mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$drama_name_eng'");
if ($row = mysql_fetch_array($result)) {
	$origin = strtolower($row[origin]);
	$dir_name = strtolower($row[dir_name]);
	$drama_dir = $origin."/".$dir_name."/";
	
}

/*
$uri = $_SERVER["REQUEST_URI"];
$result = mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$drama_name'");
$row = mysql_fetch_array($result);
$origin = strtolower($row[origin]);
$dir_name = strtolower($row[dir_name]);
$drama_dir = $origin."/".$dir_name."/";
$ep_part_str = substr($uri,strlen($drama_dir)+1);
$eps_type = strtok($ep_part_str, "/");
$episode = strtok("/");
strtok("/");
$part = strtok("/");
*/
#$episode = substr($ep_part_str,strlen($eps_type)+1,1);
#$part = substr($ep_part_str,strlen($eps_type)+8,1);

#echo "ep part string: ".$ep_part_str;

?>
