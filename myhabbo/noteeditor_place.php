<?php
require_once '../global.php';
if (!LOGGED_IN) {
    exit;
}

if(isset($_SESSION['startSessionEditHome'])) {
	require_once "../nucleo/class.homes.php";
} elseif(isset($_SESSION['startSessionEditGroup'])) {
	if($core->GetGroupPerm($_SESSION['startSessionEditGroup']) < 2) {
	die('O que está fazendo?'); }
	require_once "../nucleo/class.groups.php";
}

if(isset($_POST['maxlength']) && isset($_POST['skin']) && isset($_POST['noteText']) && isset($_POST['scope']))
{

$skin = filter($_POST['skin']);
$maxlenght = filter($_POST['maxlength']);
$noteText = filter($_POST['noteText']);
$scope = filter($_POST['scope']);
$skin = 'n_skin_';
		switch($_POST['skin'])
		{
			case 1:
				$skin .= 'defaultskin';
				break;
			case 2:
				$skin .= 'speechbubbleskin';
				break;
			case 3:
				$skin .= 'metalskin';
				break;
			case 4:
				$skin .= 'noteitskin';
				break;
			case 5:
				$skin .= 'notepadskin';
				break;
			case 6:
				$skin .= 'goldenskin';
				break;
			case 7:
				$skin .= 'hc_machineskin';
				break;
			case 8:
				$skin .= 'hc_pillowskin';
				break;
			default:
				$skin .= '';
				break;
		}
		
		if(isset($_SESSION['startSessionEditHome'])) {
			db::query("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id, link) VALUES (NULL, '".USER_ID."', 'stickie', '10', '10', '6', '".$noteText."', '".$skin."', '".USER_ID."', '0');");
		} elseif(isset($_SESSION['startSessionEditGroup'])) {
			db::query("INSERT INTO groups_items (id, group_id, type, x, y, z, data, skin, owner_id, link) VALUES (NULL, '".filter($_SESSION['startSessionEditGroup'])."', 'stickie', '10', '10', '6', '".$noteText."', '".$skin."', '".USER_ID."', '0');");
		}
		db::query("DELETE from site_inventory_items WHERE type='Notes' AND userId = '".USER_ID."' LIMIT 1");
		
	if(isset($_SESSION['startSessionEditHome'])) {
		$sql = db::query("SELECT id from homes_items WHERE home_id = '".USER_ID."' AND data = '".$noteText."' LIMIT 1");
	} elseif(isset($_SESSION['startSessionEditGroup'])) {
		$sql = db::query("SELECT id from groups_items WHERE group_id = '".filter($_SESSION['startSessionEditGroup'])."' AND data = '".$noteText."' LIMIT 1");
	}
	$data = $sql->fetch(2);

	if(isset($_SESSION['startSessionEditHome'])) {
		$homeData = HomesManager::GetHome(HomesManager::GetHomeId('user', USER_ID));
	} elseif(isset($_SESSION['startSessionEditGroup'])) {
		$homeData = HomesManager::GetHome(HomesManager::GetHomeId('group', $_SESSION['startSessionEditGroup']));
	}
	
	$item = $homeData->GetItems($data['id']);
	
					echo $item->GetHtml();
	
}
?>