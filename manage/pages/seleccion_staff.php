<?php
$pagename= "Selección Staff";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['type']))
{
	$type = filter($_POST['type']);
	$id_rec = filter($_POST['id_rec']);

	
	if (strlen($type) < 1)
	{
		fMessage('error', 'Rellene todos los campos.');
		echo '<b>Rellene todos los campos!</b><META HTTP-EQUIV="refresh" CONTENT="5; url=index.php?_cmd=seleccion_staff">';
	}
	else
	{
        dbquery("INSERT INTO cms_recommended (id_rec,type) VALUES ('". $id_rec ."', '" . $type . "')");
		fMessage('ok', 'Noticia publicada con éxito.');
		
		echo '<b>La noticia ha sido publicada correctamente, redireccionando a la administración..</b><META HTTP-EQUIV="refresh" CONTENT="5; url=index.php?_cmd=newspublish">';
		exit;
	}
}

require_once "top.php";

?>

<h3><?php echo $pagename; ?></h3>
Selecciona un Grupo o una sala a la Selección Staff.
<br />
<br />

<form method="post">

ID de la Sala o Grupo: <input type="text" id="url" name="id_rec" value="" maxlength="120"><br /><br />

¿Grupo o sala? <select name="type">
<option selected> ---
<option value="group">Grupo
<option value="room">Sala
</select>

<br>
<br>
<input type="submit" value="Enviar alerta">
</form>
<?php

require_once "bottom.php";

?>