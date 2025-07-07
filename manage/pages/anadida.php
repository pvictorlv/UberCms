<?php
$pagename= "Selección Añadida";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

require_once "top.php";

?>

<h3>Selección Añadida</h3>
Has insertado correctamente la Sala - Grupo.
<br />
<br />

<?php

require_once "bottom.php";

Db::query("INSERT INTO cms_recommended (id_rec,type) VALUES ('". $_POST['id_rec'] ."', '" . $_POST['type'] . "'");

?>