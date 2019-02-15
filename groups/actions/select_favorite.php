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

	$check = mysql_query("SELECT type FROM groups_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);

	if($exists > 0){

		$check2 = mysql_query("SELECT groupid FROM groups_memberships WHERE userid = '".$my_id."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_errors());
		$already_member = mysql_num_rows($check2);

		if($already_member > 0){

			mysql_query("UPDATE groups_memberships SET is_current = '0' WHERE userid = '".$my_id."'") or die(mysql_error());
			mysql_query("UPDATE groups_memberships SET is_current = '1' WHERE userid = '".$my_id."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_error());
			header("Location: ".PATH."/groups/" . $groupid ."/id"); exit;

		} else { exit; }

	} else {

		echo "SUCESS";  exit;

	}

}
?>