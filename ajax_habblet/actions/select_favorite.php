<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['targetAccountId']) && is_numeric($_POST['targetAccountId'])) {
	$requestGroupId = $gtfo->cleanWord($_POST['groupId']);
	$targetAccountId = $gtfo->cleanWord($_POST['targetAccountId']);
	
		$check_user_member_sql = dbquery("SELECT id FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".$targetAccountId."' AND is_current = '0' LIMIT 1;");
		if(mysql_num_rows($check_user_member_sql) > 0) {
				dbquery("UPDATE groups_memberships SET is_current = '0' WHERE userid = '".$targetAccountId."';");
				dbquery("UPDATE groups_memberships SET is_current = '1' WHERE groupid = '".$requestGroupId."' AND userid = '".$targetAccountId."' LIMIT 1;");
				die('OK');
		}
		else {
		die('ERROR');
	}
}
?>