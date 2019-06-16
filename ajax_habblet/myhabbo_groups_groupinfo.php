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

$ownerId = FilterText($_POST['ownerId'], true);
$groupId = FilterText($_POST['groupId'], true);

$verify = db::query("SELECT null FROM groups_memberships WHERE userID = '" . $ownerId . "'  AND groupID = '" . $groupId . "' LIMIT 1");

if($verify > 0)
{
	$checkGroup = db::query("SELECT * FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");
	$existGroup = mysql_num_rows($checkGroup);
	
	if($existGroup > 0)
	{
		$row = mysql_fetch_assoc($checkGroup);
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
	
	<div class="groups-info-icon"><a href="/groups/<?php echo $row['id']; ?>/id"><img src="/habbo-imaging/badge/<?php echo $row['badge']; ?>.gif" /></a></div>
	<h4><a href="/groups/<?php echo $row['id']; ?>/id"><?php echo $row['username']; ?></a></h4>
	    <img id="groupname-<?php echo $row['id']; ?>-report" class="report-button report-gn"
			alt="report"
			src="/web-gallery/images/myhabbo/buttons/report_button.gif"
			style="display: none;" />
	
	<p>
Grupo creado:<br />
<b><?php echo $row['created']; ?></b>
	</p>
	
	<div class="groups-info-description"><?php echo $row['description']; ?></div>
	    <img id="groupdesc-<?php echo $row['id']; ?>-report" class="report-button report-gd"
	        alt="report"
	        src="/web-gallery/images/myhabbo/buttons/report_button.gif"
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