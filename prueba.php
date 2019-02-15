<?php
/*=======================================================================
| LxCMS | Distribución Libre para uso GRATUITO | 2011.
| #######################################################################
| Todos los derechos reservados | Copyright (C) 2011 | HbCMS By Reyes.
| | http://HotelHb.Sytes.Net o http://www.HotelHb.es
| #######################################################################
| Este programa se distribuye con la esperanza de que sea útil,
| pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
| COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la
| Licencia Pública General GNU para más detalles.
\======================================================================*/

define('TAB_ID', 1);
define('PAGE_ID', 2);

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
$tpl->SetParam('page_title', '%habboname%');

// Generate page header
$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/lightweightmepage.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/personal.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://netdna.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/823/web-gallery/static/js/lightweightmepage.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/habboclub.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/minimail.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/minimail.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Me/infofeed widget
$compMe = new Template('comp-me2');
$compMe->SetParam('look', $users->GetUserVar(USER_ID, 'look'));
$compMe->SetParam('motto', $users->GetUserVar(USER_ID, 'motto'));
$compMe->SetParam('creditsBalance', intval($users->GetUserVar(USER_ID, 'credits')));
$compMe->SetParam('VIP CoinsBalance', intval($users->GetUserVar(USER_ID, 'VIP Coins')));
$compMe->SetParam('pixelsBalance', intval($users->GetUserVar(USER_ID, 'activity_points')));
$compMe->SetParam('LastsignedIn', $users->GetUserVar(USER_ID, 'last_online'));
$compMe->SetParam('clubStatus', ($users->HasClub(USER_ID)) ? '<a href="%www%/credits/uberclub">' . $users->GetClubDays(USER_ID) . '</a> Dias' : '<a href="%www%/credits/uberclub">Unete al Habbo Club &raquo;</a>');
//$compMe->SetParam('clubStatus', '');
$tpl->AddTemplate($compMe);
$tpl->AddGeneric('comp-promos');
// Column 1
$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('comp-hotcampaigns');
$tpl->AddGeneric('comp-minimail');
$tpl->AddGeneric('comp-xat');
$tpl->Write('</div>');

// Column 2
$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-news');
$tpl->AddGeneric('comp-usertags');
$tpl->AddGeneric('comp-group');
$tpl->Write('</div>');
$tpl->Write('</div>');


// Column 3
$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('publicidad');

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>
