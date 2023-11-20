<?php
####################################################
## InfoCMS - Emulaci�n del sitio de Habbo Hotel.  ##
####################################################
## Este Software basado en PHP, Curl y HTML es de ##
## libre edici�n y c�digo libre, cualquier		  ##
## modificaci�n es permitida siempre y cuando	  ##
## respete para lo que fue dise�ado.			  ##
####################################################
## Copyright � 2010. Kolesias123 & InfoSmart.	  ##
## http://www.infosmart.com.mx/					  ##
####################################################
## Copyright � 2010. Sulake Corporation Oy.		  ##
## http://www.sulake.com/ ~ http://www.habbo.es/  ##
####################################################

require_once('../global.php');

if (!LOGGED_IN) {
    header("Location: /");
    exit;
}

global $groups;

$groupId = FilterText($_POST['groupId']);
$tagName = fixText(FilterText($_POST['tagName']), true);
$filter = preg_replace("/[^a-z \d]/i", "", $tagName);

$existGroup = db::query("SELECT * FROM groups_members WHERE group_id = ? and user_id = " . USER_ID, $groupId);

if ($existGroup->rowCount() > 0 && !empty($tagName) && strlen($tagName) <= 20) {
    $getTags = db::query("SELECT * FROM groups_tags WHERE group_id = ?", $groupId);

    if (!$groups->alreadyGroupTag($groupId, $tagName) && $getTags < 20) {
        if ($tagName == $filter) {
            $tagName = strtolower($tagName);
            $groups->addGroupTag($groupId, $tagName);
            echo "valid";
        } else {
            echo "invalidtag";
        }
    }
} else {
    echo 'not member';
}

exit;
?>