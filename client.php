<?php
require_once "global.php";
require_once "nucleo/class.rooms.php";

if (!LOGGED_IN) {
    header('Location: ' . WWW . '/login_popup');
    exit;
}


$forwardType = 0;
$forwardId = 0;

if ($users->GetUserVar(USER_ID, 'room_created', false) == "0") {
    if (isset($_GET['createRoom']) && is_numeric($_GET['createRoom'])) {
        $roomId = RoomManager::CreateRoom(USER_NAME . "'s room", USER_NAME, 'model_s');

        switch ((int)$_GET['createRoom']) {
            default:
            case 0:

                RoomManager::PaintRoom($roomId, '1701', '601');
                break;

            case 1:

                RoomManager::PaintRoom($roomId, '607', '111');
                break;

            case 2:

                RoomManager::PaintRoom($roomId, '1901', '301');
                break;

            case 3:

                RoomManager::PaintRoom($roomId, '1801', '110');
                break;

            case 4:

                RoomManager::PaintRoom($roomId, '503', '104');
                break;

            case 5:

                RoomManager::PaintRoom($roomId, '804', '107');
                break;
        }

        dbquery("UPDATE users SET home_room = '" . $roomId . "', room_created = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
    } else {
        header("Location: " . WWW . "/client?createRoom=" . random_int(0, 5));
        exit;
    }
} else if (isset($_GET['forwardType']) && isset($_GET['forwardId']) && is_numeric($_GET['forwardType']) && is_numeric($_GET['forwardId'])) {
    $forwardType = (int)$_GET['forwardType'];
    $forwardId = (int)$_GET['forwardId'];

    if ($forwardType >= 3 || $forwardType <= 0) {
        return;
    }
}

if (isset($_GET['roomId'])) {
    $id = filter($_GET['roomId']);
    $users->SetUserVar(USER_ID, 'home_room', $id);
}

$users->SetUserVar(USER_ID, 'ip_last', $users->getUserIP());
$users->SetUserVar(USER_ID, 'auth_ticket', uberCore::GenerateTicket(USER_NAME));
$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('default');
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/habboclient.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/habboflashclient.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/web-gallery/static/js/habboflashclient.js'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

$client = new Template('page-client');
$client->SetParam('page_title', ' ');
$client->SetParam('sso_ticket', $users->GetUserVar(USER_ID, 'auth_ticket', false));
$client->SetParam('flash_base', 'http://images.habbo.com/gordon/RELEASE47-25298-25289-201003111232_95572236204420188d53c5fb779d43f4/');
$client->SetParam('flash_client_url', 'http://images.habbo.com/dcr/r47_none_74f18727eeee7d2cd329f9c7c9078061/');
$client->SetParam('hotel_status', $core->GetUsersOnline() . ' users online now!');
$client->SetParam('forwardType', $forwardType);
$client->SetParam('forwardId', $forwardId);

if (isset($_GET['forceTicket']) && $users->HasFuse(USER_ID, 'fuse_admin')) {
    $client->SetParam('sso_ticket', $_GET['forceTicket']);
}
$users->SetUserVar(USER_ID, 'sec_hash', $users->GetUserVar(USER_ID, 'auth_ticket', false));
setcookie('SECRET_HASH',  $users->GetUserVar(USER_ID, 'sec_hash', false));

$tpl->AddTemplate($client);

$tpl->Output();

?>