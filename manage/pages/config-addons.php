<?php

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
	$pixeles = $_POST['pixeles'];
	$radio = $_POST['radio'];
	
		db::query("UPDATE configuracion SET ancho_xat='" . $ancho_xat . "',alto_xat='" . $alto_xat . "',id_xat='" . $id_xat . "'");
		fMessage('ok', 'Configuraci�n guardada.');
		
		header("Location: index.php?_cmd=config");
		exit;
	}


require_once "top.php";

?>			

<h1>Configuraci�n General</h1>
<form method="post">

<br />

<div style="float: left;">

<?php
$getOptions = db::query("SELECT * FROM configuracion LIMIT 1");
$Config = mysql_fetch_array($getOptions);
?>

<strong>Nombre del Hotel:</strong><br />
<input type="text" value="<?php echo clean($Config['nombre']); ?>" name="nombre" size="50"  style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Logo del Hotel:</strong><br />
<input type="text" value="<?php echo clean($Config['logo']); ?>" name="logo" size="50"  style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Cr�ditos iniciales:</strong><br />
<input type="text" value="<?php echo $Config['creditos']; ?>" name="creditos" size="50" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>P�xeles iniciales:</strong><br />
<input type="text" value="<?php echo clean($Config['pixeles']); ?>" name="pixeles" size="50"  style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Alto Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['alto_xat']); ?>" name="alto_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Ancho Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['ancho_xat']); ?>" name="ancho_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>ID Chat:</strong><br />
<input type="text" value="<?php echo clean($Config['id_xat']); ?>" name="id_xat" size="20" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Radio:</strong><br />
<input type="text" value="<?php echo clean($Config['radio']); ?>" name="radio" size="50"  style="padding: 5px; font-size: 130%;"><br />
<br />

<input type="submit" value="Guardar Cambios">

</form>


<?php

require_once "bottom.php";

?>