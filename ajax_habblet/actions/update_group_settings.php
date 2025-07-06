<?php
/*=========================================================+
|| # Azure Files of XDRCMS. All rights reserved.
|| # Copyright  2012 Xdr.
|+=========================================================+
|| # Xdr 2012. The power of Proyects.
|| # Este es un Software de cdigo libre, libre edicin.
|+=========================================================+
*/

function HoloText($str, $advanced=false, $bbcode=false) {
	if($advanced == true){ return stripslashes($str); }
	$str = stripslashes(nl2br(htmlspecialchars($str)));
	if($bbcode == true){$str = bbcode_format($str); }
	return $str;
}

$require_login = true;

require_once('../../global.php');

$groupid = HoloText($_POST['groupId']);
if(!is_numeric($groupid)){ exit; }

$check = Db::query("SELECT member_rank FROM groups_memberships WHERE userid = '".USER_ID."' AND groupid = '".$groupid."' AND member_rank >= 1 AND is_pending = '0' LIMIT 1")
$is_member = ->rowCount($check);

if($is_member > 0){
	$my_membership = $check->fetch(PDO::FETCH_ASSOC);
	$member_rank = $my_membership['member_rank'];
} else {
	echo "Lo sentimos, pero no puedes editar este Grupo.\n\n<p>\n<a href=\"/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
	exit;
}

$check = Db::query("SELECT * FROM groups_details WHERE id = ? LIMIT 1")
$valid = ->rowCount($check);

if($valid > 0){
	$groupdata = $check->fetch(PDO::FETCH_ASSOC);
	$ownerid = $groupdata['ownerid'];
} else {
	echo "Lo sentimos, pero no puedes editar este Grupo.\n\n<p>\n<a href=\"/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
	exit;
}

if($ownerid !== '".USER_ID."'){ exit; }

$name = HoloText(trim(SwitchWordFilter(textInJS($_POST['name']))));
$description = HoloText(trim(SwitchWordFilter(textInJS($_POST['description']))));
$type = FilterText($_POST['type']);
$forum_type = FilterText($_POST['forumType']);
$topics_type = FilterText($_POST['newTopicPermission']);
$roomId = FilterText($_POST['roomId']);

if($groupdata['type'] == "3" && $_POST['type'] !== "3"){ exit; }
if($type < 0 || $type > 3){ echo "El tipo de Grupo no es vlido."; exit; }
if($forum_type < 0 || $forum_type > 1){ echo "El tipo del Foro no es vlido."; exit; }
if($topics_type < 0 || $topics_type > 2){ echo "El tipo del Foro no es vlido."; exit; }

if(strlen($name) > 25){
	echo "El nombre del Grupo es muy largo!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
} elseif(strlen($description) > 200){
	echo "La descripcin del Grupo es muy larga!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
} elseif(strlen($name) < 1){
	echo "Por favor, escribe un nombre para el Grupo.\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";	
} else {
	Db::query("UPDATE groups_details SET name = '".$name."', description = '".$description."', roomid = '".$roomId."', type = '".$type."', pane = '".$forum_type."', topics = '".$topics_type."' WHERE id = ?' AND ownerid = '".$my_id."' LIMIT 1")
	echo "Se ha editado el Grupo con xito!\n\n<p>\n<a href=\"".PATH."/groups/".$groupid."/id\" class=\"new-button\"><b>OK</b><i></i></a>\n</p>\n\n<div class=\"clear\"></div>";
}
 
?>