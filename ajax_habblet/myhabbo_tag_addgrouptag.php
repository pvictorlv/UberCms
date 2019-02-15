<?php
####################################################
## InfoCMS - Emulación del sitio de Habbo Hotel.  ##
####################################################
## Este Software basado en PHP, Curl y HTML es de ##
## libre edición y código libre, cualquier		  ##
## modificación es permitida siempre y cuando	  ##
## respete para lo que fue diseñado.			  ##
####################################################
## Copyright © 2010. Kolesias123 & InfoSmart.	  ##
## http://www.infosmart.com.mx/					  ##
####################################################
## Copyright © 2010. Sulake Corporation Oy.		  ##
## http://www.sulake.com/ ~ http://www.habbo.es/  ##
####################################################

require_once('../../Kernel/Init.php');

if(!LOG_IN)
{
	header("Location: " . SITE);
	exit;
}

$groupId = FilterText($_POST['groupId']);
$tagName = fixText(FilterText($_POST['tagName']), true);
$filter = preg_replace("/[^a-z \d]/i", "", $tagName);

$existGroup = query_rows("SELECT null FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");

if($existGroup > 0 && !empty($tagName) && strlen($tagName) <= 20)
{
	$getTags = query_rows("SELECT * FROM users_groups_tags WHERE groupID = '" . $groupId . "'");
	
	if(!$Users->alreadyGroupTag($groupId, $tagName) && $getTags < 20)
	{
		if($tagName == $filter)
		{
			$tagName = strtolower($tagName);
			$Users->addGroupTag($groupId, $tagName);
			echo "valid";
		}
		else
		{
			echo "invalidtag";
		}
	}
}

exit;
?>