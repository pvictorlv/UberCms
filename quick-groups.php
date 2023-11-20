<?php
require_once "global.php";

$Groups = db::query("SELECT * FROM groups_members WHERE user_id = '" . USER_ID . "' ORDER BY `rank` LIMIT 20");
if ($Groups->rowCount() >= 1) {
    echo '<ul id="quickmenu-groups">';
    $num = 0;
    while ($row = $Groups->fetch(2)) {
        $num++;
        $group_id = $row['group_id'];

        $check = db::query("SELECT name,owner_id FROM groups_data WHERE id = ? LIMIT 1", $group_id);
        $groupdata = $check->fetch(2);
        echo '<li class="';
        if ($num % 2 == 0) {
            echo "odd";
        } else {
            echo "even";
        }
        echo '">';


        if ($row['rank'] > 1 && $groupdata['owner_id'] = USER_ID)
            echo "<div class=\"admin-group\" title=\"Admin\"></div>\n";

        if ($groupdata['owner_id'] = USER_ID && $row['rank'] > 1)
            echo "<div class=\"owned-group\" title=\"Dono\"></div>\n";

        echo "\n<a href=\"/groups/" . $group_id . "/id\">" . nl2br($groupdata['name']) . "</a>\n</li>";
    }
} else {
    echo '<li class="odd">Você ainda não faz parte de nenhum grupo</li>';
}
echo '<p class="create-group"><a href="#" onclick="GroupPurchase.open(); return false;">Crie um Grupo</a></p>';
echo '</ul>';
$tpl->Output();

?>