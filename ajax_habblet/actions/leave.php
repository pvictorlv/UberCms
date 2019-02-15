<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId'])) {
	$requestGroupId = $gtfo->cleanWord($_POST['groupId']);
	
		$check_user_member_sql = dbquery("SELECT userid FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".USER_ID."' LIMIT 1;");
		if(mysql_num_rows($check_user_member_sql) > 0) {
			$check = mysql_fetch_array($check_user_member_sql);
			dbquery("DELETE FROM groups_memberships WHERE (userid='".$check['userid']."')");
			die('<script type="text/javascript">
					location.href = habboReqPath + "/groups/'.$requestGroupId.'/id";
				</script>');
	}
}
?>