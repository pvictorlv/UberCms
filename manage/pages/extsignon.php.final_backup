<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$popClient = '';

if (isset($_POST['username']))
{
	$username = filter($_POST['username']);
	$get = db::query("SELECT id FROM users WHERE username = '" . $username . "' LIMIT 1");
	
	if (mysql_num_rows($get) == 1)
	{
		$id = intval(mysql_result($get, 0));
		$ticket = $core->GenerateTicket();
		
		db::query("UPDATE users SET auth_ticket = '" . $ticket . "' WHERE id = '" . $id . "' LIMIT 1");
		$core->Mus('signOut', $id);
		$popClient = $ticket;
		
		fMessage('ok', 'Creacion de entradas SSO temporal.');
	}
	else
	{
		fMessage('error', 'No se pudo localizar ese usuario');
	}
}

require_once "top.php";			

echo '<h1>Entrar Como Otro Usuario</h1>';

if ($popClient != '')
{
	echo "<input type=\"button\" onclick=\"popSsoClient('" . $popClient . "'); window.location = 'index.php?_cmd=extsignon'\" value=\"�Listo! Has clic aqui para acceder al hotel como " . $username . "\" style=\"margin: 20px; font-size: 150%;\">";
	echo '<input type="button" value="Done" onclick="window.location = \'index.php?_cmd=extsignon\';">';
}
else
{
	echo '<br /><p>Con esta Herramienta puedes entrar como otro Usuario. Eso puede ser util para administrar casos graves entre los Usuarios.</p><br />';
	echo '<form method="post">
	Usuario: <input type="text" name="username" value=""><input type="submit" value="Entrar">
	</form>';
}

require_once "bottom.php";

?>