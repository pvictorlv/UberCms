<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(HK_USER_ID, 'fuse_housekeeping_catalog'))
{
	exit;
}

require_once "top.php";

echo '<h1>New furni finder</h1>';
echo '<p>This tool will scan Habbo UK\'s furni data file for furniture that is missing from our defs.</p><br />';
echo '<p><a href="http://hotel-uk.habbo.com/gamedata/furnidata?hash=x">http://hotel-uk.habbo.com/gamedata/furnidata?hash=x</a></p><br />';

$whatWeKnow = Array();
$getWhatWeKnow = dbquery("SELECT item_name FROM furniture");

while ($g = mysql_fetch_assoc($getWhatWeKnow))
{
	$whatWeKnow[] = $g['item_name'];
}

$data = file_get_contents("http://hotel-uk.habbo.com/gamedata/furnidata?hash=x");
$data = str_replace("\n", "", $data);
$data = str_replace("[[", "[", $data);
$data = str_replace("]]", "]", $data);
$data = str_replace("][", "],[", $data);

$ij = 0;
$stuffWeDontKnow = Array();

foreach (explode('],[', $data) as $val)
{
	$val = str_replace('[', '', $val);
	$val = str_replace(']', '', $val);
	
	$bits = explode(',', $val);
	$name = str_replace('"', '', $bits[2]);
	
	if (in_array($name, $whatWeKnow))
	{
		continue;
	}
	
	if (strpos($name, 'prizetrophy') !== false)
	{
		continue;
	}
	else if (strpos($name, 'noob_') !== false)
	{
		continue;
	}
	else if (strpos($name, 'greektrophy') !== false)
	{
		continue;
	}	
	else if (strpos($name, 'present_wrap') !== false)
	{
		continue;
	}	
	else if (strpos($name, 'floortile') !== false)
	{
		continue;
	}	
	else if (strpos($name, 'wallpaper') !== false)
	{
		continue;
	}	
	else if (strpos($name, 'post_it') !== false)
	{
		continue;
	}		
	else if ($name == 'camera')
	{
		continue;
	}	
	else if ($name == 'prize1')
	{
		continue;
	}	
	else if ($name == 'prize2')
	{
		continue;
	}	
	else if ($name == 'prize3')
	{
		continue;
	}		
	else if ($name == 'bolly_palm')
	{
		continue;
	}		
	else if ($name == 'footylamp_campaign')
	{
		continue;
	}		
	else if ($name == 'rare_parasol')
	{
		continue;
	}		
	else if ($name == 'hw08_xray')
	{
		continue;
	}	
	else if ($name == 'CFC_10_coin_bronze')
	{
		continue;
	}		
	else if ($name == 'soft_jaggara_norja')
	{
		continue;
	}	
	else if (strpos($name, 'plasto') !== false)
	{
		continue;
	}		
	else if ($name == 'kinkysofa')
	{
		continue;
	}		
	else if ($name == 'ticket')
	{
		continue;
	}	
	else if ($name == 'photo')
	{
		continue;
	}			
	else if ($name == 'Chess')
	{
		continue;
	}			
	else if ($name == 'TicTacToe')
	{
		continue;
	}		
	else if ($name == 'BattleShip')
	{
		continue;
	}		
	else if ($name == 'Poker')
	{
		continue;
	}		
	else if ($name == 'floor')
	{
		continue;
	}		
	else if ($name == 'poster')
	{
		continue;
	}
	else if ($name == 'landscape')
	{
		continue;
	}			
	else if ($name == 'xmas_icewall')
	{
		continue;
	}			
	else if ($name == 'sf_wall')
	{
		continue;
	}
	else if ($name == 'xm09_frplc')
	{
		continue;
	}	
	else if ($name == 'ads_idol_chmpgn')
	{
		continue;
	}
	else if ($name == 'md_sofa')
	{
		continue;
	}
	
	$stuffWeDontKnow[] = '[' . $val . ']';
	$ij++;
	
	//echo $name . '<br />';
}

echo '<h2>New/missing furni (' . $ij . ')</h2><br />';

if ($ij >= 1)
{
	foreach ($stuffWeDontKnow as $stuff)
	{
		echo '<div style="padding: 5px; margin: 5px; border: 1px dotted; background-color: #F2F2F2; color: #151515;">' . $stuff . '</div><br />';
	}
}
else
{
	echo '<Br /><br /><center style="font-size: 120%;"><i><b>Good news!</b><br />I have no new furni for you today.</i></center>';
}

require_once "bottom.php";

?>								