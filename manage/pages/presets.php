<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_GET['new']))
{
	dbquery("INSERT INTO moderation_presets (type,enabled,message) VALUES ('message','0','Newly generated preset - please update')");
	
	fMessage('ok', 'New preset generated.');
	
	header("Location: index.php?_cmd=presets");
	exit;
}

if (isset($_GET['delete']) && is_numeric($_GET['delete']))
{
	dbquery("DELETE FROM moderation_presets WHERE id = '" . intval($_GET['delete']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Mesanej borrado correctamente');
	}
	
	header("Location: index.php?_cmd=presets");
	exit;	
}

if (isset($_POST['preset-save']) && is_numeric($_POST['preset-save']))
{
	$id = intval($_POST['preset-save']);
	$type = filter($_POST['type']);
	$enabled = filter($_POST['enabled']);
	$message = filter($_POST['message']);
	
	dbquery("UPDATE moderation_presets SET type = '" . $type . "', enabled = '" . $enabled . "', message = '" . $message . "' WHERE id = '" . $id . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Updated preset.');
	}
}

require_once "top.php";

?>			

<h1>Herramientas Mods</h1>

<h2>Herramienta de salas</h2>
<br />

<table width="100%" border="1" >
<thead>
	<td>ID</td>
	<td>Tipo</td>
	<td>Estado</td>
	<td>Mensaje</td>
	<td>Opciones</td>
</thead>
<tbody>
<?php

$get = dbquery("SELECT * FROM moderation_presets ORDER BY id DESC");

while ($p = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<form method="post">';
	echo '<input type="hidden" name="preset-save" value="' . $p['id'] . '">';
	echo '<td>#' . $p['id'] . '</td>';
	echo '<td><select name="type"><option value="message">Mensaje hacia usuario (friendly)</option><option value="roommessage"';
	
	if ($p['type'] == "roommessage")
	{
		echo ' selected';
	}
	
	echo '>Mensaje de sala</option></select></td>';
	echo '<td><select name="enabled"><option value="1">Activado</option><option value="0"';
	
	if ($p['enabled'] == "0")
	{
		echo ' selected';
	}
	
	echo '>Desactivado</option></select></td>';
	echo '<td><textarea name="message" cols="50" rows="5">' . clean($p['message']) . '</textarea></p></td>';
	echo '<td><input type="submit" value="Guardar">&nbsp;<input type="button" onclick="document.location = \'index.php?_cmd=presets&delete=' . $p['id'] . '\';" value="Borrar"></td>';
	echo '</form>';
	echo '</tr>';
}

?>
</tbody>
</table>

<br />
<br />

<center>

	<a href="index.php?_cmd=presets&new">
		<b>Agregar nuevo</b>
	</a>
	
	<br /><br />
	
	<i style="color: darkred;">
		NOTA: Los cambios no se veran en el hotel hasta que se reinicie el servidor.
	</i>
</center>



<?php

require_once "bottom.php";

?>