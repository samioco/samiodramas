<?php

if ($_GET["orderby"]) {$orderby = $_GET["orderby"];} else {$orderby = "date";}
if ($_GET["order"]) {$order=$_GET["order"];} else {$order = "DESC";}

#echo $orderby." ".$order;

if ($orderby=="name_eng") {
	$orderby="drama_name_eng";
	if ($order=="ASC") {$new_order="DESC";} else {$new_order="ASC";}
} else {$new_order="ASC";}
$sortby_name_eng_link = $PHP_SELF."?orderby=name_eng&order=".$new_order;
#$sortby_name_eng_link = $domain_path."/index.php?orderby=name_eng&order=".$new_order;
if ($orderby=="name_asian") {
	$orderby="drama_name_asian";
	if ($order=="ASC") {$new_order="DESC";} else {$new_order="ASC";}
} else {$new_order="ASC";}
$sortby_asian_name_link = $PHP_SELF."?orderby=name_asian&order=".$new_order;
if ($orderby=="type") {
	$orderby="origin";
	if ($order=="ASC") {$new_order="DESC";} else {$new_order="ASC";}
} else {$new_order="ASC";}
$sortby_cat_link = $PHP_SELF."?orderby=type&order=".$new_order;
if ($orderby=="date") {
	$orderby="start_date";
	if ($order=="ASC") {$new_order="DESC";} else {$new_order="ASC";}
} else {$new_order="ASC";}
$sortby_date_link = $PHP_SELF."?orderby=date&order=".$new_order;
if ($orderby=="rating") {
	if ($order=="ASC") {$new_order="DESC";} else {$new_order="ASC";}
} else {$new_order="ASC";}
$sortby_rating_link = $PHP_SELF."?orderby=rating&order=".$new_order;
/*
if ($list_type!="all") {
	$list_type=str_ireplace("/","",$_SERVER["REQUEST_URI"]);
	if (stripos($list_type,"?")){$list_type=substr($list_type,0,stripos($list_type,"?"));}
}*/
/*if ($list_type=="all"){$drama_list_q = mysql_query("SELECT * FROM dramas ORDER BY $orderby $order");}
else {$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='$list_type' ORDER BY $orderby $order");}*/
switch($list_type){
	case "j-drama":
	case "j-movie":
		$asian="Japanese";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='j-drama' OR origin='j-movie' ORDER BY $orderby $order");break;
	case "k-drama":
	case "k-movie":
		$asian="Korean";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='k-drama' OR origin='k-movie' ORDER BY $orderby $order");break;
	case "tw-drama":
	case "tw-movie":
		$asian="Taiwanese";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='tw-drama' OR origin='tw-movie' ORDER BY $orderby $order");break;
	case "hk-drama":
	case "hk-movie":
		$asian="Hong Kong";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='hk-drama' OR origin='hk-movie' ORDER BY $orderby $order");break;
	case "ch-drama":
	case "ch-movie":
		$asian="Chinese";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='ch-drama' OR origin='ch-movie' ORDER BY $orderby $order");break;
	case "anime":
		$asian="Anime";$drama_list_q = mysql_query("SELECT * FROM dramas WHERE origin='anime' ORDER BY $orderby $order");break;
	default: $asian="Asian";$drama_list_q = mysql_query("SELECT * FROM dramas ORDER BY $orderby $order");#$list_type="all"
}
$total_rows=mysql_num_rows($drama_list_q);
?>			

