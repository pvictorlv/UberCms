<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if (isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['targetAccountId']) && is_numeric($_POST['targetAccountId'])) {
    $requestGroupId = ($_POST['groupId']);
    $targetAccountId = ($_POST['targetAccountId']);

    $check_user_member_sql = db::query("SELECT count(id) FROM groups_memberships WHERE groupid = ? AND userid = ? AND is_current = '0' LIMIT 1;", $requestGroupId, $targetAccountId);
    if ($check_user_member_sql->fetchColumn() > 0) {
        db::query("UPDATE groups_memberships SET is_current = '0' WHERE userid = ?", $targetAccountId);
        db::query("UPDATE groups_memberships SET is_current = '1' WHERE groupid = ? AND userid = ? LIMIT 1;", $requestGroupId, $targetAccountId);
    }
}
?>