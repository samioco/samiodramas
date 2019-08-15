<?php
#need to pre-format (due to possibility of multiple entries within a single string var): genres, songs, alt_titles


?><table width="850" align="center">
<tr><td align="left" valign="top">
<textarea rows="25" cols="175" name="sql_INSERTs" wrap="physical"><?
$q=mysql_query("SELECT * FROM dramas WHERE drama_name_eng='$series_name_noslash'");
if (mysql_num_rows($q)==0){
	echo "INSERT into dramas (drama_name_eng,drama_name_asian,language,subtitles,origin,dir_name,network,start_date,end_date,synopsis,rating,date_added,official_site) VALUES (";
	echo "\"".$series_name_eng."\",\"".$series_name_asian."\",\"".$language."\",\"".$subtitles."\",\"".$series_type."\",\"".$dir_name."\",\"".$network."\",\"".$start_date."\",\"".$end_date."\",\"".$synopsis."\",\"".$rating."\",\"".$today."\",\"".$site."\");";	
} else {
	echo "UPDATE dramas SET drama_name_asian='$series_name_asian',language='$language',subtitles='$subtitles',origin='$series_type',dir_name='$dir_name',network='$network',start_date='$start_date',end_date='$end_date',synopsis='$synopsis',rating='$rating',official_site='$site' WHERE drama_name_eng='$series_name_eng'";
}
echo "\r\n\r\n";

$title_tok=trim(ucwords(strtok($alt_titles,"\r\n")));
while($title_tok){
	$q=mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$series_name_noslash' AND detail_type='alt_title' AND detail_info='$title_tok'");
	if (mysql_num_rows($q)==0){
		echo "INSERT into details_list (drama_name_eng,detail_type,detail_info) VALUES (";
		echo "\"".$series_name_eng."\",\""."alt_title"."\",\"".$title_tok."\");";
	} else {
		echo "/* ".$series_name_eng."::alt_title:".$title_tok." already exists in the table. */";
		#if the row already exists, do NOTHING!
	}
	echo "\r\n";
	$title_tok=trim(ucwords(strtok("\r\n")));
}
echo "\r\n";

$genre_tok = trim(ucwords(strtok($genres,"\r\n")));
while($genre_tok){
	$q=mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$series_name_noslash' AND detail_type='genre' AND detail_info='$genre_tok'");
	if (mysql_num_rows($q)==0){
		echo "INSERT into details_list (drama_name_eng,detail_type,detail_info) VALUES (";
		echo "\"".$series_name_eng."\",\""."genre"."\",\"".$genre_tok."\");";
	} else {
		echo "/* ".$series_name_eng."::genre:".$genre_tok." already exists in the table. */";
		#if the row already exists, do NOTHING!
		#echo "UPDATE details_list SET detail_type='genre',detail_info='$genre_tok' WHERE drama_name_eng='$series_name_eng'";
	}
	echo "\r\n";
	$genre_tok=trim(ucwords(strtok("\r\n")));
}
echo "\r\n";

$song_tok=trim(strtok($songs,"\r\n"));
while($song_tok){
	if (stripos($song_tok,";")){
		$song_endpos=stripos($song_tok,";");
		$song=substr($song_tok,0,$song_endpos);
		$artist=substr($song_tok,$song_endpos+1,strlen($song_tok)-($song_endpos+1));
	} else {$song=$song_tok; $artist="";}
	$q=mysql_query("SELECT * FROM songs WHERE drama_name_eng='$series_name_noslash' AND song_name_eng='$song'");
	if (mysql_num_rows($q)==0){
		echo "INSERT into songs (song_name_eng,artist_name_eng,drama_name_eng) VALUES (";
		echo "\"".$song."\",\"".$artist."\",\"".$series_name_eng."\");";
	} else {
		$r=mysql_fetch_array($q);
		if ($r[artist_name_eng]==""){echo "UPDATE songs SET artist_name_eng='$artist' WHERE drama_name_eng='$series_name_noslash' AND song_name_eng='$song_tok'";}
		if ((strlen($r[artist_name_eng])>0)&&(strlen($artist)>0)){echo "UPDATE songs SET artist_name_eng='$artist' WHERE drama_name_eng='$series_name_noslash' AND song_name_eng='$song_tok'";}
	}
	$song_tok=trim(strtok("\r\n"));
	echo "\r\n";
}
echo "\r\n";



?></textarea></td>
</tr></table>
<?