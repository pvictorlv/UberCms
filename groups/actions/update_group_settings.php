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

$groupid = HoloText($_POST['groupId']);
if(!is_numeric($groupid)){ exit; }

$check = Db::query("SELECT member_rank FROM groups_memberships WHERE userid = '".$my_id."' AND groupid = '".$groupid."' AND member_rank > 1 AND is_pending = '0' LIMIT 1")
$is_member = $check->rowCount();

if($is_member > 0){
	$my_membership = $check->fetch(PDO::FETCH_ASSOC);
	$member_rank = $my_membership['member_rank'];
} else {
	echo "Lo sentimos, pero no puedes editar este Grupo.\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
	exit;
}

$check = Db::query("SELECT * FROM groups_details WHERE id = '".$groupid."' LIMIT 1")
$valid = $check->rowCount();

if($valid > 0){
	$groupdata = $check->fetch(PDO::FETCH_ASSOC);
	$ownerid = $groupdata['ownerid'];
} else {
	echo "Lo sentimos, pero no puedes editar este Grupo.\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
	exit;
}

if($ownerid !== $my_id){ exit; }

$name = HoloText(trim(SwitchWordFilter(textInJS($_POST['name']))));
$description = HoloText(trim(SwitchWordFilter(textInJS($_POST['description']))));
$type = FilterText($_POST['type']);
$forum_type = FilterText($_POST['forumType']);
$topics_type = FilterText($_POST['newTopicPermission']);
$roomId = FilterText($_POST['roomId']);

if($groupdata['type'] == "3" && $_POST['type'] !== "3"){ exit; }
if($type < 0 || $type > 3){ echo "El tipo de Grupo no es válido."; exit; }
if($forum_type < 0 || $forum_type > 1){ echo "El tipo del Foro no es válido."; exit; }
if($topics_type < 0 || $topics_type > 2){ echo "El tipo del Foro no es válido."; exit; }

if(strlen($name) > 25){
	echo "¡El nombre del Grupo es muy largo!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
} elseif(strlen($description) > 200){
	echo "¡La descripción del Grupo es muy larga!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
} elseif(strlen($name) < 1){
	echo "Por favor, escribe un nombre para el Grupo.\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";	
} else {
	Db::query("UPDATE groups_details SET name = '".$name."', description = '".$description."', roomid = '".$roomId."', type = '".$type."', pane = '".$forum_type."', topics = '".$topics_type."' WHERE id = '".$groupid."' AND ownerid = '".$my_id."' LIMIT 1")
	echo "¡Se ha editado el Grupo con éxito!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
}
 
?>