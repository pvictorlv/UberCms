<?php
require_once('../global.php');


function newItem($userId, $groupId, $position_left, $position_top, $position_z, $var, $skin, $content, $type)
{
    db::query('INSERT INTO site_items (userId, groupId, position_left, position_top, position_z, var, skin, content, type) VALUES (?,?,?,?,?,?,?,?,?)',
        $userId, $groupId, $position_left, $position_top, $position_z, $var, $skin, $content, $type);
}

$name = (fixText(($_POST['name'])));
$description = (substr(fixText(($_POST['description'])), 0, 255));

if (empty($name)) {
    $msg = "[Error]";
    require('group_create_form.php');
    exit;
}

db::query('INSERT INTO groups_data (name,`desc`,owner_id,created,badge,forum_type) VALUES (?,?,?,?,?,?)', $name, $description, USER_ID, date('d-M-o'), 'b1003Xs05175s05173s09114', '0');

$check = db::query("SELECT id FROM groups_data WHERE owner_id = '" . USER_ID . "' ORDER BY id DESC LIMIT 1");
$row = $check->fetch(2);
$group_id = $row['id'];
$time = time();

db::query("INSERT INTO groups_members (user_id,group_id,`rank`, date_join) VALUES ('" . USER_ID . "','" . $group_id . "','2', '$time')");
$users->takeCredits(USER_ID, 10);
newItem(0, $group_id, "393", "9", "4", "", "n_skin_speechbubbleskin", "Seja bem-vindo a pagina deste grupo, faça parte dele!", "stickie");
newItem(0, $group_id, "27", "218", "3", "", "n_skin_metalskin", "<br /><br /><br /><br />", "stickie");
newItem(0, $group_id, "26", "12", "2", "", "n_skin_metalskin", "Bem-vindo a mais um grupo habbo<br /><br />entre e faça novas amizades!", "stickie");
newItem(0, $group_id, "420", "260", "6", "", "n_skin_speechbubbleskin", "Aqui você pode ver o nome e a categoria do grupo", "stickie");
newItem(0, $group_id, "384", "338", "5", "MemberWidget", "w_skin_defaultskin", "", "widget");
newItem(0, $group_id, "408", "85", "1", "GroupInfoWidget", "w_skin_notepadskin", "", "widget");
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
