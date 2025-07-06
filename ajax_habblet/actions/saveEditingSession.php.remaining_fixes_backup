<?php
if(!defined('NOWHOS'))
{
	define('NOWHOS', true);
}
define('Xukys', true);
require_once '../../global.php';
require_once "../../nucleo/class.grupos.php";

if(!isset($_SESSION['startSessionEditGroup'])) {
	die('Qu intentas');
}

$startSessionEditGroup = $gtfo->cleanWord($_SESSION['startSessionEditGroup']);
if($core->GetGroupPerm($startSessionEditGroup) >= 2) {

if(isset($_POST["stickers"]))
	{
	
	$var = explode('/', $_POST['stickers']);
	//var_dump($var);
		foreach($var as $var_data)
			{
				if(empty($var_data))
				{
					break;
				}
				
				$vardata = explode(':', $var_data);
				$xyz = explode(',', $vardata[1]);
				
				$sql = Db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . mysql_real_escape_string($vardata[0]) ."' AND isWaiting = '1' LIMIT 1");
				if($sql->rowCount() > 0)
					{
						$row = $sql->fetch(PDO::FETCH_ASSOC);
						
						Db::query("INSERT INTO groups_items (id, group_id, type, x, y, z, data, skin, owner_id, link) VALUES (NULL, '".$startSessionEditGroup."', 'sticker', '".mysql_real_escape_string($xyz[0])."', '".mysql_real_escape_string($xyz[1])."', '".mysql_real_escape_string($xyz[2])."', '".$row['skin']."', '', '".USER_ID."', '".mysql_real_escape_string($vardata[0])."');");
//						Db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".mysql_real_escape_string($vardata[0])."' AND userId = '".USER_ID."' LIMIT 1;");
						//echo 'ok';
					}
				else
					{
						Db::query("UPDATE groups_items SET x = '".mysql_real_escape_string($xyz[0])."', y = '".mysql_real_escape_string($xyz[1])."', z = '".mysql_real_escape_string($xyz[2])."' WHERE id = '".mysql_real_escape_string($vardata[0])."' AND group_id = '".$startSessionEditGroup."' LIMIT 1");
						//echo 'else';
					}
			}
	
	
	}
	
if(isset($_POST["stickienotes"]))
	{
	
	$varstickienotes = explode('/', $_POST['stickienotes']);
	//var_dump($var);
		foreach($varstickienotes as $var_datastickienotes)
			{
			if(empty($var_datastickienotes))
				{
					break;
				}
				$vardatastickienotes = explode(':', $var_datastickienotes);
				$xyzstickienotes = explode(',', $vardatastickienotes[1]);
				
				$sqlstickienotes = Db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . mysql_real_escape_string($vardatastickienotes[0]) ."' AND isWaiting = '1' LIMIT 1");
				
				if($sqlstickienotes->rowCount() > 0)
					{
						$rowstickienotes = $sqlstickienotes->fetch(PDO::FETCH_ASSOC);
						
						Db::query("INSERT INTO groups_items (id, group_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '".$startSessionEditGroup."', 'sticker', '".mysql_real_escape_string($xyzstickienotes[0])."', '".mysql_real_escape_string($xyzstickienotes[1])."', '".mysql_real_escape_string($xyzstickienotes[2])."', '".$rowstickienotes['skin']."', '', '".USER_ID."');");
//						Db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".mysql_real_escape_string($vardatastickienotes[0])."' AND userId = '".USER_ID."' LIMIT 1");
					}
				else
					{
						Db::query("UPDATE groups_items SET x = '".mysql_real_escape_string($xyzstickienotes[0])."', y = '".mysql_real_escape_string($xyzstickienotes[1])."', z = '".mysql_real_escape_string($xyzstickienotes[2])."' WHERE id = '".mysql_real_escape_string($vardatastickienotes[0])."' AND group_id = '".$startSessionEditGroup."' LIMIT 1");
					}
			}
	
	
	}

	if(isset($_POST["widgets"]))
	{
	
	$varwidgets = explode('/', $_POST['widgets']);
	//var_dump($var);
		foreach($varwidgets as $var_datawidgets)
			{
			if(empty($var_datawidgets))
				{
					break;
				}
				$vardatawidgets = explode(':', $var_datawidgets);
				$xyzwidgets = explode(',', $vardatawidgets[1]);
				
				$sqlwidgets = Db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . mysql_real_escape_string($vardatawidgets[0]) ."' AND isWaiting = '1' LIMIT 1");
				
				if($sqlwidgets->rowCount() > 0)
					{
						$rowwidgets = $sqlwidgets->fetch(PDO::FETCH_ASSOC);
						
						//Db::query("INSERT INTO groups_items (id, group_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '".USER_ID."', 'sticker', '".mysql_real_escape_string($xyzwidgets[0])."', '".mysql_real_escape_string($xyzwidgets[1])."', '".mysql_real_escape_string($xyzwidgets[2])."', '".$rowwidgets['skin']."', '', '".USER_ID."');");
//						Db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".mysql_real_escape_string($vardatawidgets[0])."' AND userId = '".USER_ID."' LIMIT 1");
					}
				else
					{
						Db::query("UPDATE groups_items SET x = '".mysql_real_escape_string($xyzwidgets[0])."', y = '".mysql_real_escape_string($xyzwidgets[1])."', z = '".mysql_real_escape_string($xyzwidgets[2])."' WHERE id = '".mysql_real_escape_string($vardatawidgets[0])."' AND group_id = '".$startSessionEditGroup."' LIMIT 1");
					}
			}
	
	
	}
	
	if(isset($_POST['background']))
	{
		$background = $gtfo->cleanWord($_POST['background']);
		$bg = explode(':', $_POST['background']);
		
			if(is_numeric($bg[0]))
			{
				$sql = Db::query("SELECT userId from site_inventory_items WHERE id = ?'");
				$data = $sql->fetch(PDO::FETCH_ASSOC);
				//echo $bg[0];
					
					if($sql->rowCount() > 0)
					{
						if($data['userId'] == USER_ID)
						{
					
							Db::query("UPDATE groups SET bgimage = '".$bg[1]."' WHERE home_id = ?'");
							//echo 'ok';
						}
					}
					
			}
		
		
		
	}
}
else {
	die();
}
?>
<script language="JavaScript" type="text/javascript">
waitAndGo('/groups/<?php echo $_SESSION['startSessionEditGroup']; ?>/id');
</script>
<?php unset($_SESSION['startSessionEditGroup']); ?>