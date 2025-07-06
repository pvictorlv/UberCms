<?php

define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";
$Addon = $gtfo->cleanWord($_GET['addon']);

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['ancho_xat']))
{

	$ancho_xat = $_POST['ancho_xat'];
	$alto_xat = $_POST['alto_xat'];
	$id_xat = $_POST['id_xat'];
	
		db::query("UPDATE configuracion SET ancho_xat='" . $ancho_xat . "',alto_xat='" . $alto_xat . "',id_xat='" . $id_xat . "'");
		fMessage('ok', 'Configuraci�n guardada.');
		
		header("Location: index.php?_cmd=addons-me");
		exit;
	}


require_once "top.php";

if($Addon == 'Chat'){
?>

<?php
$getOptions = db::query("SELECT * FROM configuracion LIMIT 1");
$Config = $getOptions->fetch(PDO::FETCH_ASSOC));
?>
<h1>Configuraci�n del Chat</h1>
<form method="post">

<br />

<div style="float: left;">

<strong>Alto Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['alto_xat']); ?>" name="alto_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Ancho Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['ancho_xat']); ?>" name="ancho_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>ID Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['id_xat']); ?>" name="id_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<h2>Ejemplo:</h2>
<br><br>
Tenemos este c�digo:
<br>
<br>
<textarea style="margin: 0px; width: 604px; height: 44px;"><embed src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="440" height="380" name="chat" FlashVars="id=159650001" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.shtml" /></textarea><br>
<br>
Alto: height="380", por lo tanto escibes 380.
<br>
<br>
Ancho: width="440", por lo tanto escribe 440.
<br>
<br>
ID: id=159650001, por lo tanto escribe 159650001.
<br>
<br>
<input type="submit" value="Guardar Cambios">

</form>



<?php }else{ ?>

<h2><center>No existe este addon o no es administrable</center></h2>

<?php } require_once "bottom.php"; ?>