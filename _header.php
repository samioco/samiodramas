<?php
$domain_path = "http".((!empty($_SERVER['HTTPS']))?"s":"")."://".$_SERVER["SERVER_NAME"];
$domain_path="http://www.samio.co/drama";
$docRoot=$_SERVER['DOCUMENT_ROOT'];
#$docRoot= $ROOT;

include($_SERVER['DOCUMENT_ROOT'].'/_header_tags.php');
#include($ROOT.'/_header_tags.php');
?>
<body><center>
<center><table align="center" valign="top" width="900">
 
<tr><td width="16" background="/images/background_left_bblue.jpg" valign="top"></td>
	<td width="900" bgcolor="#FFFFFF" align="center" valign="top">
	<?include('navi_bar.php');?>
	<br />
	<table align="center" valign="top" width="900">
	<tr><td align="left" valign="top"><a href="<?echo $domain_path;?>"><img src="/images/banner/samiodramas_with_motto.jpg" alt="Samio Drama Banner" title="www.SamioDrama.com"/></a></td>
	<td align="right" valign="top"><?include('samio_gsearch1.php');?></td>
	</tr></table>
	
	
