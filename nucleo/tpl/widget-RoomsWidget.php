<?php
if (isset($_GET['qryName'])) {
    global $users;
    $qryId = $users->Name2id(filter($_GET['qryName']));
} else if (isset($_GET['qryId']) && is_numeric($_GET['qryId'])) {
    $qryId = (int)$_GET['qryId'];
}

if (!isset($qryId) && LOGGED_IN) {
    header('Location: ' . WWW . '/home/' . $_SESSION['UBER_USER_N']);
} else if (!isset($qryId) && !LOGGED_IN) {
    header('Location: ' . WWW . '/');
}

?>

<div class="movable widget RoomsWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <div class="widget-corner" id="widget-%id%-handle">

            <div class="widget-headline"><h3><?php if (isset($_SESSION['startSessionEditHome'])) {
                        if ($_SESSION['startSessionEditHome'] == $qryId) {

                            echo '<img src="%www%/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit" />	
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
                        }
                    }
                    ?>


                    <span class="header-left">&nbsp;</span><span class="header-middle">Meus quartos</span><span
                            class="header-right">&nbsp;</span></h3>

            </div>
        </div>

        <div class="widget-body">
            <div class="widget-content">

                <?php

                global $users;
                $name = $users->GetUserVar($qryId, 'username');
                $roomsql = db::query("SELECT id,caption,state FROM rooms_data WHERE owner = ?", $name);
                if ($roomsql->rowCount() >= 1) {

                    ?>

                    <div id="room_wrapper">
                        <table border="0" cellpadding="0" cellspacing="0">

                            <?php

                            $i = 0;
                            while ($room = $roomsql->fetch(2)) {
                                $i++;

                                if ($roomsql->rowCount() == $i) {
                                    $asdf = " ";
                                } else {
                                    $asdf = "\"class=\"dotted-line\"";
                                }

                                if ($room['state'] == "open") {
                                    $icon = "open";
                                    $text = "Entrar";
                                } elseif ($room['state'] == "password") {
                                    $icon = "password";
                                    $text = "Protegida por senha";
                                } elseif ($room['state'] == "locked") {
                                    $icon = "locked";
                                    $text = "Trancada";
                                }

                                ?>

                                <tr>

                                    <td valign="top">
                                        <div class="room_image">
                                            <img src="/web-gallery/images/myhabbo/rooms/room_icon_<?php echo $icon; ?>.gif"
                                                 alt="" align="middle"/>
                                        </div>
                                    </td>

                                    <td <?php echo $asdf; ?>>
                                        <div class="room_info">
                                            <div class="room_name"><?php echo $room['caption']; ?></div>
                                            <img id="room-<?php echo $room['id']; ?>-report"
                                                 class="report-button report-r" alt="report"
                                                 src="%www%/web-gallery/images/myhabbo/buttons/report_button.gif"
                                                 style="display: none;"/>

                                            <div class="clear"></div>
                                            <div><?php echo $room['description']; ?></div>

                                            <a href="/client?forwardId=2&amp;roomId=<?php echo $room['id']; ?>"
                                               target="" id="room-navigation-link_<?php echo $room['id']; ?>"
                                               onclick="HabboClient.roomForward(this, '<?php echo $room['id']; ?>', 'private', true); return false;">
                                                <?php echo $text; ?>
                                            </a>

                                        </div>
                                        <br class="clear"/>

                                    </td>
                                </tr>

                            <?php } ?>

                            <br class="clear"/>
                            </td>
                            </tr>
                        </table>
                    </div>

                <?php } else {
                    echo 'Nenhum quarto encontrado';
                } ?>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>