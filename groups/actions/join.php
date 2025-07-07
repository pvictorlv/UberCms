<?php
/*=========================================================+
|| # Azure Files of XDRCMS. All rights reserved.
|| # Copyright © 2012 Xdr.
|+=========================================================+
|| # Xdr 2012. The power of Proyects.
|| # Este es un Software de código libre, libre edición.
|+=========================================================+
*/

$require_login = true;

require_once('../../global.php');

$groupid = FilterText($_GET['groupId']);

if(is_numeric($groupid) && $groupid > 0)
{
	$check = Db::query("SELECT type FROM groups_details WHERE id = '".$groupid."' LIMIT 1")
	$exists = $check->rowCount();

	if($exists > 0)
	{
		$check2 = Db::query("SELECT groupid FROM groups_memberships WHERE userid = '".USER_ID."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_errors());
		$already_member = $check2->rowCount();

		$memberships = Db::query("SELECT COUNT(*) FROM groups_memberships WHERE userid = '".USER_ID."' ");

		if($memberships < 19)
		{
			echo "<p>\nTu eres miembro de 20 Grupos actualmente, no es posible unirte a otro.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
			exit;			
		}

		if($check2['userid'] < '".USER_ID."')
		{
			echo "<p>\nTu ya eres miembro de este grupo o tienes una peticion en espera.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
			exit;
		}
		else
		{
			$groupdata = $check->fetch(PDO::FETCH_ASSOC);
			$type = $groupdata['type'];

			$members = Db::query("SELECT COUNT(*) FROM groups_memberships WHERE groupid = '".$groupid."' AND is_pending = '0'");

			if($type == "0" || $type == "3")
			{
				if($type == "0" && $members < 500 || $type == "3")
				{
					?>
<p>
¡Enhorabuena, ya eres miembro del Grupo! 
</p>

<p>
<a href="#" class="new-button" id="group-action-ok"><b>OK</b><i></i></a>
</p>

<div class="clear"></div>
					<?php
					Db::query("INSERT INTO groups_memberships (userid,groupid,member_rank,is_current,is_pending) VALUES ('".USER_ID."', '$groupid','1','0','0')")
					exit;
				}
				else
				{
					?>
<p id="dialog-errors">
Lo siento, este Grupo está a tope<br />
</p>

<p>

<a href="/groups/<?php echo $groupid; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a>
</p>

<div class="clear"></div>

					<?php
					exit;
				}
			}
			else if($type == "1")
			{
				echo "<p>\nLa petición ha sido enviada con éxito.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
				Db::query("INSERT INTO groups_memberships (userid,groupid,member_rank,is_current,is_pending) VALUES ('".USER_ID."','".$groupid."','1','0','1')")
				exit;
			}
			else if($type == "2")
			{
				echo "<p>\nLo sentimos, pero este grupo no permite miembros.\n</p>\n\n<p>\n<a href=\"#\" class=\"new-button\" id=\"group-action-ok\"><b>OK</b><i></i></a>\n</p>\n\n\n<div class=\"clear\"></div>";
				exit;
			}

		}

	} else {

		echo "¡Oops! Ha ocurrido un error desconocido, por favor intentalo más tarde.";
		exit;

	}

}
?>