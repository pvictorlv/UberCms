<?php
$pagename= "Cambiar Coins";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$data = null;
$u = 0;


if (isset($_POST['user']) && isset($_POST['update']))
{
	$user = filter($_POST['user']);
	$vip_coins = filter($_POST['vip_coins']);
	dbquery("UPDATE users SET Vip_Coins = '".$vip_coins."' WHERE username = '".$user."' LIMIT 1");
	$msg = "¡Coins actualizadas con Exito!";

	}	
	else
	{
		$msg = "No se encontro usuario para dar las coins respectivas.";
	}

if (isset($_POST['user']) && isset($_POST['añadir']))
{
	$user = filter($_POST['user']);
	$vip_coins = filter($_POST['vip_coins']);
	$getuser = mysql_fetch_assoc(mysql_query("SELECT Vip_Coins FROM users WHERE username = '".$user."' LIMIT 1"));
	$Coins_Final = $getuser+$vip_coins;
	dbquery("UPDATE users SET Vip_Coins = '".$Coins_Final."' WHERE username = '".$user."' LIMIT 1");
	$msg = "¡Rango cambiado con Exito! Este ya tiene la placa correspondiente.";

	}	
	else
	{
		$msg = "No se encontro usuario para dar las coins respectivas.";
	}

require_once "top.php";
?>
<h2 class="title"><?php echo $pagename; ?></h2>
            <div class="box-content">
<?php if(isset($msg)){ ?><?php echo $msg; ?><?php } ?><br>
<br>
<h1>Selecciona como quieres modificar las coins. Por ejemplo, si quieres AÑADIR coins (Sumar la cantidad que tiene el usuario mas la que des) clickea en añadir, si quieres ACTUALIZAR coins (Actualizar las coins sin sumar las que ya tiene el usuario) clickea en actualizar.</h1>
<br><form method='post' name'rank' action='index.php?_cmd=vip_coins&do=give'>
<input type='radio' value='añadir' name='añadir' id='añadir'> Añadir

<input type='radio' value='update' name='update' id='update'> Actualizar
	<br><br>
	
		Usuario:<br />
		<input type="text" name="user"><br />
		<br />
		Vip Coins:<br /><input type="text" name="vip_coins"><br />
		<br />
		<input type="submit" value="Cambiar Coins">
	</form>



</div>
        </div>
    </div>
</div>
</div>
    </div>

<?php

require_once "botom.php";

?>