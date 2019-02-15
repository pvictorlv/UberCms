<?php
require_once "global.php";

if (!LOGGED_IN || $users->GetUserVar(USER_ID, 'room_created') != "0") {
    header('Location: ' . WWW . '/');
    exit;
}

$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddGeneric('head/process-template');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/welcome.css', 'stylesheet'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

$welcome = new Template('page-welcome');
$welcome->SetParam('habboLook', $users->GetUserVar(USER_ID, 'look'));
$tpl->AddTemplate($welcome);

$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Bem-Vindo!');

$tpl->Output();