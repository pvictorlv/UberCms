<?php
require_once '../global.php';
require_once "../nucleo/class.homes.php";

if (isset($_POST['skinId']) && isset($_POST['stickieId'])) {
    if (is_numeric($_POST['skinId']) && is_numeric($_POST['stickieId'])) {

        switch ($_POST['skinId']) {
            case 1:
                $skin = 'defaultskin';
                break;
            case 2:
                $skin = 'speechbubbleskin';
                break;
            case 3:
                $skin = 'metalskin';
                break;
            case 4:
                $skin = 'noteitskin';
                break;
            case 5:
                $skin = 'notepadskin';
                break;
            case 6:
                $skin = 'goldenskin';
                break;
            case 7:
                $skin = 'hc_machineskin';
                break;
            case 8:
                $skin = 'hc_pillowskin';
                break;
            default:
                $skin = '';
                break;
        }
        $skiId = 'n_skin_' . $skin;
        $sql = dbquery("SELECT type,owner_id FROM homes_items WHERE id = '" . $_POST['stickieId'] . "' LIMIT 1");
        $data = $sql->fetch_assoc();
        if ($data['owner_id'] == USER_ID) {
            header('X-JSON: {"id":"' . $_POST['stickieId'] . '","cssClass":"' . $skiId . '","type":"' . $data['type'] . '"}');
            echo HomeItem::UpdateItem($skiId, $_POST['stickieId']);
        }
    }
}


?>