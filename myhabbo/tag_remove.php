<?php
include '../global.php';

if (isset($_POST['accountId']) && isset($_POST['tagId'])) {
    $tagid = filter($_POST['tagId']);
    db::query("DELETE FROM users_tags WHERE id = ? AND user_id = ?", $tagid, USER_ID);
} else if (isset($_POST['groupId']) && isset($_POST['tagId'])) {
    $tagid = filter($_POST['tagId']);

    $groupId = filter($_POST['groupId']);
//    check groups_members
    $check = db::query("SELECT group_id FROM groups_memberships WHERE user_id = ? AND group_id = ? AND rank != '0' LIMIT 1", USER_ID, $groupId);
    if ($check->rowCount() == 0) {
        echo "ERROR";
        exit;
    }
    db::query("DELETE FROM groups_tags WHERE id = ? AND group_id = ?", $tagid, $groupId);
} else {
    echo "ERROR";
}
?>


<script type="text/javascript">

    TagHelper.setTexts({
        tagLimitText: "Limite de etiquetas atingido, remova alguma antes de continuar.",
        invalidTagText: "Etiqueta inválida.",
        buttonText: "OK"
    });
    TagHelper.bindEventsToTagLists();
</script>
