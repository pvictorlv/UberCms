<?php

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head/head-grupos');

$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/styles/assets/other.css?v=cd4283662f0b704a80227001a33203ac', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/home.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/styles/assets/backgrounds.css?v=cd3c3a223dfc37500c560a00c068fd95', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/styles/assets/stickers.css?v=5a9f5cbe379ca65e6417720f48df0510', 'stylesheet'));

$tpl->AddGeneric('generic-top');
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('cuerpo-grupos');

$tpl->Output();

?>