<?php
if (!$wiki_file = file_get_contents($wiki_page)) {echo "Wiki page not found.";?><br /><?}
else {
	echo "Wiki page found. Retrieving basic information...";?><br /><?


$series_name_start_str = "<title>";
$series_name_end_str = " - DramaWiki</title>";
$offset = strlen($series_name_start_str);
$wiki_name_startpos = stripos($wiki_file, $series_name_start_str) + $offset; 
$wiki_name_endpos = stripos($wiki_file, $series_name_end_str, $wiki_name_startpos);
$series_name_eng = substr($wiki_file, $wiki_name_startpos, $wiki_name_endpos - $wiki_name_startpos);
$series_name_eng = ucwords(trim($series_name_eng));

#$asian_name_start_str = "<b>Title:</b>";
$asian_name_start_str1 = "Title:";
$asian_name_start_str2 = "</b>";
$asian_name_end_str = "<";
$offset1 = strlen($asian_name_start_str1);
$offset2 = strlen($asian_name_start_str2);
$asian_name_startpos = stripos($wiki_file, $asian_name_start_str1) + $offset1;
$asian_name_startpos = stripos($wiki_file, $asian_name_start_str2, $asian_name_startpos) + $offset2;
$asian_name_endpos = stripos($wiki_file, $asian_name_end_str, $asian_name_startpos);
$series_name_asian = substr($wiki_file, $asian_name_startpos, $asian_name_endpos - $asian_name_startpos);
$series_name_asian = trim($series_name_asian);

$dir_name = strtolower(str_ireplace(" ","_",$series_name_eng));

$network_start_str = "<b>Broadcast network:</b>";
$network_end_str = "<";
$offset = strlen($network_start_str);
$network_startpos = stripos($wiki_file, $network_start_str) + $offset;
$network_endpos = stripos($wiki_file, $network_end_str, $network_startpos);
$network = substr($wiki_file, $network_startpos, $network_endpos - $network_startpos);
$network = trim($network);

$broadcast_start_str = "<b>Broadcast period:</b>";
$broadcast_end_str = "to";
$broadcast_final_str = "<";
$startdate_offset = strlen($broadcast_start_str);
$enddate_offset = strlen($broadcast_end_str);
$broadcast_startdate_startpos = stripos($wiki_file, $broadcast_start_str) + $startdate_offset;
$broadcast_startdate_endpos = stripos($wiki_file, $broadcast_end_str, $broadcast_startdate_startpos);
$start_date = substr($wiki_file, $broadcast_startdate_startpos, $broadcast_startdate_endpos - $broadcast_startdate_startpos);
$start_date = trim($start_date);
$start_date = date("Y-m-d", strtotime($start_date));
if (($broadcast_startdate_endpos - $broadcast_startdate_startpos)>20) {echo "Irregularities found with DATE(s)";?><br /><?}

$broadcast_enddate_startpos = $broadcast_startdate_endpos + $enddate_offset;
$broadcast_enddate_endpos = stripos($wiki_file, $broadcast_final_str, $broadcast_enddate_startpos);
$end_date = substr($wiki_file, $broadcast_enddate_startpos, $broadcast_enddate_endpos - $broadcast_enddate_startpos);
$end_date = trim($end_date);
$end_date = date("Y-m-d", strtotime($end_date));

$rating_start_str = "<b>Viewership ratings:</b>";
$rating_end_str = "<";
$rating_offset = strlen($rating_start_str);
$rating_startpos = stripos($wiki_file, $rating_start_str);

if ($rating_startpos>0){
	$rating_startpos += $rating_offset;
	$rating_endpos = stripos($wiki_file, $rating_end_str, $rating_startpos);
	$rating = substr($wiki_file, $rating_startpos, $rating_endpos - $rating_startpos);
	$rating = trim($rating);
} else {echo "RATING not found!";}?><br /><?

$site_start_str = "Official site</a><span class='urlexpansion'>&nbsp;(<i>";
$site_end_str = "</i>";
$site_offset = strlen($site_start_str);
$site_startpos = stripos($wiki_file, $site_start_str);
if ($site_startpos>0) {
	$site_startpos += $site_offset;
	$site_endpos = stripos($wiki_file, $site_end_str, $site_startpos);
	$site = substr($wiki_file, $site_startpos, $site_endpos - $site_startpos);
} else {echo "OFFICIAL SITE not found!";}?><br /><?

$synopsis_start_str1 = "name=\"Synopsis\"";
$synopsis_start_str2 = "<p>";
$syn_offset = strlen($synopsis_start_str2);
$synopsis_end_str = "<div class=";
$syn_startpos = stripos($wiki_file, $synopsis_start_str1);
$syn_startpos = stripos($wiki_file, $synopsis_start_str2, $syn_startpos) + $syn_offset;
$syn_endpos = stripos($wiki_file, $synopsis_end_str, $syn_startpos);
$synopsis = substr($wiki_file, $syn_startpos, $syn_endpos - $syn_startpos);
$synopsis = str_ireplace("</p><p>","<br /><br />", $synopsis);
$synopsis = str_ireplace("<p>","",$synopsis);
$synopsis = str_ireplace("</p>","",$synopsis);
while ($href_startpos=stripos($synopsis,"<a href")) {#remove all links from string
	$href_endpos=stripos($synopsis,">",$href_startpos)+strlen(">");
	$href_str=substr($synopsis,$href_startpos,$href_endpos-$href_startpos);
	$synopsis=str_ireplace($href_str,"",$synopsis);
	$synopsis=str_ireplace("</a>","",$synopsis);
}
while ($span_startpos=stripos($synopsis,"<span class")) {#remove all links from string
	$span_endpos=stripos($synopsis,"</span>",$span_startpos)+strlen("</span>");
	$span_str=substr($synopsis,$span_startpos,$span_endpos-$span_startpos);
	$synopsis=str_ireplace($span_str,"",$synopsis);
}
$synopsis=trim($synopsis);
#dir_name submitted in form
#series_name_eng submitted in form
#series_name_asian submitted in form
#wiki_page submitted above
#mysoju_page submitted above
#series_type submitted above
#subtitles submitted above
switch ($series_type) {
	case "j-drama":
	case "j-movie": $language="Japanese"; break;
	case "hk-drama":
	case "hk-movie": $language="Cantonese"; break;
	case "k-drama":
	case "k-movie": $language="Korean"; break;
	case "tw-drama":
	case "tw-movie": $language="Taiwanese"; break;
	case "ch-drama":
	case "ch-movie": $language="Mandarin"; break;
}

#include('basic_info_form.php');

?><br /><?
}


#start/end dates submitted above
#network submitted
#rating submitted
#official site submitted
#synopsis submitted
/* ECHO BACK MANUALLY ENTERED INFO
echo "insert into dramas (drama_name_eng,drama_name_asian,language,subtitles,origin,dir_name,network,start_date,end_date,synopsis,rating,date_added,official_site) values (";
echo "\"".$drama_name."\",\"".$drama_name_asian."\",\"".$language."\",\"".$subtitles."\",\"".$series_type."\",\"".$dir_name."\",\"".$network."\",\"".$start_date."\",\"".$end_date."\",\"".$synopsis."\",\"".$rating."\",\"".$today."\",\"".$official."\");";?><br /><br /><?
*/


