<?php

define('IN_MAINTENANCE', true);
define('BAN_PAGE', true);

include "global.php";

if (LOGGED_IN) {
    $core->Mus('signOut', USER_ID);
}

session_destroy();

setcookie('rememberme', 'false', time() - 3600, '/');
setcookie('rememberme_token', '-', time() - 3600, '/');

unset($_COOKIE['rememberme']);
unset($_COOKIE['rememberme_token']);

header("Location: " . WWW . "/account/logout_ok");
exit;