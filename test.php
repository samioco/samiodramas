<?php
$admin="administrator";
$pw="abc123";
$encadmin=md5($admin);
$encpw=md5($pw);
$concat=$encadmin.$encpw;
$encconcat=md5($concat);

echo $admin;?><br /><?
echo $pw;?><br /><?
echo $encadmin;?><br /><?
echo $encpw;?><br /><?
echo $concat;?><br /><?
echo $encconcat;?><br /><?
?>
