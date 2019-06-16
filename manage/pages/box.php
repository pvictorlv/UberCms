<?php
$pagename= "Editar Box Extra";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$maintMode = mysql_result(db::query("SELECT maintenance FROM site_config LIMIT 1"), 0);

if (isset($_GET['switch']))
{
	$newState = "1";

	if ($maintMode == "1")
	{
		$newState = "0";
	}

	db::query("UPDATE site_config SET maintenance = '" . $newState . "' LIMIT 1");
	$maintMode = $newState;
}

require_once "top.php";

?>

<h3><?php echo $pagename; ?></h3>
Titulo:<br>
<iframe name="prueba" src="../editor.php?fichero=nucleo/tpl/titulo.php" >
Si lees esto, tu navegador no soporta iframes (Hasta IE4 los soporta, deber�as actualizarte!)
</iframe>
<br>
<br>
Contenido:<br>
<iframe name="prueba" src="../editor.php?fichero=nucleo/tpl/contenido.php" >
Si lees esto, tu navegador no soporta iframes (Hasta IE4 los soporta, deber�as actualizarte!)
</iframe>

<?php

require_once "bottom.php";

?>