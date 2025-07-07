<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['edit']))
{
	$id = intval($_POST['edit']);
	$image = filter($_POST['image']);
	$titulo = filter($_POST['title']);
	$cuerpo = filter($_POST['cuerpo']);
	$orden = filter($_POST['order']);

	
	if (!is_numeric($orden) || intval($orden) <= 0)
	{
		$order = 0;
	}
	
	db::query("UPDATE site_promos SET imagen = '" . $image . "', titulo = '" . $titulo . "', cuerpo = '" . $cuerpo . "'WHERE orden = '" . $orden . "' LIMIT 1");
	fMessage('ok', 'Updated campaign.');
}


require_once "top.php";

?>			

<h1>Noticiones</h1>

<br />

<p>
	Puedes utilizar esta Herramienta para Editar Las "Promos". Estas son las Im�genes del ME.
</p>
<br>
<h2>Manejar elementos</h2>

<br />

<table width="100%" border="1">
<thead>
<tr>
	<td>ID</td>
	<td>Imagen</td>
	<td>Titulo</td>
	<td>Cuerpo</td>
</tr>
</thead>
<tbody>
<?php

$getItems = db::query("SELECT * FROM site_promos");

while ($item = $getItems->fetch(PDO::FETCH_ASSOC)))
{
	echo '<tr>
	<form method="post">
	<input type="hidden" name="edit" value="' . $item['id'] . '">
	<td>' . $item['id'] . '</td>
	<td><br /><input type="text" name="image" value="' . clean($item['imagen']) . '"></td>
	<td><input type="text" name="title" value="' . clean($item['titulo']) . '"></td>
	<td><input type="text" name="cuerpo" value="' . clean($item['cuerpo']) . '"></td>
	<td><center><input type="hidden" size="3" name="order" value="' . $item['orden'] . '"></center></td>
	<td><input type="submit" value="Guardar"></td>
	</form>
	</tr>';
}

?>

</tbody>
</table>

<?php

require_once "bottom.php";

?>