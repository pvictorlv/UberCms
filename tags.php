<?php

define('TAB_ID', 5);
define('PAGE_ID', 90);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://%www%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('tags-rel');
$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('tags-finder');
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Etiquetas');
$tpl->SetParam('body_id', 'tags');

$tpl->Output();
