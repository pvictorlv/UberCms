<?php
$pagenames= "Vaciar Tablas";
$pagename= "Vaciar Tablas";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$maintMode = mysql_result(dbquery("SELECT maintenance FROM site_config LIMIT 1"), 0);

if (isset($_GET['switch']))
{
	$newState = "1";

	if ($maintMode == "1")
	{
		$newState = "0";
	}

	dbquery("UPDATE site_config SET maintenance = '" . $newState . "' LIMIT 1");
	$maintMode = $newState;
}

require_once "top.php";

?>

<h3><?php echo $pagename; ?></h3>

Si deseas vaciar las tablas haz click <a href="/vaciartablas.php"><b>aqui.</b></a>

<?php

require_once "bottom.php";

?>