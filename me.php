<?php


define('TAB_ID', 1);
define('PAGE_ID', 2);

require_once "global.php";

if (!LOGGED_IN) {
    header("Location: " . WWW . "/");
    exit;
} else if ($users->GetUserVar(USER_ID, 'room_created') == "0") {
    header("Location: " . WWW . "/register/welcome");
    exit;
}

$tpl->Init();

$tpl->SetParam('page_title', '%habboname%');

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/lightweightmepage.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/personal.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/rooms.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/lightweightmepage.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/habboclub.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/minimail.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/minimail.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/rooms.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Column 1
$tpl->Write('<div id="column1" class="column">');


// Me/infofeed widget

$compMe = new Template('comp-me');
define('USER_LOOK', $users->GetUserVar(USER_ID, 'look'));
$compMe->SetParam('look', USER_LOOK);
$motto = $users->GetUserVar(USER_ID, 'motto');
define('USER_MOTTO', (empty($motto)) ? "Qual seu pensamento de hoje?" : $motto);
$compMe->SetParam('motto', USER_MOTTO);
$compMe->SetParam('creditsBalance', (int)$users->GetUserVar(USER_ID, 'credits'));
$compMe->SetParam('pixelsBalance', (int)$users->GetUserVar(USER_ID, 'activity_points'));
$compMe->SetParam('LastsignedIn', $users->GetUserVar(USER_ID, 'last_online'));
$compMe->SetParam('clubStatus', ($users->hasClub(USER_ID)) ? '<a href="%www%/credits/habboclub">' . $users->GetClubDays(USER_ID) . '</a> Dias' : '<a href="%www%/credits/uberclub">Junte-se ao Habbo Club &raquo;</a>');
$tpl->AddTemplate($compMe);
$tpl->AddGeneric('comp-gift');
$tpl->AddGeneric('comp-hotcampaigns');
$tpl->AddGeneric('comp-minimail');
$tpl->AddGeneric('comp-habbosearch');
$tpl->Write('</div>');

// Column 2
$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-news');
$tpl->AddGeneric('comp-usertags');
$tpl->AddGeneric('comp-hotrooms');
$tpl->Write('</div>');


// Column 3
$tpl->AddGeneric('generic-column3');
$tpl->Write('</div>');
// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();