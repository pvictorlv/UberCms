<?php
global $users, $qryId;

$sql = db::query("SELECT * FROM messenger_friendships WHERE user_two_id = ? OR user_one_id = ?", $qryId, $qryId);
$count = $sql->rowCount();

$get_em = db::query("SELECT * FROM homes_items WHERE owner_id = ? AND data = 'FriendsWidget' LIMIT 1", $qryId);
$row = $get_em->fetch(2);

?>
<div class="movable widget FriendsWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">

        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3><?php
                    if (isset($_SESSION['startSessionEditHome'])) {
                        if ($_SESSION['startSessionEditHome'] == $qryId) {
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
                            window.widget<?php echo $row['id']; ?> = new FriendsWidget('<?php echo $qryId ?>', '<?php echo $row['id']; ?>');
                        });
                    </script>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>