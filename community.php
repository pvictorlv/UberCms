<?php

define('TAB_ID', 5);
define('PAGE_ID', 7);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-init');

$tpl->SetParam('page_title', 'Comunidade');
$tpl->SetParam('body_id', 'Home');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/rooms.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/rooms.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/moredata.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');
	
$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('comp-randomhabbos');
//$tpl->AddGeneric('comp-topgrupos');

$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-news');
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->Output();
