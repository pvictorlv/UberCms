<?php

function getGroupData($id)
{
    return db::query("SELECT * FROM groups_data where id = ?", $id)->fetch(2);

}
global $users;

if (!defined("NOWHOS")) {
    define("NOWHOS", TRUE);
}
if (!defined("Xukys")) {
    define("Xukys", TRUE);
}
require_once('../global.php');

if (!LOGGED_IN) {
    header('Location: ' . WWW . '/');
}


$widgetId = ($_POST['widgetId']);

if (isset($_POST['privileged'])) {
    $privileged = ($_POST['privileged']);
}
if (isset($_POST['zindex'])) {
    $zindex = ($_POST['zindex']);
}
$my_id = USER_ID;
$id = USER_ID;

switch ($widgetId) {
    case "5":
        $widget = "GuestbookWidget";
        break;
    case "3":
        $widget = "FriendsWidget";
        break;
    case "21":
        $widget = "BadgesWidget";
        break;
    case "15":
        $widget = "RatingWidget";
        break;
    case "7":
        $widget = "GroupsWidget";
        break;
    case "2":
        $widget = "RoomsWidget";
        break;
    case "17":
        $widget = "TraxPlayerWidget";
        break;
}

if (!$users->haveWidget($id, $widget)) {
    DB::query("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id, link)
            VALUES (NULL, '" . USER_ID . "', 'widget', '15', '25', '12', ?, 'w_skin_goldenskin', '" . USER_ID . "', '0');", $widget);
} else {
    exit;
}

$getWidget = db::query("SELECT * FROM homes_items WHERE owner_id = '" . $my_id . "' AND data = ? AND type = 'widget' LIMIT 1", $widget);
$row = $getWidget->fetch(2);
header("X-JSON: {\"id\":\"" . $row['id'] . "\"}");
?>

<?php if ($widget == "GuestbookWidget") { ?>

    <div class="movable widget FriendsWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
                <div class="widget-headline">
                    <h3>
                        <img src="http://xukys-hotel.com/web-gallery/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span class="header-middle">Mis Amigos (<span
                                    id="avatar-list-size">0</span>)</span><span class="header-right">&nbsp;</span></h3>
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

                        <div class="avatar-widget-list-container">
                            No tienes amigos :(

                            <div id="avatar-list-info" class="avatar-list-info">
                                <div class="avatar-list-info-close-container"><a href="#"
                                                                                 class="avatar-list-info-close"></a>
                                </div>
                                <div class="avatar-list-info-container"></div>
                            </div>

                        </div>

                        <div id="avatar-list-paging">
                            0 - 0
                            <input type="hidden" id="pageNumber" value="0"/>
                            <input type="hidden" id="totalPages" value="0"/>
                        </div>

                        <script type="text/javascript">
                        </script>

                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php } else if ($widget == "BadgesWidget") { ?>

    <div class="movable widget BadgesWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
                <div class="widget-headline">
                    <h3>
                        <img src="<?php echo WWW ?>/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span
                                class="header-middle">Emblemas</span><span
                                class="header-right">&nbsp;</span>
                    </h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">
                    <div id="badgelist-content">
                        <ul class="clearfix">
                            <?php
                            $getMyBadges = DB::query("SELECT badge_id FROM users_badges WHERE user_id = '" . $my_id . "' LIMIT 6");
                            if ($getMyBadges->rowCount() > 0) {
                                while ($row = $getMyBadges->fetch(2)) {
                                    ?>
                                    <li style="background-image: url(<?php echo '/c_images/album1584'; ?>/<?php echo $row['badge_id']; ?>.gif)"></li>
                                <?php }
                            } else { ?>
                                No tienes placas
                            <?php } ?>
                        </ul>


                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($widget == "RoomsWidget") { ?>
    <div class="movable widget RoomsWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">

                <div class="widget-headline">
                    <h3>
                        <?php if ($inEdit) { ?>
                            <img src="/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18"
                                 class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                            <script language="JavaScript" type="text/javascript">
                                Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                    openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                                }, false);
                            </script>
                        <?php } else { ?><span class="header-left">&nbsp;</span><span
                                class="header-middle">MIS SALAS</span><span class="header-right">&nbsp;</span><?php } ?>
                    </h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">
                    No tienes Salas
                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>
<?php } else if ($widget == "RatingWidget") { ?>
    <div class="movable widget RatingWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['x']; ?>px; top: <?php echo $row['y']; ?>px; z-index: <?php echo $row['x']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
                <div class="widget-headline">
                    <h3>
                        <img src="http://xukys-hotel.com/web-gallery/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span class="header-middle">Mis votos</span><span
                                class="header-right">&nbsp;</span></h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">
                    <div id="rating-main">
                        <script type="text/javascript">
                            var ratingWidget;

                            ratingWidget = new RatingWidget('<?php echo $row['id']; ?>', '<?php echo USER_ID; ?>', <?php echo time(); ?>);

                        </script>
                        <div class="rating-average">
                            <b>Media de votos: 0</b><br/>
                            <div id="rating-stars" class="rating-stars">
                                <ul id="rating-unit_ul1" class="rating-unit-rating">
                                    <li class="rating-current-rating" style="width:0px;"/>

                                </ul>
                            </div>
                            0 votos en total

                            <br/>
                            (0 Habbos han votado 0 o m�s)
                        </div>

                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($widget == "GroupsWidget") {
    $getMyGroups = db::query("SELECT * FROM groups_members WHERE user_id = ?", USER_ID);
    $myGroups = $getMyGroups->rowCount();
    ?>
    <div class="movable widget <?php echo $row['var']; ?>" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['position_left']; ?>px; top: <?php echo $row['position_top']; ?>px; z-index: <?php echo $row['position_z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
                <div class="widget-headline">
                    <h3>
                        <img src="http://xukys-hotel.com/web-gallery/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span class="header-middle">Mis Grupos (<span
                                    id="groups-list-size">0</span>)</span><span class="header-right">&nbsp;</span></h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">

                    <?php if ($myGroups > 0) { ?>
                        <div class="groups-list-container">
                            <ul class="groups-list">
                                <?php while ($row = $getMyGroups->fetch(2)) {
                                    $data = getGroupData($row['group_id']);
                                    ?>
                                    <li title="<?php echo $data['name']; ?>"
                                        id="groups-list-<?php echo USER_ID; ?>-<?php echo $row['group_id']; ?>">
                                        <div class="groups-list-icon"><a
                                                    href="/groups/<?php echo $row['groupID']; ?>/id"><img
                                                        src="/habbo-imaging/badge/<?php echo $data['badge']; ?>.gif"/></a>
                                        </div>
                                        <div class="groups-list-open"></div>
                                        <h4>
                                            <a href="/groups/<?php echo $row['groupID']; ?>/id"><?php echo $data['name']; ?></a>

                                        </h4>
                                        <p>
                                            Grupo criado:<br/>
                                            <b><?php echo $data['created'] ?></b>
                                        </p>
                                        <div class="clear"></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <div class="groups-list-none">
                            Não está em nenhum grupo
                        </div>
                    <?php } ?>

                    <div class="groups-list-loading">
                        <div><a href="#" class="groups-loading-close"></a></div>
                        <div class="clear"></div>
                        <p style="text-align:center"><img
                                    src="/web-gallery/images/progress_bubbles.gif" alt=""
                                    width="29"
                                    height="6"/></p></div>
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
<?php } else if ($widget == "RoomsWidget") { ?>
    <div class="movable widget RoomsWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['position_left']; ?>px; top: <?php echo $row['position_top']; ?>px; z-index: <?php echo $row['position_z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">

                <div class="widget-headline">
                    <h3>
                        <img src="/web-gallery/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span class="header-middle">MIS SALAS</span><span
                                class="header-right">&nbsp;</span></h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">
                    No tienes Salas
                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>
<?php } else if ($widget == "TraxPlayerWidget") { ?>
    <div class="movable widget TraxPlayerWidget" id="widget-<?php echo $row['id']; ?>"
         style=" left: <?php echo $row['position_left']; ?>px; top: <?php echo $row['position_top']; ?>px; z-index: <?php echo $row['position_z']; ?>;">
        <div class="<?php echo $row['skin']; ?>">
            <div class="widget-corner" id="widget-<?php echo $row['id']; ?>-handle">
                <div class="widget-headline">
                    <h3>
                        <img src="/web-gallery/images/myhabbo/icon_edit.gif" width="19"
                             height="18" class="edit-button" id="widget-<?php echo $row['id']; ?>-edit"/>
                        <script language="JavaScript" type="text/javascript">
                            Event.observe("widget-<?php echo $row['id']; ?>-edit", "click", function (e) {
                                openEditMenu(e, <?php echo $row['id']; ?>, "widget", "widget-<?php echo $row['id']; ?>-edit");
                            }, false);
                        </script>
                        <span class="header-left">&nbsp;</span><span class="header-middle">REPRODUCTOR</span><span
                                class="header-right">&nbsp;</span></h3>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-content">


                    Nenhuma música selecionada


                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>