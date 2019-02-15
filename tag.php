<?php

define('TAB_ID', 5);
define('PAGE_ID', 20);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');

$newslist = new Template('comp-sidefr');

if (isset($_GET['archiveMode'])) {
    $newslist->SetParam('mode', 'archive');
} else if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $newslist->SetParam('mode', 'category');
    $newslist->SetParam('category_id', filter($_GET['category']));
} else {
    $newslist->SetParam('mode', 'recent');
}

$tpl->AddTemplate($newslist);

$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');

$article = new Template('comp-tagsearch');

$tpl->AddTemplate($article);
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('body_id', 'news');

$tpl->Output();

?>