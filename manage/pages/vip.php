<?php
$pagename= "Dar Rangos";
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

if (isset($_POST['rank']))
{
	$user = filter($_POST['user']);
	$rank = filter($_POST['rank']);
	dbquery("UPDATE users SET rank = '".$rank."' WHERE username = '".$user."' LIMIT 1");
	$msg = "¡Rango cambiado con Exito! Este ya tiene la placa correspondiente.";

	}	
	else
	{
		$msg = "¡No se encontro usuario para dar rango.";
	}


require_once "top.php";
?>
<h2 class="title"><?php echo $pagename; ?></h2>
            <div class="box-content">
<?php if(isset($msg)){ ?><?php echo $msg; ?><?php } ?><br>
	
<form method='post' name'rank' action='index.php?_cmd=vip&do=give'>
	
		Usuario:<br />
		<input type="text" name="user"><br />
		<br />
		Rango:<br />
		<select name='rank'  class='dropdown'>
<option value='2'>Rango VIP</option>
<option value='1'>Sin Rango</option>
								    </select><br />
		<br />
		<input type="submit" value="Dar Rango">
	</form>



</div>
        </div>
    </div>
</div>
</div>
    </div>

<?php

require_once "bottom.php";

?>