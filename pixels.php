<?php
define('TAB_ID', 6);
define('PAGE_ID', 10);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/newcredits.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');
$tpl->AddGeneric('page-pixels');
$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Pixeles');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>