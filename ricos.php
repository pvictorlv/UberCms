<?php
/*=======================================================================
| LxCMS | Distribución Libre para uso GRATUITO | 2012.
\======================================================================*/

define('TAB_ID', 5);
define('PAGE_ID', 1);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/newcredits.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column" class="column">');
$tpl->AddGeneric('ricos-3');
$tpl->Write('</div>');

$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('ricos');
$tpl->Write('</div>');


$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('ricos-2');
$tpl->Write('</div>');
$tpl->Write('</div>');


$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Os mais famosos');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>