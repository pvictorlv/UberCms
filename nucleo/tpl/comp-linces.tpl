<?php

function GetDescr($level)
{
	switch ($level)
	{

		case 3:

			return 'Hobba';

		default:

			return '';
	}
}

$getGroups = dbquery("SELECT id,name FROM ranks WHERE id = 3 or id = 4 ORDER BY id DESC");

while ($group = mysql_fetch_assoc($getGroups))
{
	echo '<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title" >' . clean($group['name']) . 's</h2>';

	$getMembers = dbquery("SELECT id,username,motto,look,online, last_online FROM users WHERE rank = '" . $group['id'] . "'");

	echo '<div class="box-content">';

	if (mysql_num_rows($getMembers) > 0)
	{
		$oe = 1;

		while ($member = mysql_fetch_assoc($getMembers))
		{
			if ($oe == 2)
			{
				$oe = 1;
			}
			else
			{
				$oe = 2;
			}

			echo '<table width="107%" style="padding: 5px; margin-left: -15px; background-color: ' . (($oe == 2) ? '#fff' : '#E6E6E6') . ';">
			<tbody>
				<tr>
					<td valign="middle" width="25">
						<img style="margin-top: -10px;" src="http://www.habbo.es/habbo-imaging/avatarimage?figure=' . $member['look'] . '&size=b&direction=4&head_direction=3&action=wlk&gesture=sml&size=s"">
					</td>
					<td valign="top">
						<b style="font-size: 110%;"><a href="%www%/home/' . clean($member['username']) . '">' . clean($member['username']) . '</a></b> ' . (($member['online'] == "1") ? '<img src="%www%/web-gallery/v2/images/online.gif" style="float: right;">
' : '<img src="%www%/web-gallery/v2/images/offline.gif" style="float: right;">') . '<br />
						<i>' . clean($member['motto']) . '</i><br />
						<br />';
						
						$date = date('d-m-Y H:i:s', $member['last_online']);
						
					$getBadges = dbquery("SELECT * FROM user_badges WHERE user_id = '" . $member['id'] . "' AND badge_slot >= 1 ORDER BY badge_slot DESC LIMIT 1");
					
					while ($b = mysql_fetch_assoc($getBadges))
					{
						echo "<b>Última conexión:</b> $date<br><br>&nbsp;";
						echo '<img src="http://images.kekolive.com/c_images/album1584/' . $b['badge_id'] . '.gif" style="float: left;">';
					}
						
					echo '</td>
					<td valign="top" style="float: right;">
						
					</td>
				</tr>
			</tbody>
			</table>';
		}
	}
	else
	{
		echo '<i>No hay miembros en &eacute;sta secci&oacute;n a&uacute;n</i>';
	}

	echo '</div>
	</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName(\'process-template\')) { Rounder.init(); }</script> ';
}

?>