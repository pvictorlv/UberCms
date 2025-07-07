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

$ownerId = FilterText($_POST['ownerId'], true);
$groupId = FilterText($_POST['groupId'], true);

$verify = query_rows("SELECT null FROM users_groups_memberships WHERE userID = '" . $ownerId . "'  AND groupID = '" . $groupId . "' LIMIT 1");

if($verify > 0)
{
	$checkGroup = query("SELECT * FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");
	$existGroup = $checkGroup->rowCount();
	
	if($existGroup > 0)
	{
		$row = $checkGroup->fetch(PDO::FETCH_ASSOC));
	}
	else
	{
		exit;
	}
}
else
{
	exit;
}
?>
<div class="groups-info-basic">
	<div class="groups-info-close-container"><a href="#" class="groups-info-close"></a></div>
	
	<div class="groups-info-icon"><a href="<?php echo SITE; ?>/groups/<?php echo $row['id']; ?>/id"><img src="<?php echo SITE; ?>/habbo-imaging/badge/<?php echo $row['badge']; ?>.gif" /></a></div>
	<h4><a href="<?php echo SITE; ?>/groups/<?php echo $row['id']; ?>/id"><?php echo $row['username']; ?></a></h4>
	    <img id="groupname-<?php echo $row['id']; ?>-report" class="report-button report-gn"
			alt="report"
			src="<?php echo SITE; ?>/web-gallery/images/myhabbo/buttons/report_button.gif"
			style="display: none;" />
	
	<p>
Grupo creado:<br />
<b><?php echo $row['created']; ?></b>
	</p>
	
	<div class="groups-info-description"><?php echo $row['description']; ?></div>
	    <img id="groupdesc-<?php echo $row['id']; ?>-report" class="report-button report-gd"
	        alt="report"
	        src="<?php echo SITE; ?>/web-gallery/images/myhabbo/buttons/report_button.gif"
            style="display: none;" />
</div>

<div class="groups-info-actions">
<p>
Privilegios: <b>
Miembro
</b>
</p>

<p>
<a href="#" class="groups-info-select-favorite new-button"><b>Convertir en Favorito</b><i></i></a>
</p>
<div class="clear"></div>
</div>