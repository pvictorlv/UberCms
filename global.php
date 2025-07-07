<?php
date_default_timezone_set('America/Sao_Paulo');

const DS = DIRECTORY_SEPARATOR;
define('LB', chr(13));
define('CWD', str_replace('manage' . DS, '', __DIR__ . DS));
const INCLUDES = CWD . 'nucleo' . DS;

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_ALL);
ini_set('display_errors', 1);
//error_reporting(0);
session_start();

// ############################################################################
// Initialize core classes

include INCLUDES . "class.core.php";
include INCLUDES . "class.db.mysql.php";
include INCLUDES . "class.cron.php";
include INCLUDES . "class.users.php";
include INCLUDES . "class.tpl.php";
include INCLUDES . "class.grupos.php";
include INCLUDES . "class.groups.php";

$core = new uberCore();
$cron = new uberCron();
$users = new uberUsers();
$tpl = new uberTpl();
$groups = new Groups();

define('USER_IP', $users->getUserIP());


// ############################################################################
// Execute some required core functionality
$core->ParseConfig();

Db::Init($core->config['MySQL']['hostname'], $core->config['MySQL']['username'],
    $core->config['MySQL']['password'], $core->config['MySQL']['database']);
$cron->Execute();


// ############################################################################
// Session handling

if (isset($_SESSION['UBER_USER_N'], $_SESSION['UBER_USER_H'])) {
    $userN = $_SESSION['UBER_USER_N'];
    $userH = $_SESSION['UBER_USER_H'];

    if ($users->ValidateUser($userN, $userH)) {
        define('LOGGED_IN', true);
        define('USER_NAME', $userN);
        define('USER_ID', $users->name2id($userN));
        define('USER_HASH', $userH);
        $users->CacheUser(USER_ID);
    } else {
        @session_destroy();
        header('Location: ./index.html');
        exit;
    }
} else {
    define('LOGGED_IN', false);
    define('USER_NAME', 'Guest');
    define('USER_ID', -1);
    define('USER_HASH', null);
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
function formatThing($type, $data, $pre) {
    $str = '';
    switch($type) {
        case 1:
            $str .= 's_';
            break;
        case 2:
            $str .= 'w_';
            break;
        case 3:
            $str .= 'commodity_';
            break; // =S
        case 4:
            $str .= 'b_';
            break;
    }
    $str .= $data;
    $str = ($pre == true ? $str . '_pre' : '');
    return $str;
}

define('FORCE_MAINTENANCE', false);
$manu_ip = array('177.137.230.90', '103.14.116.25', '177.79.59.42', '148.101.94.123', '177.79.58.126', '201.87.213.118', '177.79.60.231
');

if (!in_array(USER_IP, $manu_ip, true)) {
    if (FORCE_MAINTENANCE && !defined('IN_MAINTENANCE')) {
        if (!LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_ignore_maintenance')) {
            header('Location: ' . WWW . '/maintenance.html');
            exit;
        }
    }
}

if ((!defined('BAN_PAGE') || !BAN_PAGE) && (uberUsers::IsIpBanned(USER_IP) || (LOGGED_IN && uberUsers::IsUserBanned(USER_NAME)))) {
    header('Location: ' . WWW . "/banned.php");
    exit;
}

uberCore::CheckCookies();

function shuffle_assoc(&$array)
{
    $keys = array_keys($array);

    shuffle($keys);

    foreach ($keys as $key) {
        $new[$key] = $array[$key];
    }

    $array = $new;
    return true;
}

function clean($strInput = '', $ignoreHtml = false, $nl2br = false)
{
    return uberCore::CleanStringForOutput($strInput, $ignoreHtml, $nl2br);
}


if (defined('MUST_LOG') && !LOGGED_IN) {
    header('Location: ' . WWW . '/');
}

function fixText($str, $quotes = true, $clean = false, $ltgt = false, $transform = false, $guestbook = false)
{
    return uberCore::fixText($str, $quotes, $clean, $ltgt, $transform, $guestbook);
}

function GenRandom()
{
    return uberCore::GenRandom();
}

function BBCode($str)
{
    return uberCore::BBcode($str);
}

function filter($str): string
{
   return FilterText($str, true);
}

