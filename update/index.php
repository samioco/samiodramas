<?php #$drama_name_eng = "UPDATE FORM";
include('_admin_header.php');
include('../drama_db.php');

#$today = "2009-02-27";
#$series_name = "Zettai Kareshi";
#$drama_dir = "";
#$wiki_page = "http://wiki.d-addicts.com/Zettai_Kareshi";
#$wiki_capable = true;
/*
$target_domain = "http://www.mysoju.com";
$target_link = "http://www.mysoju.com/".$drama_dir."/";
include('get_drama_info.php');
$file = file_get_contents($target_link); #grab mysoju page
if ($wiki_capable) {$wiki_file = file_get_contents($wiki_page);} #grab wiki page if capable
include('video_parts.php'); #initiate sequence 'strip mysoju bare!'
include('get_cast.php');
*/
$today=$_POST["today"];
$series_name_eng=str_ireplace("\\","",$_POST["series_name_eng"]);$series_name_noslash=str_ireplace("'","\'",$series_name_eng);
$series_name_asian=$_POST["series_name_asian"];
$wiki_page=str_ireplace("\\","",$_POST["wiki_page"]);
$mysoju_page=str_ireplace("\\","",$_POST["mysoju_page"]);
$a_f_page=str_ireplace("\\","",$_POST["a-f_page"]);
$naruto_shippuden_page=str_ireplace("\\","",$_POST["naruto_shippuden_page"]);
$series_type=$_POST["series_type"];
$language=$_POST["language"];
$subtitles=$_POST["subtitles"];
$dir_name=$_POST["dir_name"];
$start_date=$_POST["start_date"];
$end_date=$_POST["end_date"];
$network=$_POST["network"];
$rating=$_POST["rating"];
$site=$_POST["site"];
$genres=$_POST["genres"];
$songs=$_POST["songs"];
$alt_titles=$_POST["alt_titles"];
$synopsis=$_POST["synopsis"];

#IF RESET BUTTON, THEN RESET ALL VALUES
if(isset($_POST['reset'])) {
	$today="";$series_name_eng="";$series_name_asian="";$wiki_page="";$mysoju_page="";$a_f_page="";$series_type="";
	$start_date="";$end_date="";$network="";$rating="";$site="";$synopsis="";$dir_name="";$genres="";$songs="";$alt_titles="";}

?>
<form method="post" action="<?php echo $PHP_SELF;?>"><br /><? 
include('required_info_form.php');
if(isset($_POST['d-addicts'])) {include('d-addicts_get_main_info.php');} 
if(isset($_POST['anime-fart'])) {include('anime-fart_get_main_info.php');} 
include('main_info_form.php');

#if ( !(isset($_POST['reset']))) {}

?><table width="1000" align="left" border="0" cellpadding="5"><tr><td><?

if(isset($_POST['credits'])) {include('get_cast.php');?><br /><br /><?}
if(isset($_POST['awards'])) {include('get_awards.php');}
if(isset($_POST['ep_titles'])) {include('get_ep_titles.php');}
if(isset($_POST['naruto_shippuden_ep_titles'])) {include('wiki_naruto_shippuden_get_ep_titles.php');}
if(isset($_POST['mysoju_videos'])) {include('mysoju_get_ep_parts.php');}
if(isset($_POST['anime-fart_videos'])) {include('anime-fart_get_ep_parts.php');}
if(isset($_POST['sql_insert_main'])) {include('sql_insert_get_main_info.php');}
if(isset($_POST['sql_insert_ep_titles'])) {include('sql_insert_get_ep_titles.php');}
if(isset($_POST['sql_insert_cast'])) {include('sql_insert_get_cast.php');}
if(isset($_POST['sql_insert_ep_parts'])) {include('sql_insert_get_ep_parts.php');}
if(isset($_POST['sql_insert_awards'])) {include('sql_insert_get_awards.php');}

?></td></tr></table>
</form><br />
<?
include('_admin_footer.php');
?>



