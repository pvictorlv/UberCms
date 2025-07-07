<?php
/*=========================================================+
|| # Azure Files of XDRCMS. All rights reserved.
|| # Copyright  2012 Xdr.
|+=========================================================+
|| # Xdr 2012. The power of Proyects.
|| # Este es un Software de cdigo libre, libre edicin.
|+=========================================================+
*/


require_once('../../Kernel/Init.php');

$url = FilterText($_POST['url'], true);
$groupId = FilterText($_POST['groupId'], true);
$valid_url = ereg("^[A-Za-z0-9_-]{3,}$", $url);

$check = query("SELECT * FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");
$exist = $check->rowCount();

if($exist > 0)
{
	$urlExist = query_rows("SELECT null FROM users_groups WHERE nameUrl = '" . $url . "' LIMIT 1");
	
	if($urlExist > 0)
	{
		echo "ERROR " . $url . " est reservado para otro Grupo";
	}
	else if(!$valid_url)
	{
		echo "ERROR El alias de tu Grupo contiene caracteres invlidos. Slo son aceptados los del tipo A-z, a-z, 0-9, - y _";
	}
	else
	{
		echo "El alias de tu Grupo va a ser " . SITE . "/groups/" . $url . ". No podrs cambiarlo despus.";
	}
}

exit;
?>


