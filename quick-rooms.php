<?php

include "global.php";

if (!LOGGED_IN) {
    header('Location: ' . WWW);
    exit;
}

$result = db::query("SELECT `id`,`caption` FROM `rooms_data` WHERE `owner` = '" . USER_NAME . "'");
if ($result->rowCount() <= 0) {
    echo '<ul><li>Você ainda não tem nenhuma sala!</li></ul>';
} else {
    $oddeven = 'odd';

    echo "<ul id='quickmenu-rooms'>";

    while ($row = $result->fetch(1)) {
        if ($oddeven == "even") {
            $oddeven = 'odd';
        } else if ($oddeven == "odd") {
            $oddeven = 'even';
        }

        echo "<li class='" . $oddeven . "'><a href='" . WWW . '/client?forwardId=2&roomId=' . $row[0] . "' target='uberClientWnd' onclick=\"HabboClient.openOrFocus(this); return false;\">" . $row[1] . "</a></li>";
    }

    echo "</ul>";
}

echo "<p class='create-room'><a href='" . WWW . "/client' target='uberClientWnd' onclick=\"HabboClient.openOrFocus(this); return false;\">Crie uma nova sala</a></p>";
