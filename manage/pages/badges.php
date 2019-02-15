<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin')) {
    exit;
}

$data = null;
$u = 0;

if (isset($_GET['u']) && is_numeric($_GET['u'])) {
    $u = intval(filter($_GET['u']));
    $getData = dbquery("SELECT id,username FROM users WHERE id = '" . $u . "' LIMIT 1");

    if ($getData->num_rows > 0) {
        $data = $getData->fetch_assoc();
    }
} else if (isset($_POST['usrsearch'])) {
    $usrSearch = filter($_POST['usrsearch']);
    $getData = dbquery("SELECT id,username FROM users WHERE username = '" . $usrSearch . "' LIMIT 1");

    if ($getData->num_rows > 0) {
        $data = $getData->fetch_assoc();

        header("Location: index.php?_cmd=badges&u=" . $data['id']);
        exit;
    } else {
        fMessage('error', 'Usuario no encontrado');
    }
}

require_once "top.php";

echo '<h1>Administracion de placas</h1>';

if ($data == null) {
    echo '<p><i>No existe un conjunto de usuario o de usuario no valido suministrado.</i> Para editar un usuario/s ,insignias, la b�squeda de una continuaci�n ..</p>';
    echo '<Br />';
    echo '<p><form method="post">';
    echo 'ID de placa: <input id="uidval" type="text" size="5" name="uid">&nbsp; <input type="button" value="Aceptar" onclick="window.location = \'index.php?_cmd=badges&u=\' + document.getElementById(\'uidval\').value;"><br />';
    echo 'Usuario: <input type="text" name="usrsearch" value="">&nbsp; <input type="submit" value="Aceptar">';
    echo '</form></p>';
} else {
    if (isset($_GET['take'])) {
        dbquery("DELETE FROM user_badges WHERE user_id = '" . $data['id'] . "' AND badge_id = '" . filter($_GET['take']) . "'");

        global $db;
        if ($db->GetAffected() >= 1) {
            echo '<b>Cojer placa ' . $_GET['take'] . ' from ' . $data['username'] . '.</b>';
        }
    }

    if (isset($_POST['newbadge'])) {
        dbquery("INSERT INTO user_badges (user_id,badge_id,badge_slot) VALUES ('" . $data['id'] . "','" . filter($_POST['newbadge']) . "','0')");
        echo '<b>Se ha dado la placa</b>';
    }

    echo '<h2>Editar Placas: ' . $data['username'] . ' (<a href="index.php?_cmd=badges">Volver a la bUsqueda del usuario</a>)</h2>';
    $getBadges = dbquery("SELECT badge_id,badge_slot FROM user_badges WHERE user_id = '" . $data['id'] . "'");

    echo '<Br /><table border="1">
	<thead>
	<tr>
		<td>Imagen</td>
		<td>Codigo de placa</td>
		<td>Estado</td>
		<td>Definicion</td>
		<td>Controles</td>
	</tr>
	</thead>';

    while ($b = $getBadges->fetch_assoc()) {
        echo '<tr>';
        echo '<td><img src="http://hretro.top/c_images/album1584/' . $b['badge_id'] . '.gif"></td>';
        echo '<td><center>' . $b['badge_id'] . '</center></td>';
        echo '<td><center>';

        if ($b['badge_slot'] == 0) {
            echo 'No equipada';
        } else {
            echo 'Equipada ' . $b['badge_slot'];
        }

        echo '</center></td>';
        echo '<td><a href="index.php?_cmd=badgedefs">';

        $tryGet1 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_name_" . $b['badge_id'] . "'");
        $tryGet2 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_desc_" . $b['badge_id'] . "'");


        echo "<b>{$b['badge_id']}</b>";

        echo '</a></td>';
        echo '<td><center><input type="button" onclick="window.location = \'index.php?_cmd=badges&u=' . $u . '&take=' . $b['badge_id'] . '\';" value="Take"></center></td>';
        echo '</tr>';
    }

    echo '<tr><form method="post">
	<td><center>?</center></td>
	<td><input type="text" name="newbadge" value="" style="padding: 5px; font-size: 130%; text-align: center;"></td>
	<td><center>(New badge)</center></td>
	<td>&nbsp;</td>
	<td><center><input type="submit" value="Give" onclick=""></center></td>
	</form></tr>';
}
?>

