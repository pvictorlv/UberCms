<?php
require_once "global.php";

if (LOGGED_IN) {
    header("Location: " . WWW . "/client");
    exit;
}

$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('process-template');		
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');
$tpl->SetParam('csrf_token', $_SESSION['csrf_token']);

$tpl->AddGeneric('process-template-top');
$tpl->AddGeneric('page-clientlogin');
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Entrar no hotel');
$tpl->SetParam('body_id', 'popup');

$tpl->Output();

?>