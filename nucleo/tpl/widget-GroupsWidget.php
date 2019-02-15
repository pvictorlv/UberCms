<?php

if (isset($_GET['qryName'])) {
    global $users;
    $qryId = $users->name2id(filter($_GET['qryName']));
} else if (isset($_GET['qryId']) && is_numeric($_GET['qryId'])) {
    $qryId = intval($_GET['qryId']);
}

if (!isset($qryId) && LOGGED_IN) {
    header('Location: ' . WWW . '/home/' . $_SESSION['UBER_USER_N']);
} else if (!isset($qryId) && !LOGGED_IN) {
    header('Location: ' . WWW . '/');
}

$group = dbquery("SELECT NULL FROM groups_memberships WHERE userid = '" . USER_ID . "' LIMIT 1");
$groups = $group->num_rows;

$get_em = dbquery("SELECT * FROM homes_items WHERE owner_id = '" . USER_ID . "' AND type < 4 LIMIT 200");
$row = $get_em->fetch_assoc();

?>

<div class="movable widget GroupsWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">Meus grupos (<span
                                id="groups-list-size"><?php echo $groups; ?></span>)</span><span class="header-right"><?php
                        if (isset($_SESSION['startSessionEditHome'])) {
                            if ($_SESSION['startSessionEditHome'] == USER_ID) {
                                echo '<img src="' . WWW . '/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit">
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
                            } //$_SESSION['startSessionEditHome'] == USER_ID
                        } //isset($_SESSION['startSessionEditHome'])
                        ?></span></h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">

                <div class="groups-list-container">
                    <ul class="groups-list">

                        <?php

                        $get_groups = dbquery("SELECT * FROM groups_memberships WHERE userid = '" . USER_ID . "'") or die(mysql_error());

                        if ($get_groups->num_rows > 0) {
                            while ($members_row = $get_groups->fetch_assoc()) {

                                $get_groupdata = dbquery("SELECT * FROM groups_details WHERE id = '" . $members_row['groupid'] . "' LIMIT 1") or die(mysql_error());
                                $grouprow = $get_groupdata->fetch_assoc();

                                ?>

                                <li title="<?php echo $grouprow['name']; ?>"
                                    id="groups-list-<?php echo $row['id']; ?>-<?php echo $grouprow['id']; ?>">
                                    <div class="groups-list-icon"><a href="/groups/<?php echo $grouprow['id']; ?>"><img
                                                    src='/habbo-imaging/badge.php?badge=<?php echo $grouprow['badge']; ?>.gif'></a>
                                    </div>
                                    <div class="groups-list-open"></div>
                                    <h4>
                                        <a href="/groups/<?php echo $grouprow['id']; ?>"><?php echo $grouprow['name']; ?></a>
                                    </h4>
                                    <p>
                                        Fundado:<br/>
                                    <?php if ($members_row['is_current'] == 1) { ?>
                                        <div class="favourite-group" title="Favorito"></div><?php } ?>
                                    <?php if ($members_row['member_rank'] > 1 && $grouprow['ownerid'] !== USER_ID) { ?>
                                        <div class="admin-group" title="Admin"></div><?php } ?>
                                    <?php if ($grouprow['ownerid'] == USER_ID && $members_row['member_rank'] > 1) { ?>
                                        <div class="owned-group" title="Propietario"></div><?php } ?>
                                    <b><?php echo date('d-M-Y', $grouprow['created']); ?></b>
                                    </p>
                                    <div class=\"clear\"></div>
                                </li>

                            <?php }
                        } else {
                            echo "Não tem grupos";
                        } ?>

                    </ul>
                </div>

                <div class="groups-list-loading">
                    <div><a href="#" class="groups-loading-close"></a></div>
                    <div class="clear"></div>
                    <p style="text-align:center"><img src="./web-gallery/images/progress_bubbles.gif" alt="" width="29"
                                                      height="6"></p></div>
                <div class="groups-list-info"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.observe("dom:loaded", function () {
        new GroupsWidget('<?php echo USER_ID; ?>', '<?php echo $row['id']; ?>');
    });
</script>