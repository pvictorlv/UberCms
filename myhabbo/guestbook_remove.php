<?php
include '../global.php';
if (!LOGGED_IN) {
    exit;
}
if (isset($_POST['entryId']) && isset($_POST['widgetId'])) {
    if (is_numeric($_POST['entryId'])) {
        $entryId = filter($_POST['entryId']);
        $sql = Db::query("SELECT id,userid,home_id FROM cms_guestbook_entries WHERE id = '" . $entryId . "' AND (userid = '" . USER_ID . "' OR home_id = '" . USER_ID . "')");
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        if ($sql->rowCount() > 0) {
            if ($data['userid'] == USER_ID || $data['home_id'] == USER_ID) {
                Db::query("DELETE FROM cms_guestbook_entries WHERE id = '" . $entryId . "' LIMIT 1");
                echo 'OK';
            } else {
                echo 'Error 1';
            }
        } else {
            echo 'Error 2';
        }

    } else {
        echo 'Error 3';
    }
}
?>