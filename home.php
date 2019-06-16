<?php
require "global.php";
require "nucleo/class.homes.php";

$qryId = 0;
$userData = null;

if (isset($_GET['qryName'])) {
    $qryId = $users->Name2id(($_GET['qryName']));
} else if (isset($_GET['qryId']) && is_numeric($_GET['qryId'])) {
    $qryId = (int)($_GET['qryId']);
}

if ($qryId <= 0 || !$users->IdExists($qryId)) {
    require "error.php";
    exit;
}

if (LOGGED_IN && $qryId == USER_ID) {
    define('TAB_ID', 1);
    define('PAGE_ID', 33);
}

if (!HomesManager::HomeExists('user', $qryId)) {
    HomesManager::CreateHome('user', $qryId);
}

$userData = db::query("SELECT username FROM users WHERE id = ? LIMIT 1", $qryId)->fetch(2);
$homeData = HomesManager::GetHome(HomesManager::GetHomeId('user', $qryId));

$tpl->Init();

$tpl->SetParam('page_title', clean($userData['username']));
if (isset($_SESSION['startSessionEditHome'])) {
    if ($_SESSION['startSessionEditHome'] == $qryId) {
        $tpl->SetParam('body_id', 'editmode');
    } else {
        $tpl->SetParam('body_id', 'viewmode');
    }
} else {
    $tpl->SetParam('body_id', 'viewmode');
}
$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('homes');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-myhabbo');
if (isset($_SESSION['startSessionEditHome'])) {
    $homeedit = new Template('home-edit');
    $homeedit->SetParam('qryId', $qryId);
    $tpl->AddTemplate($homeedit);
}
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

$home = new Template('page-home-personaje');
$home->SetParam('home_title', clean($userData['username']));
$home->SetParam('qryId', $qryId);
$home->SetParam('homeData', $homeData);
$tpl->AddTemplate($home);

$tpl->AddGeneric('footer');
$tpl->Output();

?>