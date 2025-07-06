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
require_once('../../Kernel/Init.php');

$groupid = FilterText($_POST['groupId']);

if(is_numeric($groupid)){

	$check = Db::query("SELECT type FROM groups_details WHERE id = '".$groupid."' LIMIT 1")
	$exists = $check->rowCount();

	if($exists > 0){

		$check2 = Db::query("SELECT groupid FROM groups_memberships WHERE userid = '".$my_id."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_errors());
		$already_member = $check2->rowCount();

		if($already_member > 0){

			Db::query("UPDATE groups_memberships SET is_current = '0' WHERE userid = '".$my_id."'")
			Db::query("UPDATE groups_memberships SET is_current = '1' WHERE userid = '".$my_id."' AND groupid = '".$groupid."' LIMIT 1")
			header("Location: ".PATH."/groups/" . $groupid ."/id"); exit;

		} else { exit; }

	} else {

		echo "SUCESS";  exit;

	}

}
?>