<table align="center" width="800" id="rounded-corner" summary="Samio Dramas Listing">
    <thead>
    	<tr>
        	<th width="225" scope="col" class="rounded-top-left">
				<a href="<?echo $sortby_name_eng_link;?>" title="Sort by English Title"><?
				if ($orderby=="drama_name_eng") {
					if ($order=="ASC") {?>English Title<?} else {?>English Title<?} }
				else {?>English Title<?} ?></a></th>
            <th width="225" scope="col">
				<a href="<?echo $sortby_asian_name_link;?>" title="Sort by <?echo $asian;?> Title"><?
				
				switch($asian){
					case "Japanese":?><img src="/images/flag_japan.jpg" alt="/flag_japan.jpg"><?break;
					case "Korean":?><img src="/images/flag_korea.jpg" alt="/flag_korea.jpg"><?break;
					case "Taiwanese":?><img src="/images/flag_taiwan.jpg" alt="/flag_taiwan.jpg"><?break;
					case "Hong Kong":?><img src="/images/flag_hk.jpg" alt="/flag_hk.jpg"><?break;
					case "Chinese":?><img src="/images/flag_china.jpg" alt="/flag_china.jpg"><?break;
				}
				echo " ".$asian." Title ";?>
				</a></th><?
				?>
            <th width="125" scope="col">
				<a href="<?echo $sortby_cat_link;?>" title="Sort by Category"><?
				if ($orderby=="origin") {
					if ($order=="ASC") {?>Category<?} else {?>Category<?} }
				else {?>Category<?} ?></a></th>
            <th width="125" scope="col">
				<a href="<?echo $sortby_date_link;?>" title="Sort by Film Date"><?
				if ($orderby=="start_date") {
					if ($order=="ASC") {?>Date<?} else {?>Date<?} }
				else {?>Date<?} ?></a></th>
            <th width="100" scope="col" class="rounded-top-right">
				<a href="<?echo $sortby_rating_link;?>" title="Sort by Rating"><?
				if ($orderby=="rating") {
					if ($order=="ASC") {?>Ratings<?} else {?>Ratings<?} }
				else {?>Ratings<?} ?></a></th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
		<?if (($drama_id!=-1)||($num_rows>=$total_rows)){?>
        	<th width="250" scope="col" class="rounded-bot-left">
				<a href="<?echo $sortby_name_eng_link;?>" title="Sort by English Title"><?
				if ($orderby=="drama_name_eng") {
					if ($order=="ASC") {?>English Title<?} else {?>English Title<?} }
				else {?>English Title<?} ?></a></th>
			<th width="200" scope="col">
				<a href="<?echo $sortby_asian_name_link;?>" title="Sort by <?echo $asian;?> Title"><?echo $asian." Title";?></a></th><?
				/*if ($orderby=="drama_name_asian") {
					if ($order=="ASC") {?>Asian Title<?} else {?>Asian Title<?} }
				else {?>Asian Title<?} ?></a></th>*/?>
            <th width="125" scope="col">
				<a href="<?echo $sortby_cat_link;?>" title="Sort by Category"><?
				if ($orderby=="origin") {
					if ($order=="ASC") {?>Category<?} else {?>Category<?} }
				else {?>Category<?} ?></a></th>
            <th width="125" scope="col">
				<a href="<?echo $sortby_date_link;?>" title="Sort by Film Date"><?
				if ($orderby=="start_date") {
					if ($order=="ASC") {?>Date<?} else {?>Date<?} }
				else {?>Date<?} ?></a></th>
        	<th width="100" scope="col" class="rounded-bot-right">
				<a href="<?echo $sortby_rating_link;?>" title="Sort by Rating"><?
				if ($orderby=="rating") {
					if ($order=="ASC") {?>Ratings<?} else {?>Ratings<?} }
				else {?>Ratings<?} ?></a></th>
		<?}	else {?><th scope="col" class="rounded-bot-left"><a href="/<?echo $list_type;?>/" title="View Full <?echo $asian;?> Drama Listing">View More...</a></th>
					<th colspan="3" align="center"></th>
					<th scope="col" class="rounded-bot-right"></th>
				<?}		
        ?></tr>
    </tfoot>
    <tbody><?	
		$num_dramas = mysql_num_rows($drama_list_q);
		if ($num_dramas>0){
			$row=1;
			while (($drama_list_r= mysql_fetch_array($drama_list_q))&&($row<=$num_rows)) {
				$link = $domain_path."/".$drama_list_r[origin]."/".$drama_list_r[dir_name]."/";
				if (strlen($drama_list_r[rating])>0) {
					$rating = $drama_list_r[rating];
					$rating=str_ireplace("(Kanto)","",$rating);
					$rating=str_ireplace("%","",$rating);
					$rating=trim($rating);
				} else {$rating="N/A (無し)";}

				?><tr>	
				<td><a href="<?echo $link;?>" alt="<?	
				$drama_name=$drama_list_r[drama_name_eng];
				$alt_title_q=mysql_query("SELECT * FROM details_list WHERE drama_name_eng='$drama_name' AND detail_type='alt_title'");
				$alt_titles="";
				if (mysql_num_rows($alt_title_q)>0){
					while ($r=mysql_fetch_array($alt_title_q)){
						if (strlen($alt_titles)>0){$alt_titles.=" | ".$r[detail_info];}else{$alt_titles=$r[detail_info];}
					}
				}
				echo $alt_titles;?>"><b><?echo $drama_name;?></b></a></td>
				<td><a href="<?echo $link;?>"><b><?echo $drama_list_r[drama_name_asian];?></b></a></td>
				<td>
				<?if ($drama_list_r[origin]=="j-drama") {?>J-Drama (日本)<?}
				else if ($drama_list_r[origin]=="tw-drama") {?>TW-Drama<?}
				else if ($drama_list_r[origin]=="hk-drama") {?>HK-Drama (香港)<?}
				else if ($drama_list_r[origin]=="k-drama") {?>K-Drama<?}
				else if ($drama_list_r[origin]=="ch-drama") {?>CH-Drama<?}
				else if ($drama_list_r[origin]=="usa-drama") {?>USA-Drama<?}
				else if ($drama_list_r[origin]=="euro-drama") {?>Euro-Drama<?}
				else if ($drama_list_r[origin]=="j-movie") {?>J-Movie (日本)<?}
				else if ($drama_list_r[origin]=="tw-movie") {?>TW-Movie<?}
				else if ($drama_list_r[origin]=="hk-movie") {?>HK-Movie (香港)<?}
				else if ($drama_list_r[origin]=="k-movie") {?>K-Movie<?}
				else if ($drama_list_r[origin]=="ch-movie") {?>CH-Movie<?}
				else if ($drama_list_r[origin]=="usa-movie") {?>USA-Movie<?}
				else if ($drama_list_r[origin]=="euro-movie") {?>Euro-Movie<?}
				else if ($drama_list_r[origin]=="anime") {?>Anime (アニメ)<?}
				else {}?>
				</td>
				<?$date_year = date("Y", strtotime($drama_list_r[start_date]));
				$date=date("Y-m-d", strtotime($drama_list_r[start_date]));
				$date_month = date("n", strtotime($drama_list_r[start_date]));
				if (($date_month>=1)&&($date_month<=3)){$date_season="Winter (冬)";}
				if (($date_month>=4)&&($date_month<=6)){$date_season="Spring (春)";}
				if (($date_month>=7)&&($date_month<=9)){$date_season="Summer (夏)";}
				if (($date_month>=10)&&($date_month<=12)){$date_season="Fall (秋)";}
				?><td><?echo $date_year." ".$date_season;?></td>	
				<td><?echo ucwords($rating);?></td>
				</tr>
			<?$row++;
			}
		}?>
    </tbody>
