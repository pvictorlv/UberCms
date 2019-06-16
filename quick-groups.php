<?php
require_once "global.php";

$Groups = db::query("SELECT * FROM groups_memberships WHERE userid = '" . USER_ID . "' AND is_pending = '0' ORDER BY member_rank LIMIT 20");
if ($Groups->rowCount() >= 1) {
    echo '<ul id="quickmenu-groups">';
    $num = 0;
    while ($row = $Groups->fetch(2)) {
        $num++;
        $group_id = $row['groupid'];

        $check = db::query("SELECT name,ownerid FROM groups_details WHERE id = ? LIMIT 1", $group_id);
        $groupdata = $check->fetch(2);
        echo '<li class="';
        if ($num % 2 == 0) {
            echo "odd";
        } else {
            echo "even";
        }
        echo '">';

        if ($row['is_current'] == 1)
            echo "<div class=\"favourite-group\" title=\"Favorito\"></div>\n";

        if ($row['member_rank'] > 1 && $groupdata['ownerid'] = USER_ID)
            echo "<div class=\"admin-group\" title=\"Admin\"></div>\n";

        if ($groupdata['ownerid'] = USER_ID && $row['member_rank'] > 1)
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