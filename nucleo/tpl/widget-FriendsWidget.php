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

$sql = db::query("SELECT * FROM messenger_friendships WHERE user_two_id = '" . $user_id . "'");
$count = $sql->rowCount();

$get_em = db::query("SELECT * FROM homes_items WHERE owner_id = '" . USER_ID . "' AND type < 4 LIMIT 200");
$row = $get_em->fetch(2);

?>
<div class="movable widget FriendsWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">

        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3><?php
                    if (isset($_SESSION['startSessionEditHome'])) {
                        if ($_SESSION['startSessionEditHome'] == $user_id) {
                            echo '<img src="' . WWW . '/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit">
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
                        } //$_SESSION['startSessionEditHome'] == $user_id
                    } //isset($_SESSION['startSessionEditHome'])
                    ?><span class="header-left">&nbsp;</span><span
                            class="header-middle">Meus amigos (<?php echo $count; ?>)</span><span class="header-right">&nbsp;</span>
                </h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">

                <div id="avatar-list-search">
                    <input type="text" style="float:left;" id="avatarlist-search-string"/>
                    <a class="new-button" style="float:left;" id="avatarlist-search-button"><b>Buscar</b><i></i></a>
                </div>
                <br clear="all"/>

                <div id="avatarlist-content">

                    <?php
                    $bypass = true;
                    $widgetid = $row['id'];
                    include('./myhabbo/avatarlist_friendsearchpaging.php');
                    ?>

                    <script type="text/javascript">
                        document.observe("dom:loaded", function () {
                            window.widget<?php echo $row['id']; ?> = new FriendsWidget('<?php echo $user_id ?>', '<?php echo $row['id']; ?>');
                        });
                    </script>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>