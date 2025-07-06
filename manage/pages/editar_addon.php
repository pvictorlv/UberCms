<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";

if(isset($_GET['nombre'])){
$Nombre = $gtfo->cleanWord($_GET['nombre']);
$GetAddon = Db::query("SELECT * FROM site_addons WHERE nombre='".$Nombre."'")->fetch(PDO::FETCH_ASSOC);

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['nombre']))
{
	$nombre = $_POST['nombre'];
	$nombretpl = $_POST['nombre-tpl'];
	$columna = $_POST['columna'];
	$orden = $_POST['orden'];		

	
		db::query("UPDATE site_addons SET nombre='".$nombre."',nombretpl='".$nombretpl."',columna='".$columna."',orden='".$orden."' WHERE nombre='".$Nombre."'");
		fMessage('ok', 'Configuraci�n guardada.');
		
		header("Location: index.php?_cmd=addons-me");
		exit;
	}


require_once "top.php";

$Verificar11 = Db::query("SELECT * FROM site_addons WHERE columna = '1' ORDER BY orden");
$Verificar22 = Db::query("SELECT * FROM site_addons WHERE columna = '2' ORDER BY orden");
$Verificar2 = $Verificar22->fetch(PDO::FETCH_ASSOC);

?>	

<h1>Nuevo Addon</h1>
<form method="post">

<br />

<div style="float: left;">

<strong><font color="red"><?php if(isset($error)){ echo $error; }; ?></font></strong><br><br>

<strong>Nombre del Addon:</strong><br />
<input type="text" name="nombre" value="<?php echo $Nombre ?>" size="40" style="padding: 5px; font-size: 130%;"><br />
<br />


<strong>Ordenes ocupados (Columna 1):</strong> <?php while($Verificar1 = $Verificar11->fetch(PDO::FETCH_ASSOC)){ echo '<li>'. $Verificar1['orden'].'</li>'; };?><br>
<strong>Ordenes ocupados (Columna 2):</strong> <?php while($Verificar2 = $Verificar22->fetch(PDO::FETCH_ASSOC)){ echo '<li>'. $Verificar2['orden'].'</li>'; };?><br>
<strong>Orden del Addon:</strong><br />
<select name='orden'>
<option value='1' <?php if ($GetAddon['orden'] == '1') { echo 'selected';};?>>1</option>
<option value='2' <?php if ($GetAddon['orden'] == '2') { echo 'selected';};?>>2</option>
<option value='3' <?php if ($GetAddon['orden'] == '3') { echo 'selected';};?>>3</option>
<option value='4' <?php if ($GetAddon['orden'] == '4') { echo 'selected';};?>>4</option>
<option value='5' <?php if ($GetAddon['orden'] == '5') { echo 'selected';};?>>5</option>
   </select><br />
<br />

<strong>Columna del Addon:</strong><br />
<select name='columna'>
<option value='1' <?php if ($GetAddon['columna'] == '1') { echo 'selected';};?>>1</option>
<option value='2' <?php if ($GetAddon['columna'] == '2') { echo 'selected';};?>>2</option>
   </select><br />
   <br />

<strong>�Activado?</strong><br />
<select name='activado'>
<option value='1' <?php if ($GetAddon['activado'] == '1') { echo 'selected';};?>>Si</option>
<option value='0' <?php if ($GetAddon['activado'] == '0') { echo 'selected';};?>>No</option>
   </select><br /><br>

<strong>Nombre del TPL (sin la terminaci�n .tpl):</strong><br />
<input type="text" name="nombre-tpl" value="<?php echo $GetAddon['nombretpl'];?>" size="40" style="padding: 5px; font-size: 130%;">.TPL<br />
<br />

<input type="submit" value="Guardar Addon">

</form>


<?php

require_once "bottom.php";

}else{require_once 'pages/404.php';}

?>