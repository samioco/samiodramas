<?
?>

<table width="800" id="rounded-corner" summary="<?echo $drama_name_eng;?> Episode Chart">
    <thead>
    	<tr>
        	<th width="50" scope="col" class="rounded-top-left">Episode</th>
            <th width="650" scope="col">Episode Title</th>
            <th width="100" scope="col" class="rounded-top-right">Video Parts</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<th width="50" scope="col" class="rounded-bot-left">Episode</th>
            <th width="650" scope="col">Episode Title</th>
        	<th width="100" scope="col" class="rounded-bot-right">Video Parts</th>
        </tr>
    </tfoot>
    <tbody>
		<?for ($i=1;$i<=3;$i++){
			if ($i==1) {$eps_type="episode";} else if ($i==2) {$eps_type="special";} else if ($i==3) {$eps_type="movie";}
			$order="ASC"; 
			$result1 = mysql_query("SELECT * FROM episodes WHERE drama_name_eng='$drama_name' AND eps_type='$eps_type' ORDER BY eps_num $order");
			if (mysql_num_rows($result1)>50){$order="DESC";}
			$result1 = mysql_query("SELECT * FROM episodes WHERE drama_name_eng='$drama_name' AND eps_type='$eps_type' ORDER BY id $order");
			if ($result1) {
				while ($eps_row = mysql_fetch_array($result1)) {
					?><tr>	<td align="center">
					<?$result2 = mysql_query("SELECT * FROM episode_parts WHERE drama_name_eng='$drama_name' AND eps_type='$eps_type' AND eps_num='$eps_row[eps_num]' ORDER BY part_num");
					
					if ($result2) { 
						$parts_row=mysql_fetch_array($result2);
						#$episode_php_path = $drama_path."episode.php?drama=".$drama_name_eng."&spae=".$special_occurs_after_episode_num."&type=".$eps_row[eps_type]."&ep=".$eps_row[eps_num]."&part=".$parts_row[part_num];
						$episode_php_path = $drama_path."episode.php?drama=".$drama_name_eng."&type=".$eps_row[eps_type]."&ep=".$eps_row[eps_num]."&part=".$parts_row[part_num];
						#$path = $drama_path.$eps_row[eps_type]."/".$eps_row[eps_num]."/part/".$parts_row[part_num]."/";
						?><a href="<?echo $episode_php_path;?>"><b><? $eps_num_int = (int)$eps_row[eps_num];echo $eps_num_int;?></b></a></td>
						<td align="left">
						<a href="<?echo $episode_php_path;?>"><b><?
							echo ucwords($drama_name_eng." ".$eps_row[eps_type])." ".$eps_row[eps_num];
							if (strlen($eps_row[eps_title])>0) {echo "<br />".$eps_row[eps_title];}?></b></a><?
					}
					?></td>
					<td align="left">
					
					<?$result2 = mysql_query("SELECT * FROM episode_parts WHERE drama_name_eng='$drama_name' AND eps_type='$eps_type' AND eps_num='$eps_row[eps_num]' ORDER BY part_num");
					if ($result2){
						while ($parts_row=mysql_fetch_array($result2)) {
							$episode_php_path = $drama_path."episode.php?drama=".$drama_name_eng."&type=".$eps_row[eps_type]."&ep=".$eps_row[eps_num]."&part=".$parts_row[part_num];
							#$path = $drama_path.$eps_row[eps_type]."/".$eps_row[eps_num]."/part/".$parts_row[part_num]."/";
							?><a href="<?echo $episode_php_path;?>"><b><?echo $parts_row[part_num];?></b></a>
							<?$video_source = $parts_row[video_source];
						}
					}
					/*?></td><td width="50" align="left"><?echo $video_source;?></td></tr><?*/
					?></td>
					</tr><?
				}
			}
		}?>
    </tbody>
</table>



