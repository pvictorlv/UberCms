<?php
/*===================================================+
|| # EliteCMS by BlackSn2k3
|| # TurboCMS by BlackSn23 & das97 and nanotec
|+===================================================*/

define('TAB_ID', 12);
define('PAGE_ID', 18);

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Guia para padres');

// Generate page header
$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/style.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/home.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/styles/assets/backgrounds.css?v=cd3c3a223dfc37500c560a00c068fd95', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/homeauth.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/lightwindow.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/homeview.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-overrides-generic');
$tpl->AddGeneric('head/head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Column 1

// Me/infofeed widget
$tpl->AddGeneric('comp-padres');


// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>

