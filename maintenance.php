<?php
define('IN_MAINTENANCE', true);

require_once "global.php";

if (!defined('FORCE_MAINTENANCE') || !FORCE_MAINTENANCE) {
    header("Location: " . WWW . "/");
    exit;
} else if (LOGGED_IN && $users->hasFuse(USER_ID, 'fuse_ignore_maintenance')) {
    header('Location: ' . WWW . '/');
    exit;
}

$tpl->Init();
$tpl->AddGeneric('page-maintenance');
$tpl->Output();