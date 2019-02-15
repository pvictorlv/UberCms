<?php
/*=======================================================================
| LxCMS v2A Por MoNiKoS - | Distribución Libre para uso GRATUITO | 2012.
#########################################################################
| Escribe aquí, pero no robes mis créditos ;).
\======================================================================*/

define('TAB_ID', 5);
define('PAGE_ID', 99);

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

$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('comp-linces');
$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-linces-about');
$tpl->Write('</div>');

// Column 3
$tpl->Write('<div id="column3" class="column">');
$tpl->AddGeneric('publicidad');
$tpl->Write('</div>');

// Footer
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Equipo de Publicistas');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>