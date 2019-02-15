<?php
if (isset($_GET['editar'])) {
    $page = 146;
} elseif (isset($_GET['efectos'])) {
    $page = 43;
} elseif (isset($_GET['rares'])) {
    $page = 34;
} elseif (isset($_GET['placas'])) {
    $page = 35;
} else {
    $page = 145;
}

define('PAGE_ID', $page);

require_once "global.php";
if (!LOGGED_IN) {
    header("Location: " . WWW . "/");
    exit;
}


$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/newcredits.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

if (isset($_GET['editar'])) {

    $tpl->Write('<div id="column1" class="column">');
    $tpl->AddGeneric('comp-bots-edit');
    $tpl->Write('</div>');
    $tpl->Write('<div id="column2" class="column">');
    $tpl->AddGeneric('comp-bots-nav-edit');
    $tpl->AddGeneric('comp-bots-edit2');
    $tpl->Write('</div>');

} elseif (isset($_GET['efectos'])) {
    $tpl->Write('<div id="column1" class="column">');
    $tpl->AddGeneric('comp-bots-efectos');
    $tpl->Write('</div>');

    $tpl->Write('<div id="column2" class="column">');
    $tpl->AddGeneric('comp-bots-nav-efectos');
    $tpl->Write('</div>');

} else {

    $tpl->Write('<div id="content">');
    $tpl->AddGeneric('comp-bots');
    $tpl->Write('</div>');


}

$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'BOTS');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>