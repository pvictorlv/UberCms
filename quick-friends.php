<?php
require_once "global.php";

if (!LOGGED_IN) {
    header("Location: " . WWW);
    exit;
}

$result = dbquery("SELECT `user_two_id` FROM `messenger_friendships` WHERE `user_one_id` = '" . USER_ID . "' LIMIT 15;");
$num = $result->num_rows;
if ($num == 0) {
    echo "<ul>Nenhum amigo online!</ul>";
} else {
    $friends = array("online" => array(), "offline" => array());
    while ($row = $result->fetch_array()) {
        if (uberUsers::Is_Online($row[0])) {
            $friends['online'][] = $users->Id2name($row[0]);
        } else {
            $friends['offline'][] = $users->Id2name($row[0]);
        }
    }

    echo '<small><ul><li style="text-align: center;"><b>Nota:</b> <i>Aqui são exibidos apenas 15 amigos!</small></i></center></li></ul>';

    if ($friends['online']) {
        echo "<div class=\"qtab-subtitle even\"><div class=\"qtab-category\">Amigos online</div></div>";
        echo "<ul id=\"online-friends\">";

        $oddeven = "even";

        foreach ($friends['online'] as $friend) {
            if ($oddeven == "even") {
                $oddeven = "odd";
            } else if ($oddeven == "odd") {
                $oddeven = "even";
            }
            echo "<li class='" . $oddeven . "'><a href='/home/" . $friend . "'>" . $friend . "</a></li>";
        }

        echo "</ul>";
    }

    if ($friends['offline']) {
        echo "<div class=\"qtab-subtitle even\"><div class=\"qtab-category\">Amigos desconectados</div></div>";
        echo "<ul id=\"offline-friends\">";

        $oddeven = "even";

        foreach ($friends['offline'] as $friend) {
            if ($oddeven == "even") {
                $oddeven = "odd";
            } else if ($oddeven == "odd") {
                $oddeven = "even";
            }
            echo "<li class='" . $oddeven . "'><a href='/home/" . $friend . "'>" . $friend . "</a></li>";
        }

        echo "</ul>";
    }
}

echo "<p class='manage-friends'><a href='" . WWW . "/change_blockfriends.php'>Administrar amigos</a></p>";
?>