<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
if (strlen($drama_name_eng)>0) {$drama_name_title_tag = $drama_name_eng." | ";}
if (strlen($drama_name_asian)>0) {$drama_name_title_tag .= $drama_name_asian." | ";}

if (strlen($drama_name_eng)>0){
	$q = mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='alt_title'");
	$i=1;
	while($r=mysql_fetch_array($q)){$keywords[$i]=$r[detail_info];$i++;}
	$q = mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='genre'");
	while($r=mysql_fetch_array($q)){$keywords[$i]=$r[detail_info];$i++;}
}
		
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?echo $drama_name_title_tag;?>Watch Dramas and Movies at SamioDramas.com!</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta name="description" content="Watch Dramas at SamioDramas.com! Large collection of Japanese, Korean, Hong Kong, Taiwanese, and Chinese Dramas."/>
<meta name="keywords" content="<?for ($k=1;$k<$i;$k++){echo $keywords[$k]." ";}?>"/> 

<meta name="copyright" content="<?echo $domain_path;?>"/> 
<style type="text/css">
<!--
@import url("/style.css");
-->
</style>


</head>
