<?php
$domain_path = "http".((!empty($_SERVER['HTTPS']))?"s":"")."://".$_SERVER["SERVER_NAME"];
$domain_path="http://www.samiodramas.com";
$docRoot=$_SERVER['DOCUMENT_ROOT'];
include($_SERVER['DOCUMENT_ROOT'].'/_header_tags.php');
?>
<body><center>
<center><table align="center" width="900" border="0" cellpadding="0" cellspacing="0">
 
<tr><td width="16" background="/images/background_left_bblue.jpg" valign="top">
		<!--<img src="http://www.samio.org/images/left.jpg">-->
	</td>
	<td width="875" bgcolor="#FFFFFF" align="center" valign="top">
	<a href="<?echo $domain_path;?>"><img src="/images/banner/samiodramas1b.jpg"></a>

<table><tr><td>
<br />
<form action="http://www.samiodramas.com/search/" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="partner-pub-8310510341116607:uzm8s0h7h63" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
</td></tr></table>