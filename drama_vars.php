<?php
$result = mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$drama_name'");
if($result) {
  	$row = mysql_fetch_array($result);
	$drama_id=$row[id];
    #$drama_name_eng = $row[drama_name_eng];
	$drama_name_eng=str_ireplace("\\","",$drama_name);
	$drama_name_asian = $row[drama_name_asian];
	$drama_name_asian_kana = $row[drama_name_asian_kana];
	$language = ucwords(strtolower($row[language]));
	if ($language=="Japanese"){$language_asian_display="日本語";}
	if ($language=="Chinese"){$language_asian_display="中国語";}
	if ($language=="Korean"){$language_asian_display="韓国語";}
	if ($language=="English"){$language_asian_display="英語";}
	$subtitles = ucwords(strtolower($row[subtitles]));
	if ($subtitles=="Japanese"){$subtitles_asian_display="日本語";}
	if ($subtitles=="Chinese"){$subtitles_asian_display="中国語";}
	if ($subtitles=="Korean"){$subtitles_asian_display="韓国語";}
	if ($subtitles=="English"){$subtitles_asian_display="英語";}
	$origin = strtolower($row[origin]);
	$dir_name = strtolower($row[dir_name]);
	$drama_dir = $origin."/".$dir_name."/";
	$drama_path = $domain_path."/".$drama_dir;
	$logo_path = $domain_path."/images/".$dir_name."_logo.jpg";
	$network = $row[network];
	$start_date_eng = date("M j, Y", strtotime($row[start_date]));
	$start_date_asian = date("Y年n月j日", strtotime($row[start_date]));
	$end_date_eng = date("M j, Y", strtotime($row[end_date]));
	$end_date_asian = date("Y年n月j日", strtotime($end_date_eng));
	$date_range_eng = $start_date_eng." to ".$end_date_eng;
	$date_range_asian = $start_date_asian."から".$end_date_asian."まで";
	$synopsis = $row[synopsis];
	if (strlen($row[rating])>0) {$rating = $row[rating];} else {$rating="N/A";}
	$official_site = $row[official_site];
}
$last_ep = false;
$fullscreen = false;
