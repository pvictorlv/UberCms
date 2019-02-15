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
$users->SetUserVar(USER_ID, 'sec_hash', $users->GetUserVar(USER_ID, 'auth_ticket', false));
setcookie('SECRET_HASH',  $users->GetUserVar(USER_ID, 'auth_ticket', false));
?>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<form id="loginTo" action="http://oblivion.website/" method="post">
    <input type="hidden" name="sso" value="<?php echo $users->GetUserVar(USER_ID, 'auth_ticket', false) ?>">
    <input type="hidden" name="hotel" value="<?php echo USER_NAME ?>">
    <input type="hidden" name="camera" value="null">
    <input type="hidden" name="param" value="<?php echo 55 ?>">
</form>
<script>
    $("#loginTo").submit();
</script>