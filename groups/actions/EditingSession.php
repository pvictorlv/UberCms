<?php
####################################################
## InfoCMS - Emulaci�n del sitio de Habbo Hotel.  ##
####################################################
## Este Software basado en PHP, Curl y HTML es de ##
## libre edici�n y c�digo libre, cualquier		  ##
## modificaci�n es permitida siempre y cuando	  ##
## respete para lo que fue dise�ado.			  ##
####################################################
## Copyright � 2010. Kolesias123 & InfoSmart.	  ##
## http://www.infosmart.com.mx/					  ##
####################################################
## Copyright � 2010. Sulake Corporation Oy.		  ##
## http://www.sulake.com/ ~ http://www.habbo.es/  ##
####################################################

require_once('../../global.php');

$do = CleanText($_GET['do'], true);
$groupId = FilterText($_GET['groupId'], true);

if($do == "start")
{
	$check = db::query("SELECT null FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");

	if($check > 0)
	{
		$editingSession = (time() + (30 * 60));
		query("UPDATE users_groups SET editingSession = '" . $editingSession . "' WHERE id = '" . $groupId . "' LIMIT 1");
		
		$_SESSION['groups']['editingSession_groupId'] = $groupId;
		
		$Users->restoreWaitingItems($myid);
		header("Location: /groups/" . $groupId . "/id");
		exit;
	}
}
else if($do == "cancel")
{
	$groupId = $_SESSION['groups']['editingSession_groupId'];
	$check = query_rows("SELECT null FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");

	if($check > 0)
	{
		query("UPDATE users_groups SET editingSession = '0' WHERE id = '" . $groupId . "' LIMIT 1");
		
		unset($_SESSION['groups']['editingSession_groupId']);
		
		$Users->restoreWaitingItems($myid);
		header("Location: /groups/" . $groupId . "/id");
		exit;
	}
}
else if($do == "save")
{
	$groupId = $_SESSION['groups']['editingSession_groupId'];
	$stickers = FilterText($_POST['stickers']);
	$background = FilterText($_POST['background']);
	
	// Guardando Stickers
	if(!empty($stickers))
	{
		$theStickers = explode("/", $stickers);
	
		foreach($theStickers as $Sticker)
		{
			$sticker = explode(":", $Sticker);
			$Positions = explode(",", $sticker[1]);
		
			$stickerId = $sticker[0];
			$position_left = $Positions[0];
			$position_top = $Positions[1];
			$position_z = $Positions[2];
		
			$checkSticker = query("SELECT * FROM site_inventory_items WHERE userId = '" . $myid . "' AND id = '" . $stickerId ."' AND isWaiting = '1' LIMIT 1");
			$checkAlreadySticker = query("SELECT * FROM site_items WHERE groupId = '" . $groupId . "' AND id = '" . $stickerId ."' AND type = 'sticker' LIMIT 1");
		
			if($checkSticker->rowCount() > 0)
			{
				$row = $checkSticker->fetch(PDO::FETCH_ASSOC));
			
				$Users->newItem(0, $groupId, $position_left, $position_top, $position_z, "", $row['skin'], "", "sticker");
				$Users->removeWaitingItem($myid, $stickerId);
			}
			else if($checkAlreadySticker->rowCount() > 0)
			{
				$row = $checkAlreadySticker->fetch(PDO::FETCH_ASSOC));
				
				$Users->updateItem($stickerId, 0, $groupId, $position_left, $position_top, $position_z);
			}
		}
	}
	
	// Guardando Fondo
	if(!empty($background))
	{
		$theBackground = explode(":", $background);
	
		$Users->updateGroup("bg_color", $theBackground[1], $groupId);
	}
	
	query("UPDATE users_groups SET editingSession = '0' WHERE id = '" . $groupId . "' LIMIT 1");		
	unset($_SESSION['groups']['editingSession_groupId']);
	
	echo "<script language=\"JavaScript\" type=\"text/javascript\">
waitAndGo('/groups/" . $groupId . "/id');
</script>";
	exit;
}

header("Location: ");
exit;
?>