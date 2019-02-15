<?php

require_once('../../global.php');

$groupid = FilterText($_POST['groupId']);

if(!is_numeric($groupid)){
	exit;
}

$check = mysql_query("SELECT * FROM groups_memberships WHERE userid = '".USER_ID."' AND groupid = '".$groupid."' AND member_rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$my_membership = mysql_fetch_assoc($check);
	$member_rank = $my_membership['member_rank'];
} else {
	exit;
}

$check = mysql_query("SELECT * FROM group_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

if(mysql_num_rows($check) > 0){
	$groupdata = mysql_fetch_assoc($check);
	$ownerid = $groupdata['ownerid'];
} else {
	exit;
}

if($ownerid !== "'.USER_ID.'"){
	exit;
} elseif($ownerid == "'.USER_ID.'"){
	error_reporting(0);
	$image = "".$path."/habbo-imaging/badge-fill/$groupdata[badge].gif";

	if(file_exists($image)) {
		unlink($image);
	}
	error_reporting(1);
	mysql_query("DELETE FROM group_details WHERE id = '".$groupid."' LIMIT 1");
	mysql_query("DELETE FROM group_members WHERE id_group = '".$groupid."'");
	mysql_query("DELETE FROM homes_group_linker WHERE groupid = '".$groupid."'");
	mysql_query("DELETE FROM homes_stickers WHERE groupid = '".$groupid."'");
	echo "<p>\nEl grupo ha sido eliminado correctamente.\n</p>\n\n<p>\n<a href=\"".$path."\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
}

?>