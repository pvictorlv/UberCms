<?php
require_once('global.php');


function newItem($userId, $groupId, $position_left, $position_top, $position_z, $var, $skin, $content, $type)
{
    dbquery("INSERT INTO site_items (userId, groupId, position_left, position_top, position_z, var, skin, content, type) VALUES ('" . $userId . "', '" . $groupId . "', '" . $position_left . "', '" . $position_top . "', '" . $position_z . "', '" . $var . "', '" . $skin . "', '" . $content . "', '" . $type . "')");
}

$name = filter(fixText(($_POST['name'])));
$description = filter(substr(fixText(($_POST['description'])), 0, 255));

if (empty($name)) {
    $msg = "[Error]";
    require('group_create_form.php');
    exit;
} else {
    dbquery("INSERT INTO groups_details (name,description,ownerid,created,badge,type) VALUES ('" . $name . "','" . $description . "','" . USER_ID . "','" . date("d-M-o") . "','b1003Xs05175s05173s09114','0')") or die(mysql_error());

    $check = dbquery("SELECT id FROM groups_details WHERE ownerid = '" . USER_ID . "' ORDER BY id DESC LIMIT 1");
    $row = $check->fetch_assoc();
    $group_id = $row['id'];

    dbquery("INSERT INTO groups_memberships (userid,groupid,member_rank,is_current) VALUES ('" . USER_ID . "','" . $group_id . "','2','0')");
    $users->takeCredits(USER_ID, 10);
    newItem(0, $group_id, "393", "9", "4", "", "n_skin_speechbubbleskin", "Seja bem-vindo a pagina deste grupo, faça parte dele!", "stickie");
    newItem(0, $group_id, "27", "218", "3", "", "n_skin_metalskin", "<br /><br /><br /><br />", "stickie");
    newItem(0, $group_id, "26", "12", "2", "", "n_skin_metalskin", "Bem-vindo a mais um grupo habbo<br /><br />entre e faça novas amizades!", "stickie");
    newItem(0, $group_id, "420", "260", "6", "", "n_skin_speechbubbleskin", "Aqui você pode ver o nome e a categoria do grupo", "stickie");
    newItem(0, $group_id, "384", "338", "5", "MemberWidget", "w_skin_defaultskin", "", "widget");
    newItem(0, $group_id, "408", "85", "1", "GroupInfoWidget", "w_skin_notepadskin", "", "widget");
}
?>
<div id="group-logo">
    <img src="/images/groups/group_icon.gif" alt="" width="46" height="46"/>
</div>

<p id="purchase-result-success">
    Sucesso! Você criou um grupo com o nome: <?php echo $name; ?>.
</p>

<p>

<div class="new-buttons clearfix">
    <a class="new-button" id="group-purchase-cancel-button" href="#" onclick="GroupPurchase.close(); return false;"><b>Fechar</b><i></i></a>
    <a class="new-button" href="/groups/<?php echo $group_id; ?>/id"><b>Ir ao grupo</b><i></i></a>
</div>

</p>

<script language="JavaScript" type="text/javascript">
    updateHabboCreditAmounts('<?php echo clean($users->getCredits(USER_ID)) - 10 ?>');
</script>
