<?php

require_once "../nucleo/class.rooms.php";

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) {
    exit;
}
global $db;

if (isset($_GET['doDenyAppeal']) && is_numeric($_GET['doDenyAppeal'])) {
    $q = dbquery("UPDATE bans SET appeal_state = '2' WHERE id = '" . (int)filter($_GET['doDenyAppeal']) . "'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'") . " LIMIT 1");
    if ($db->GetAffected() >= 1) {
        dbquery("DELETE FROM bans_appeals WHERE ban_id = '" . (int)filter($_GET['doDenyAppeal']) . "' LIMIT 1");
        fMessage('ok', 'Ban appeal denied.');

        header("Location: index.php?_cmd=bans");
        exit;
    }
}

if (isset($_GET['unban']) && is_numeric($_GET['unban'])) {
    dbquery("DELETE FROM bans WHERE id = '" . (int)filter($_GET['unban']) . "'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'") . " LIMIT 1");

    if ($db->GetAffected() >= 1) {
        dbquery("DELETE FROM bans_appeals WHERE ban_id = '" . (int)filter($_GET['unban']) . "' LIMIT 1");
        fMessage('ok', 'Ban removed.');

        $core->Mus('reloadbans');

        header("Location: index.php?_cmd=bans");
        exit;
    }
}

if (isset($_POST['bantype'])) {
    $bantype = filter($_POST['bantype']);
    $value = filter($_POST['value']);
    $reason = filter($_POST['reason']);
    $length = filter($_POST['length']);
    $noAppeal = '';

    if (isset($_POST['no-appeal'])) {
        $noAppeal = filter($_POST['no-appeal']);
    }

    if ($bantype != "ip" && $bantype != "user") {
        $bantype = "user";
    }

    if (strlen($value) <= 0 || strlen($reason) <= 0 || !is_numeric($length) || intval($length) < 600) {
        fMessage('error', 'Por favor, rellene todos los campos correctamente! (Tambi�n toman nota de la prohibici�n debe ser de al menos 10 minutos de duraci�n!)');
        header("Location: index.php?_cmd=bans");
        exit;
    }

    // $type, $value, $reason, $expireTime, $addedBy
    uberCore::AddBan($bantype, $value, $reason, time() + $length, HK_USER_NAME, (($noAppeal == "checked") ? true : false));
    $core->Mus('reloadbans');
}

require_once "top.php";