</table>



<?/*
<table width="850" border="0" align="center" cellpadding="0" color="#B00000">
<tr><td width="200" align="left" class="boldText"><a href="<?echo $sortby_name_eng_link;?>"><?
if ($orderby=="drama_name_eng") {
	if ($order=="ASC") {?>? English Title ?<?} else {?>? English Title ?<?} }
else {?>English Title<?} ?></a></td>
<td width="200" align="left" class="boldText"><a href="<?echo $sortby_asian_name_link;?>"><?
if ($orderby=="drama_name_asian") {
	if ($order=="ASC") {?>? Asian Title ?<?} else {?>? Asian Title ?<?} }
else {?>Asian Title<?} ?></a></td>
<td width="100" align="left" class="boldText"><a href="<?echo $sortby_cat_link;?>"><?
if ($orderby=="origin") {
	if ($order=="ASC") {?>? Category ?<?} else {?>? Category ?<?} }
else {?>Category<?} ?></a></td>
<td width="125" align="left" class="boldText"><a href="<?echo $sortby_date_link;?>"><?
if ($orderby=="start_date") {
	if ($order=="ASC") {?>? Date ?<?} else {?>? Date ?<?} }
else {?>Date<?} ?></a></td>
<td width="75" align="left" class="boldText"><a href="<?echo $sortby_rating_link;?>"><?
if ($orderby=="rating") {
	if ($order=="ASC") {?>? Ratings ?<?} else {?>? Ratings ?<?} }
else {?>Ratings<?} ?></a></td>
</table>


<table width="850" border="1" align="center" cellpadding="5">
<?
$drama_list_q = mysql_query("SELECT * FROM dramas ORDER BY $orderby $order");
$num_dramas = mysql_num_rows($drama_list_q);
if ($num_dramas>0){
	while ($drama_list_r= mysql_fetch_array($drama_list_q)) {
		$link = $domain_path."/".$drama_list_r[origin]."/".$drama_list_r[dir_name]."/";
		if (strlen($drama_list_r[rating])>0) {
			$rating = $drama_list_r[rating];
			$rating=str_ireplace("(Kanto)","",$rating);
			$rating=str_ireplace("%","",$rating);
			$rating=trim($rating);
		} else {$rating="N/A (??)";}
		?><tr>
		<td width="200" align="left"><a href="<?echo $link;?>" target="_blank"><?echo $drama_list_r[drama_name_eng];?></a></td>
		<td width="200" align="left"><a href="<?echo $link;?>" target="_blank"><?echo $drama_list_r[drama_name_asian];?></a></td>
		<td width="100" align="left">
		<?if ($drama_list_r[origin]=="j-drama") {?>J-Drama (??)<?}
		else if ($drama_list_r[origin]=="tw-drama") {?>TW-Drama<?}
		else if ($drama_list_r[origin]=="hk-drama") {?>HK-Drama (??)<?}
		else if ($drama_list_r[origin]=="k-drama") {?>K-Drama<?}
		else if ($drama_list_r[origin]=="ch-drama") {?>CH-Drama<?}
		else if ($drama_list_r[origin]=="usa-drama") {?>USA-Drama<?}
		else if ($drama_list_r[origin]=="euro-drama") {?>Euro-Drama<?}
		else if ($drama_list_r[origin]=="j-movie") {?>J-Movie (??)<?}
		else if ($drama_list_r[origin]=="tw-movie") {?>TW-Movie<?}
		else if ($drama_list_r[origin]=="hk-movie") {?>HK-Movie (??)<?}
		else if ($drama_list_r[origin]=="k-movie") {?>K-Movie<?}
		else if ($drama_list_r[origin]=="ch-movie") {?>CH-Movie<?}
		else if ($drama_list_r[origin]=="usa-movie") {?>USA-Movie<?}
		else if ($drama_list_r[origin]=="euro-movie") {?>Euro-Movie<?}
		else {}?>
		</td>
		<?$date_year = date("Y", strtotime($drama_list_r[start_date]));
		$date=date("Y-m-d", strtotime($drama_list_r[start_date]));
		$date_month = date("n", strtotime($drama_list_r[start_date]));
		if (($date_month>=1)&&($date_month<=3)){$date_season="Winter (?)";}
		if (($date_month>=4)&&($date_month<=6)){$date_season="Spring (?)";}
		if (($date_month>=7)&&($date_month<=9)){$date_season="Summer (?)";}
		if (($date_month>=10)&&($date_month<=12)){$date_season="Fall (?)";}
		?><td width="125" align="left"><?echo $date_year." ".$date_season;?></td>	
		<td width="100" align="right"><?echo ucwords($rating);?></td>
		</tr>
	<?}
}?>
</table>

<table width="850" border="0" align="center" cellpadding="5" color="#B00000">
<tr><td width="200" align="left" class="boldText"><a href="<?echo $sortby_name_eng_link;?>"><?
if ($orderby=="drama_name_eng") {
	if ($order=="ASC") {?>? English Title ?<?} else {?>? English Title ?<?} }
else {?>English Title<?} ?></a></td>
<td width="200" align="left" class="boldText"><a href="<?echo $sortby_asian_name_link;?>"><?
if ($orderby=="drama_name_asian") {
	if ($order=="ASC") {?>? Asian Title ?<?} else {?>? Asian Title ?<?} }
else {?>Asian Title<?} ?></a></td>
<td width="100" align="left" class="boldText"><a href="<?echo $sortby_cat_link;?>"><?
if ($orderby=="origin") {
	if ($order=="ASC") {?>? Category ?<?} else {?>? Category ?<?} }
else {?>Category<?} ?></a></td>
<td width="125" align="left" class="boldText"><a href="<?echo $sortby_date_link;?>"><?
if ($orderby=="start_date") {
	if ($order=="ASC") {?>? Date ?<?} else {?>? Date ?<?} }
else {?>Date<?} ?></a></td>
<td width="75" align="left" class="boldText"><a href="<?echo $sortby_rating_link;?>"><?
if ($orderby=="rating") {
	if ($order=="ASC") {?>? Ratings ?<?} else {?>? Ratings ?<?} }
else {?>Ratings<?} ?></a></td>
</table>
<br /><br />
<?/*
<table width="700" border="0" align="center"cellpadding="5">
<tr><td width="200" align="left" class="boldText">
<a href="<?echo $sortby_name_eng_link;?>">English Title</td>
<td width="200" align="left" class="boldText">
<a href="<?echo $sortby_asian_name_link;?>">Asian Title</td>
<td width="100" align="left" class="boldText">
<a href="<?echo $sortby_cat_link;?>">Category</td>
<td width="100" align="left" class="boldText">
<a href="<?echo $sortby_date_link;?>">Release Date</td>
<td width="100" align="left" class="boldText">
<a href="<?echo $sortby_rating_link;?>">Viewer Ratings</td></tr>
</table>
*/?>
<?