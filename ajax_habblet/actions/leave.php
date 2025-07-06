<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId'])) {
	$requestGroupId = $gtfo->cleanWord($_POST['groupId']);
	
		$check_user_member_sql = db::query("SELECT userid FROM groups_memberships WHERE groupid = ?' AND userid = '".USER_ID."' LIMIT 1;");
		if($check_user_member_sql->rowCount() > 0) {
			$check = $check_user_member_sql->fetch(PDO::FETCH_ASSOC);
			db::query("DELETE FROM groups_memberships WHERE (userid='".$check['userid']."')");
			die('<script type="text/javascript">
					location.href = habboReqPath + "/groups/'.$requestGroupId.'/id";
				</script>');
	}
}
?>