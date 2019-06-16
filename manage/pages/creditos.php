<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['usuario']))
{   $usuario = filter($_POST['usuario']);
	$creditos_actuales = db::query("SELECT credits FROM users WHERE username = '". $usuario ."'");	
	$creditos = filter($_POST['creditos']);
	$creditos_totales = $creditos_actuales + $creditos;
	
	if (empty($usuario) || empty($creditos))
	{
		fMessage('error', 'Por Favor llena todos los datos.');
	}
	else
	{
		db::query("UPDATE `users` SET `credits` = '". $creditos_totales ."' WHERE `username` = '". $usuario ."';");
		fMessage('ok', 'Nuevo articulo publicdado.');
		
		header("Location: index.php?_cmd=news");
		exit;
	}
}

require_once "top.php";

?>			

<h1>A�adir Cr�ditos</h1>
<form method="post">

<br />

<div style="float: left;">

<strong>Usuario:</strong><br />
<input type="text" value="<?php if (isset($_POST['usuario'])) { echo clean($_POST['usuario']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Creditos:</strong><br />
<input type="text" value="<?php if (isset($_POST['creditos'])) { echo clean($_POST['creditos']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br /><br />

<input type="submit" value="Modificar">

</form>


<?php

require_once "bottom.php";

?>