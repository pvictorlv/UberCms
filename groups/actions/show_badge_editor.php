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

$groupId = FilterText($_POST['groupId']);

$check = Db::query("SELECT * FROM groups_details WHERE id = '$groupId' LIMIT 1")
$exist = $check->rowCount();

if($exist > 0)
	$row = $check->fetch(PDO::FETCH_ASSOC);
else
	exit;

$_SESSION['groups']['app_key_badge-editor'] = strtoupper($System->GenerateRandom(32, true, true, false)) . ".resin-fe-" . $System->GenerateRandom(1, false, true, false);

?>
<div id="badge-editor-flash">
El editor de Placas necesita Flash Player. <a href="http://www.adobe.com/go/getflashplayer">Instálalo gratis desde aquí</a>.
</div>
<script type="text/javascript" language="JavaScript">
var swfobj = new SWFObject("<?php echo webgallery; ?>/flash/BadgeEditor.swf", "badgeEditor", "280", "366", "8");
swfobj.addParam("base", "<?php echo webgallery; ?>/flash/");
swfobj.addParam("bgcolor", "#FFFFFF");
swfobj.addVariable("post_url", "<?php echo PATH; ?>/groups/actions/update_group_badge?");
swfobj.addVariable("__app_key", "<?php echo $_SESSION['groups']['app_key_badge-editor']; ?>");
swfobj.addVariable("groupId", "<?php echo $groupId; ?>");
swfobj.addVariable("badge_data", "<?php echo $row['badge']; ?>");
swfobj.addVariable("localization_url", "<?php echo PATH; ?>/xml/badge_editor.xml");
swfobj.addVariable("xml_url", "<?php echo PATH; ?>/xml/badge_data.xml");
swfobj.addParam("allowScriptAccess", "always");
swfobj.write("badge-editor-flash");
</script>


