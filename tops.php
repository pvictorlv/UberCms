<?php
define('TAB_ID', 5);
define('PAGE_ID', 149);

require_once "global.php";

$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Hall');

// Generate page header
$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/personal.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/habboclub.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/minimail.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/minimail.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

$tpl->AddGeneric('generic-top');

$tpl->AddGeneric('comp-tops');

$tpl->Output();