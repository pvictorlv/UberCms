<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['code']) && isset($_POST['__app_key']) && isset($_POST['onData'])) {

$groupId = $gtfo->cleanWord($_POST['groupId']);
$badge = str_replace("NaN", "", $gtfo->cleanWord($_POST['code']));
$appkey = $gtfo->cleanWord($_POST['__app_key']);

if($core->GetGroupPerm($groupId) >= 2) {

dbquery("UPDATE groups_details SET badge='".$badge."' WHERE (id='".$groupId."') LIMIT 1");
header("Location:".WWW."/groups/".$groupId."/id"); exit;
	}
}
?>