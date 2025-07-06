<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

$newOrderNum = intval(mysql_result(db::query("SELECT MAX(order_num) FROM site_app_form LIMIT 1"), 0)) + 1;

if (isset($_GET['doDel']))
{
	db::query("DELETE FROM site_app_form WHERE id = '" . filter($_GET['doDel']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deleted form element.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doUp']))
{
	db::query("UPDATE site_app_form SET order_num = order_num + 1 WHERE id = '" . filter($_GET['doUp']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Movido por elemento.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doDown']))
{
	db::query("UPDATE site_app_form SET order_num = order_num - 1 WHERE id = '" . filter($_GET['doDown']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Movido por elemento.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_POST['new-element-id']))
{
	$id = filter(strtolower($_POST['new-element-id']));
	$type = filter(strtolower($_POST['new-element-type']));
	$name = filter($_POST['new-element-name']);
	$descr = filter($_POST['new-element-descr']);
	$required = "no";
	
	if (isset($_POST['new-element-required']))
	{
		$required = filter(strtolower($_POST['new-element-required']));
	}
	
	$errors = Array();
	
	if (strlen($id) == 0 || strlen($id) > 24)
	{
		$errors[] = "Invalid ID supplied. Must be 0 - 24 chars long.";
	}
	
	if ($type != "textbox" && $type != "textarea"
	&& $type != "checkbox")
	{
		$type = "textbox";
	}
	
	if (count($errors) == 0)
	{
		fMessage('ok', 'Elemento a�adido a formulario de solicitud!');
		
		$req = "0";
		
		if ($required == "yes")
		{
			$req = "1";
		}
		
		db::query("INSERT INTO site_app_form (id,caption,descr,field_type,required,order_num) VALUES ('" . $id . "','" . $name . "','" . $descr . "','" . $type . "','" . $req . "','" . $newOrderNum . "')");
	}
	else
	{
		fMessage('error', 'No se pudo agregar elemento, por favor verifique entrada.');
	}
}

require_once "top.php";

?>			

<h1>Solicitud de Empleo</h1>

<p>
	Siempre que un usuario solicita un trabajo, que tendr�n que rellenar un formulario de solicitud predefinidos, que puede gestionar aqu�.
</p>

<h2>

<b>A�adir elemento nuevo formulario</b> (<a href="#" onclick="t('elform');">Ocultar/mostrar</a>)

<div id="elform" style="padding: 10px;">
<br />

<form method="post">

Tipo de campo:<br />
<select name="new-element-type">
<option value="textbox">Cuadro de texto normal</option>
<option value="textarea">Area de texto (para el texto grandes l�neas de multipile)</option>
<option value="checkbox">Casilla de verificaci�n (Descripci�n ser� utilizado como texto)</option>
</select>

<br /><br />ID de elemento (corto, <u> �nica  </u>, y el nombre interno para identificar este campo - no hay caracteres especiales, por favor):<br />
<input type="text" value="" maxlength="24" name="new-element-id">

<br /><br />Nombre de Forma:<br />
<input type="text" value="" maxlength="120" name="new-element-name">

<br /><br />Forma de Descripcion:<br />
<textarea name="new-element-descr" cols="50" rows="4"></textarea>

<br /><br />

<input type="checkbox" value="yes" name="new-element-required"> Este es un campo obligatorio

<br /><br />

<input type="submit" value="A�adir nuevo elemento para formar">

<br /><br />

</form>
</div>

</h2>

<h2>Administrar / Vista Preliminar formulario de solicitud</h2>
<br />

<form method="post">

<?php

$getElements = db::query("SELECT * FROM site_app_form ORDER BY order_num ASC");

echo '<ol style="margin-left: 20px;">';

while ($el = mysql_fetch_assoc($getElements))
{
	echo '<li>';
	
	echo $el['id'] . '&nbsp;';
	
	if ($el['required'] == "1")
	{
		echo '<b style="color: darkred;"><small>(This is a required field)</small></b><br />';
	}
	
	echo '<div style="width: 75%; border: 1px dotted; background-color: #F2F2F2; margin-top: 5px; padding: 10px;">';
	
	switch ($el['field_type'])
	{
		case "checkbox":
		
			echo '<input type="checkbox" value="checked" name="' . $el['id'] . '"> ' . clean($el['descr']);
			break;
	
		case "textarea":
		
			echo clean($el['caption']) . '<br />';
			echo '<textarea name="' . $el['id'] . '"></textarea>';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	
		case "textbox":
		default:
		
			echo clean($el['caption']) . '<br />';
			echo '<input type="text" name="' . $el['id'] . '" value="">';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	}
	
	echo '</div>';
	
	echo '<Br />';
	echo 'Order num: ' . $el['order_num'] . ' | ';
	echo '<a href="index.php?_cmd=jobform&doUp=' . $el['id'] . '">Move hacia arribz</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDown=' . $el['id'] . '">Mover hacia abajo</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDel=' . $el['id'] . '">Delete this element</a>';	
	
	echo '<br />';
	echo '<br />';
	echo '<br />';
	
	echo '</li>';
}

echo '<li><i>Boton de Confirmar</i><br /><div style="border: 1px dotted; width: 50px; padding: 10px;">';
echo '<input type="submit" value="Aceptar">';
echo '</div></li>';

echo '</ol><br />';

?>

</form>


<?php

require_once "bottom.php";

?>