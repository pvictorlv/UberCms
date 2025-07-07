<?php
include '../global.php';

if (isset($_SESSION['startSessionEditHome']) && $_SESSION['startSessionEditHome'] == USER_ID) {
    if (isset($_POST['stickieId'])) {
        $stickieId = $gtfo->cleanWord($_POST['stickieId']);
        if (is_numeric($stickieId)) {
            $sql = db::query("SELECT home_id FROM homes_items WHERE id = '" . $stickieId . "' LIMIT 1");
            $data = $sql->fetch(2);

            if ($sql->rowCount() > 0) {
                if ($data['home_id'] == $_SESSION['startSessionEditHome']) {
                    db::query("DELETE FROM homes_items WHERE id = '" . $stickieId . "' LIMIT 1");
                    echo "SUCCESS";
                } else {
                    echo "ERROR";
                }
            } else {
                echo "ERROR";
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
} elseif (isset($_SESSION['startSessionEditGroup']) && $core->GetGroupPerm($_SESSION['startSessionEditGroup']) >= 2) {
    if (isset($_POST['stickieId'])) {
        $stickieId = $gtfo->cleanWord($_POST['stickieId']);
        if (is_numeric($stickieId)) {
            $sql = db::query("SELECT group_id FROM groups_items WHERE id = '" . $stickieId . "' LIMIT 1");
            $data = $sql->fetch(2);

            if ($sql->rowCount() > 0) {
                if ($data['group_id'] == $_SESSION['startSessionEditGroup']) {
                    db::query("DELETE FROM groups_items WHERE id = '" . $stickieId . "' LIMIT 1");
                    echo "SUCCESS";
                } else {
                    echo "ERROR";
                }
            } else {
                echo "ERROR";
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
}

?>