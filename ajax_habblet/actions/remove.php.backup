<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['anAccountId']) && is_numeric($_POST['anAccountId'])) {

	$groupId = $gtfo->cleanWord($_POST['groupId']);
	$targetIds = $gtfo->cleanWord($_POST['anAccountId']);
	
	if($core->GetGroupPerm($groupId) >= 2) {
		$check = mysql_num_rows(db::query("SELECT null FROM groups_memberships WHERE groupid = '".$groupId."' AND userid = '".$targetIds."' LIMIT 1"));
		
		if($check > 0) {
			if(db::query("DELETE from groups_memberships WHERE groupid = '".$groupId."' AND userid = '".$targetIds."' LIMIT 1")) {
					die('<script type="text/javascript">
					location.href = habboReqPath + "/groups/'.$groupId.'/id";
					</script>');
 			}
		}
	}
}
?>