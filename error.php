<?php

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-init');

$tpl->AddIncludeSet('generic');
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head/head-overrides-generic');
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('comp-error');
$tpl->AddGeneric('comp-vip-support');
$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-lookingfor');
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'página no encontrada!');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>

<?php echo WWW ?>