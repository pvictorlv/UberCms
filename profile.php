<?php

define('TAB_ID', 1);
define('PAGE_ID', 4);
define('SUB_PAGE_ID', 4);

require_once "global.php";
if (!LOGGED_IN) {
    header("Location: " . WWW . "/");
    exit;
}

if (isset($_POST['motto']) && isset($_POST['showOnlineStatus']) && isset($_POST['followFriendMode']) && isset($_POST['trade_lock'])) {
    db::query("UPDATE users SET motto = '" . filter($_POST['motto']) . "' WHERE id = '" . USER_ID . "' LIMIT 1");
    if (isset($_POST['friendRequestsAllowed'])) {
        db::query("UPDATE users SET block_newfriends = '0' WHERE id = '" . USER_ID . "' LIMIT 1");
    } else {
        db::query("UPDATE users SET block_newfriends = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
    }

    if ($_POST['showOnlineStatus'] == 'true') {
        db::query("UPDATE users SET hide_online = '0' WHERE id = '" . USER_ID . "' LIMIT 1");
    } else {
        db::query("UPDATE users SET hide_online = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
    }

    if ($_POST['followFriendMode'] == '1') {
        db::query("UPDATE users SET hide_inroom = '0' WHERE id = '" . USER_ID . "' LIMIT 1");
    } else {
        db::query("UPDATE users SET hide_inroom = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
    }
    if ($_POST['trade_lock'] == '1') {
        db::query("UPDATE users SET trade_lock = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
    } else {
        db::query("UPDATE users SET trade_lock = '0' WHERE id = '" . USER_ID . "' LIMIT 1");
    }


    if (!isset($_SESSION['profileUpdate'])) {
        $_SESSION['profileUpdate'] = true;
    }
}


// Initialize template system
$tpl->Init();


// Initial variables
$tpl->SetParam('page_title', 'Preferencias');
$tpl->SetParam('body_id', 'profile');

// Generate page header
$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/settings.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'https://www.google.com/recaptcha/api/js/recaptcha_ajax.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/static/styles/settings.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/friendmanagement.css', 'stylesheet'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Navigation
$tpl->AddGeneric('comp-settings-navi');

// Content
$updateResult = 0;
if (isset($_GET['tab'])) {
    switch ($_GET['tab']) {
        case 2:
            break;
        default:
            $tpl->AddGeneric('comp-profile');
            break;
    }
} else {
    $tpl->AddGeneric('comp-profile');
}

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>