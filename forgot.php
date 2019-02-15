<?php

require_once "global.php";

if (LOGGED_IN) {
    header("Location: " . WWW . "/me");
    exit;
}

$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('process-template');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('process-template-top');
$recover = new Template('comp-forgot');
$tpl->AddTemplate($recover);
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Home');

$tpl->Output();
