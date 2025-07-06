<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']))
{
	db::query("DELETE FROM site_app_openings WHERE id = '" . intval(filter($_GET['doDel'])) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deleted listed opening.');
	}
	
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['n-name']) && strlen($_POST['n-name']) >= 1)
{
	db::query("INSERT INTO site_app_openings (id,name,text_descr,text_reqs,text_duties) VALUES (NULL,'" . filter($_POST['n-name']) . "','" . filter($_POST['n-descr']) . "','" . filter($_POST['n-reqs']) . "','" . filter($_POST['n-duties']) . "')");
	fMessage('ok', 'Trabajo de apertura en la lista!');
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['edit']) && is_numeric($_POST['edit']))
{
	db::query("UPDATE site_app_openings SET name = '" . filter($_POST['e-name']) . "', text_descr = '" . filter($_POST['e-descr']) . "', text_reqs = '" . filter($_POST['e-reqs']) . "', text_duties = '" . filter($_POST['e-duties']) . "' WHERE id = '" . intval($_POST['edit']) . "' LIMIT 1");
	fMessage('ok', 'Trabajo de apertura en la lista!');
	header("Location: index.php?_cmd=jobopenings");
	exit;	
}

require_once "top.php";

?>			

<h1>Ofertas de Empleo</h1>

<p>
	Ofertas de empleo se muestra en el Centro de Soporte en el sitio web. Usuario Se dar� la oportunidad de solicitar para ellos. Tambi�n pueden presentar una solicitud abierta si su posici�n deseada no aparece en la lista. Las solicitudes presentadas se puede moderar a trav�s de <a href="index.php?_cmd=jobapps">la moderacion de Trabajo</a>.
</p>

<h2>Crear nueva oferta</h2><br />
<form method="post">

Nombre:<br />
<input type="text" maxlength="100" name="n-name"><br />
<br />
Descripcion:<br />
<textarea name="n-descr" cols="50" rows="4"></textarea><br />
<br />
Requerimientos:<br />
<textarea name="n-reqs" cols="50" rows="4"></textarea><br />
<br />Responsabilidades y Deberes:<br />
<textarea name="n-duties" cols="50" rows="4"></textarea><br />
<br />

<input type="submit" value="Enviar"><br />

</form>

<br />

<h3>Ofertas actuales figuran:</h3>

<?php

$get = db::query("SELECT * FROM site_app_openings");

while ($opening = $get->fetch(PDO::FETCH_ASSOC)))
{
	echo '<h2>';
	echo '<a href="#"><b style="font-size: 135%;">' . clean($opening['name']) . '</b></a><br />' . clean($opening['text_descr']) . '&nbsp;';
	echo '(<a href="#" onclick="t(\'edit-' . $opening['id'] . '\');">Editar</a>)';
	echo '&nbsp;(<a href="index.php?_cmd=jobopenings&doDel=' . $opening['id'] . '">Remover</a>)';
	
	echo '<div id="edit-' . $opening['id'] . '" style="display: none;">';
	echo '<br /><h3>Editar ofertas de trabajo</h3><br />';
	
	echo '<form method="post">
	<input type="hidden" name="edit" value="' . $opening['id'] . '">
	Name:<br />
	<input type="text" maxlength="100" name="e-name" value="' . clean($opening['name']) . '"><br />
	<br />
	Descripcion:<br />
	<textarea name="e-descr" cols="50" rows="4">' . clean($opening['text_descr']) . '</textarea><br />
	<br />
	Requirements:<br />
	<textarea name="e-reqs" cols="50" rows="4">' . clean($opening['text_reqs']) . '</textarea><br />
	<br />
	Responsabilidades y Deberes:<br />
	<textarea name="e-duties" cols="50" rows="4">' . clean($opening['text_duties']) . '</textarea><br />
	<br />
	<input type="submit" value="Guardar Cambios"><br />
	</form>';
	
	echo '</div>';
	
	echo '</h2>';
}

require_once "bottom.php";

?>