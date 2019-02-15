<?php

define('TAB_ID', 6);
define('PAGE_ID', 9);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/newcredits.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');

$tpl->AddGeneric('page-newcredits');

if (LOGGED_IN) {
    $redeemHabblet = new Template('comp-redeemhabblet');
    $redeemHabblet->SetParam('creditsBalance', $users->GetUserVar(USER_ID, 'credits'));
    $tpl->AddTemplate($redeemHabblet);
}

$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Creditos');
$tpl->SetParam('body_id', 'newcredits');

$tpl->Output();

?>