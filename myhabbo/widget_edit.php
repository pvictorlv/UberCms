<?php
if(!defined('NOWHOS'))
{
	define('NOWHOS', true);
}
define('Xukys', true);
require_once '../global.php';
require_once "../nucleo/class.homes.php";

if(isset($_POST['skinId']) && isset($_POST['widgetId']))
	{
		if(is_numeric($_POST['skinId']) && is_numeric($_POST['widgetId']))
			{

		switch($_POST['skinId'])
		{
			case 1:
				$skin = 'defaultskin';
				break;
			case 2:
				$skin = 'speechbubbleskin';
				break;
			case 3:
				$skin = 'metalskin';
				break;
			case 4:
				$skin = 'noteitskin';
				break;
			case 5:
				$skin = 'notepadskin';
				break;
			case 6:
				$skin = 'goldenskin';
				break;
			case 7:
				$skin = 'hc_machineskin';
				break;
			case 8:
				$skin = 'hc_pillowskin';
				break;
			default:
				$skin = '';
				break;
		}
				$skiId = 'w_skin_'.$skin;
				$sql = mysql_query("SELECT type,owner_id from homes_items where id = '".$_POST['widgetId']."' LIMIT 1");
				$data = mysql_fetch_array($sql);
				if($data['owner_id'] == USER_ID)
				{
				header('X-JSON: {"id":"' . $_POST['widgetId'] . '","cssClass":"' . $skiId . '","type":"'.$data['type'].'"}');
				echo HomeItem::UpdateItem($skiId, $_POST['widgetId']);
				}
			}
	}


?>