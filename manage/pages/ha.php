<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['hatext']))
{
	fMessage('ok', 'Message sent:<br />"' . clean($_POST['hatext']) . '"');
	$core->Mus('ha', clean($_POST['hatext']));
}

require_once "top.php";

?>			

<h1>Alerta de hotel</h1>

<br />

<p>
	Enviar una alerta a Todo el Hotel. <i> Comprueba siempre dos veces para evitar errores ortográficos.</i>
</p>

<br />

<p>
<?php if (isset($_POST['hatext'])) { ?>
<h1 style="padding: 15px;">Mensaje enviado <span style="border: 2px dotted gray; padding: 10px; margin: 5px; font-size: 70%; font-weight: normal;"><?php echo clean($_POST['hatext']); ?></span><input type="button" value="Send new message?" onclick="document.location = 'index.php?_cmd=ha';"></h1>
<?php } else { ?>
<form method="post">

<textarea name="hatext" cols="30" rows="3"></textarea>
<input type="submit" value="Enviar">

</form>
</p>
<?php
}

require_once "bottom.php";

?>