?>

    <h1>Gestionar recursos y prohibiciones</h1>

    <br/>

    <p>
        Esta herramienta le permite realizar y gestionar las prohibiciones, as� como los recursos de revisi�n
        prohibici�n.
    </p>

    <br/>

    <h2>Llamamientos a la espera de su prohibici�n</h2>

    <br/>

    <p>
        Esta es una visi�n general de los recursos interpuestos contra las prohibiciones que realiz�. Tome en cuenta que
        los administradores tambi�n pueden administrar sus recursos prohibici�n.
    </p>

    <br/>

    <table width="100%" border="1">
        <thead>
        <tr>
            <td>Detalles de Ban</td>
            <td>IP</td>
            <td>Datos submitidos</td>
            <td>Responder e-mail</td>
            <td>Razon</td>
            <td>Revision</td>
        </tr>
        </thead>
        <tbody>
        <?php

        $getMyBans = dbquery("SELECT id,bantype,value,expire,added_date,appeal_state FROM bans WHERE appeal_state = '1'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'"));

        while ($ban = $getMyBans->fetch_assoc()) {
            $findAppeal = dbquery("SELECT * FROM bans_appeals WHERE ban_id = '" . $ban['id'] . "' LIMIT 1");

            if ($findAppeal->num_rows == 1) {
                $data = $findAppeal->fetch_assoc();

                if ($data['plea'] == '') {
                    continue;
                }

                echo '<tr>
		<td>' . strtoupper($ban['bantype']) . ' Ban: <b>' . clean($ban['value']) . '</b><br />
		Placed on <u>' . $ban['added_date'] . '</u>,<br />set to expire on <u>' . date('d F, Y', $ban['expire']) . '</u>.</td>
		<td>' . $data['send_ip'] . '</td>
		<td>' . $data['send_date'] . '</td>
		<td>' . clean($data['email']) . '</td>
		<td style="background-color: #CEE3F6; text-align: center; font-size: 90%;">' . nl2br(clean($data['plea'])) . '</td>
		<td><input type="button" style="color: darkgreen;" onclick="document.location = \'index.php?_cmd=bans&unban=' . $data['ban_id'] . '\';" value="Accept and unban">&nbsp;<input style="color: darkred;" type="button" onclick="document.location = \'index.php?_cmd=bans&doDenyAppeal=' . $ban['id'] . '\';" value="Deny"></td>
		</tr>';
            }
        }

        ?>
        </tbody>
    </table>

    <br/>
    <h2>A�adir nu nuevo Baneo.</h2>
    <br/>
    <form method="post">Tipo de Ban:<br/>
        <select name="bantype" onclick="onchange=" if (this.value== 'ip') {
        document.getElementById('ban-value-heading').innerHTML = 'IP Address'; } else {
        document.getElementById('ban-value-heading').innerHTML = 'Username'; }" onkeyup="onchange="if (this.value ==
        'ip') { document.getElementById('ban-value-heading').innerHTML = 'IP Address'; } else {
        document.getElementById('ban-value-heading').innerHTML = 'Username'; }" onchange="if (this.value == 'ip') {
        document.getElementById('ban-value-heading').innerHTML = 'IP Address'; } else {
        document.getElementById('ban-value-heading').innerHTML = 'Username'; }">
        <option value="ip">Baneo por IP</option>
        <option value="user">Baneo por Usuario</option>
        </seleccionar><br/>
        <br/>

        <span id="ban-value-heading">IP</span>:<Br/>
        <input type="text" name="value"><br/>
        <br/>

        Razon:<br/>
        <input type="text" name="reason"><br/>
        <br/>

        <script type="text/javascript">
            function banPreset(val) {
                document.getElementById('banlength').value = val;
            }
        </script>

        Duraci�n (en segundos!):<br/>
        <input type="text" name="length" id="banlength"> segundos<br/>
        <small>(Presets: <a href="#" onclick="banPreset(3600);">1hr</a> <a href="#" onclick="banPreset(10800);">3hr</a>
            <a href="#" onclick="banPreset(43200);">12hr</a> <a href="#" onclick="banPreset(86400);">1day</a> <a
                href="#" onclick="banPreset(259200);">3day</a> <a href="#" onclick="banPreset(604800);">1wk</a> <a
                href="#" onclick="banPreset(1209600);">2wk</a> <a href="#" onclick="banPreset(2592000);">1mo</a> <a
                href="#" onclick="banPreset(7776000);">3mo</a> <a href="#" onclick="banPreset(1314000);">1yr</a> <a
                href="#" onclick="banPreset(2628000);">2yr</a> <a href="#" onclick="banPreset(360000000);">Perm</a>)
        </small>
        <br/>
        <br/>


        <br/>

        <input type="submit" value="Ban!">

    </form>

    <br/>
    <h2>Lista de Bans</h2>

    <br/>

    <table width="100%" border="1">
        <thead>
        <tr>
            <td>Ban ID</td>
            <td>Datos</td>
            <td>Razon</td>
            <td>Expira</td>
            <td>Agregada</td>
            <td>Estado</td>
            <td>Opciones</td>
        </tr>
        </thead>
        <tbody>
        <?php

        $getBans = dbquery("SELECT * FROM bans ORDER BY expire DESC");

        while ($ban = $getBans->fetch_assoc()) {
            echo '<tr>
	<td>' . $ban['id'] . '</td>
	<td>' . strtoupper($ban['bantype']) . ' Ban: <b>' . clean($ban['value']) . '</b></td>
	<td style="text-align: center; font-size: 90%;">' . clean($ban['reason'], true, true) . '</td>
	' . (($ban['expire'] <= time()) ? '<td style="text-align: center; background-color: #F6CECE; color: #B40404;">Expir� el ' . date('d F, Y', $ban['expire']) . '</td>' : '<td>Expira el ' . date('d F, Y', $ban['expire']) . '</td>') . '
	<td>El ' . $ban['added_date'] . ' Por ' . clean($ban['added_by']) . '</td>
	<td style="text-align: center;">';

            if ($ban['appeal_state'] == "0") {
                echo 'Not allowed to appeal!';
            } else if ($ban['appeal_state'] == "1") {
                if (dbquery("SELECT NULL FROM bans_appeals WHERE ban_id = '" . $ban['id'] . "' AND plea != '' LIMIT 1")->num_rows > 0) {
                    echo '<b style="color: blue;">El usuario ha enviado su apelaci�n, esperando la revisi�n de un Moderador.</b>';
                } else {
                    echo 'El usuario no ha enviado una apelaci�n.';
                }
            } else if ($ban['appeal_state'] == "2") {
                echo '<b style="color: red;">Appeal reviewed and declined</b>';
            }

            echo '</td>
	<td>';

            if (strtolower($ban['added_by']) == strtolower(HK_USER_NAME) || $users->HasFuse(USER_ID, 'fuse_admin')) {
                echo '<input type="button" onclick="document.location = \'index.php?_cmd=bans&unban=' . $ban['id'] . '\';" value="' . (($ban['expire'] <= time()) ? 'Remover' : 'Des-Banear') . '">';
            }

            echo '</td></tr>';
        }

        ?>
        </body>
    </table>

<?php

require_once "bottom.php";

?>