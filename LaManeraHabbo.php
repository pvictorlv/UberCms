<?php
/*===================================================+
|| # LxCMS v2A - MoNiKoS.
|+===================================================*/

define('TAB_ID', 12);
define('PAGE_ID', 13);

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}
else if ($users->GetUserVar(USER_ID, 'newbie_status') == "0")
{
	header("Location: " . WWW . "/register/welcome");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'La Manera Habbo');

// Generate page header
$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/style.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/home.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/styles/assets/backgrounds.css?v=cd3c3a223dfc37500c560a00c068fd95', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'www%/web-gallery/static/js/homeauth.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'www%/web-gallery/v2/styles/lightwindow.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://www.habbo.es/myhabbo/styles/assets/stickers.css?v=5a9f5cbe379ca65e6417720f48df0510', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'www%/web-gallery/static/js/homeview.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Column 1
$tpl->Write('<div id="column1" class="column">');

// Me/infofeed widget
$tpl->AddGeneric('comp-manera');

// Footer
$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>

