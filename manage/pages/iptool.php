<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) {
    exit;
}

$ip = '';

if (isset($_POST['ip'])) {
    $ip = filter($_POST['ip']);
}

require_once "top.php";

echo '<h1>Procurar por clones.</h1>
<br /><p>Nessa ferramenta você pode verificar as contas fakes de um usuário.</p>';

echo '<br />
<form method="post">
Usuário:<br />
<input type="text" name="user">
<input type="submit" value="Procurar">
</form>';

echo '<br />
<form method="post">
IP:<br />
<input type="text" name="ip">
<input type="submit" value="Mirar">
</form>';

if (isset($_POST['user'])) {
    $user = filter($_POST['user']);
    $get = db::query("SELECT ip_last,ip_reg FROM users WHERE username = '$user'");
    $r = $get->fetch(2);
    if ($r != null) {
        $ip = $r['ip_last'];
        if ($ip == null)
            $ip = $r['ip_reg'];
    }

    echo '<h2>Ip de ' . $user . ': <b>' . $ip . '</b></h2>';
}

if (isset($ip) && strlen($ip) > 0) {
    echo '<br><h2>Usuários com o ip ' . $ip . '</h2>';
    $get = db::query("SELECT * FROM users WHERE ip_last = '" . $ip . "' LIMIT 50");

    while ($user = $get->fetch(2)) {
        $date = $user['last_online'];
        echo '<h2 style="width: 50%;"><B>' . clean($user['username']) . '</B> <Small>(ID: ' . $user['id'] . ')</small><br /><span style="font-weight: normal;">Última conexão: ' . $date . ' <br />E-mail: ' . $user['mail'] . '<br />Este usuario esta <b>' . (($user['online'] == "1") ? 'online!' : 'offline') . '</b></span></h2>';
    }
}

require_once "bottom.php";

?>