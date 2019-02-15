<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) {
    exit;
}

function formatType($t)
{
    switch (intval($t)) {
        case 101:

            return 'Sex';

        case 102:

            return 'Pers.info';

        case 103:

            return 'Scam';

        case 104:

            return 'Abusive';

        case 105:

            return 'Blocking';

        case 106:

            return 'Other';

        default:

            return $t;
    }
}

function formatSent($stamp)
{
    $stamp = time() - $stamp;

    $x = '';

    if ($stamp >= 604800) {
        $x = ceil($stamp / 604800) . 'wks';
    } else if ($stamp > 86400) {
        $x = ceil($stamp / 86400) . 'day';
    } else if ($stamp >= 3600) {
        $x = ceil($stamp / 3600) . 'hr';
    } else if ($stamp >= 120) {
        $x = ceil($stamp / 60) . 'min';
    } else {
        $x = $stamp . ' s';
    }

    $x .= ' ago';
    return $x;
}

require_once "top.php";

?>

    <h1>Llamadas de Ayuda</h1>

    <p>
        Esta es una visi�n general del equipo de personal uberHotel con sus datos de contacto tal como se define en la
        configuraci�n de su cuenta.
    </p>

    <br/>

    <p>
        <b>Esto sirve sobre todo como un archivo / visi�n general de las convocatorias de ayuda. Para moderar estas
            entradas por favor, utilice la herramienta de moderaci�n dentro del juego. (Todas las cuestiones abiertas
            ser�n enviados a usted al inicio de sesi�n)</b>
    </p>

    <br/>

    <p>
        <small>* Pide que se podan ayudar de vez en cuando, pero generalmente se mantiene por un per�odo m�s largo de
            tiempo.
        </small>
    </p>

    <br/>

    <table width="100%" border="1">
        <thead>
        <td>ID</td>
        <td>Tipo</td>
        <td>Estado</td>
        <td>Enviado</td>
        <td>Reportar</td>
        <td>Moderador</td>
        <td>Mensaje</td>
        <td>Sala</td>
        <td>Enviar</td>
        <td>Chatlog</td>
        </thead>
        <?php

        $get = dbquery("SELECT * FROM moderation_tickets ORDER BY id DESC");

        while ($user = $get->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . clean($user['id']) . '</td>';
            echo '<td>' . formatType($user['type']) . '</td>';
            echo '<td>' . clean($user['status']) . '</td>';
            echo '<td>' . $users->formatUsername($user['sender_id']) . '</td>';
            echo '<td>';

            if ($user['reported_id'] >= 1) {
                echo $users->formatUsername($user['reported_id']);
            } else {
                echo '-';
            }

            echo '</td>';
            echo '<td>';

            if ($user['moderator_id'] >= 1) {
                echo $users->formatUsername($user['moderator_id']);
            } else {
                echo '-';
            }

            echo '</td>';
            echo '<td>' . clean($user['message']) . '</td>';
            echo '<td>' . clean($user['room_name']) . '</td>';
            echo '<td>' . formatSent($user['timestamp']) . '</td>';
            echo '<td><a href="index.php?_cmd=chatlogs&timeSearch=' . $user['timestamp'] . '">View</a></td>';
            echo '</tr>';
        }

        ?>
    </table>

<?php

require_once "bottom.php";

?>