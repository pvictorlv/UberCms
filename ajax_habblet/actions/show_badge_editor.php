<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId'])) {
	$groupId = $gtfo->cleanWord($_POST['groupId']);
	$sql = db::query("SELECT id,badge FROM groups_details WHERE id = ? LIMIT 1;");
	
if($sql->rowCount() == 0) {
	die();
}

if($core->GetGroupPerm($groupId) < 2) {
	die('No tienes los permisos suficientes.');
}

$data = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div id="badge-editor-flash">
El editor de Placas necesita Flash Player. <a href="http://www.adobe.com/go/getflashplayer">Inst�lalo gratis desde aqu�</a>.
</div>
<script type="text/javascript" language="JavaScript">
var swfobj = new SWFObject("<?php echo WWW; ?>/web-gallery/flash/BadgeEditor.swf", "badgeEditor", "280", "366", "8");
swfobj.addParam("base", "<?php echo WWW; ?>/web-gallery/flash/");
swfobj.addParam("bgcolor", "#FFFFFF");
swfobj.addVariable("post_url", "<?php echo WWW; ?>/ajax_habblet/actions/update_group_badge.php?");
swfobj.addVariable("__app_key", "<?php echo $core->GenerateRandom(10, true, true); ?>");
swfobj.addVariable("groupId", "<?php echo $data['id']; ?>");
swfobj.addVariable("badge_data", "<?php echo $data['badge']; ?>");
swfobj.addVariable("localization_url", "<?php echo WWW; ?>/xml/badge_editor.xml");
swfobj.addVariable("xml_url", "<?php echo WWW; ?>/figure/badge_data_xml.xml");
swfobj.addParam("allowScriptAccess", "always");
swfobj.write("badge-editor-flash");
</script>
<?php
}
?>