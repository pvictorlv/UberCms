<?php
$pagename= "Users Alerts";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['content']))
{

	$content = filter($_POST['content']);
	$user_id = filter($_POST['user_id']);

	if (strlen($content) < 1)
	{
		fMessage('error', 'Inserte la alerta.');
		$errors= '<b><font color="#FF0000">Porfavor Inserte la alerta</font></b></br></br>';
	}
	else  if (strlen($user_id) < 1)

                  {
		fMessage('error', 'Inserte la alerta.');
		$errors= '<b><font color="#FF0000">Porfavor Inserte El usuario o ID</font></b></br></br>';
	}
                 else
	{                 dbquery("SELECT * From users Where id ='". $user_id ."' or username = '". $user_id ."' ");
		dbquery("INSERT INTO users_alerts (id,user_id,alert) VALUES ('0','". $user_id ."', '" . $content . "') ");
		fMessage('ok', 'Alerta Enviada.');
		
		echo '<b>Alerta enviada con exito!</b><META HTTP-EQUIV="refresh" CONTENT="5; url=index.php?_cmd=users_alerts">';
		exit;
	}
}

require_once "top.php";

?>

<h3><?php echo $pagename; ?></h3>
Envia una alerta al usuario.
<br />
<br />

<form method="post">
<?php echo $errors ?><?php echo $correct ?>

ID del usuario: <input type="text" id="url" name="user_id" value="" maxlength="120"><?php if (isset($_POST['user_id'])) { echo clean($_POST['user_id']); } ?><br /><br /><br />

<script type="text/javascript" src="./tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "content",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>

<textarea id="content" name="content" style="width:80%"><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea>
  <p>Your browser does not support iframes.</p>
</iframe>
<br>
<br>
<input type="submit" value="Enviar alerta">
</form>
<?php

require_once "bottom.php";

?>