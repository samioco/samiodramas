﻿<?php
include('drama_name.php');$drama_name=str_ireplace("\\","",$drama_name);$drama_name=str_ireplace("'","\'",$drama_name);
include('../../drama_db.php');
include('../../drama_vars.php');
include('../../_header.php');
include($docRoot.'/_banner1.php');
include($docRoot.'/drama_header.php');
include($docRoot.'/_banner2.php');
include('../../drama_contents.php');
include($docRoot.'/_banner3.php');
include($docRoot.'/drama_credits.php');
include($docRoot.'/_banner4.php');
include($docRoot.'/_footer.php');
?>