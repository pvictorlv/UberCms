<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN) {
    exit;
}

require_once "top.php";

?>

    <h1>Lista Staff</h1>

    <p>
        Nesta lista está presente toda a equipe do hotel.</p>

    <br/>

    <table width="100%" border="1">
        <thead>
        <td>Usuario</td>
        <td>Rank</td>
        <td>Contato</td>
        </thead>
        <?php

        $get = dbquery("SELECT id,rank,mail FROM users WHERE rank >= 3 ORDER BY rank DESC");

        while ($user = $get->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $users->formatUsername($user['id']) . '</td>';
            echo '<td>' . $users->getRankName($user['rank']) . '</td>';
            echo '<td><a href="mailto:' . $user['mail'] . '">' . $user['mail'] . '</a></td>';
            echo '</tr>';
        }

        ?>
    </table>

<?php

require_once "bottom.php";

?>