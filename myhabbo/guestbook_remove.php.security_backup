<?php
include '../global.php';
if (!LOGGED_IN) {
    exit;
}
if (isset($_POST['entryId']) && isset($_POST['widgetId'])) {
    if (is_numeric($_POST['entryId'])) {
        $entryId = filter($_POST['entryId']);
        $sql = mysql_query("SELECT id,userid,home_id FROM cms_guestbook_entries WHERE id = '" . $entryId . "' AND (userid = '" . USER_ID . "' OR home_id = '" . USER_ID . "')");
        $data = mysql_fetch_array($sql);

        if (mysql_num_rows($sql) > 0) {
            if ($data['userid'] == USER_ID || $data['home_id'] == USER_ID) {
                mysql_query("DELETE FROM cms_guestbook_entries WHERE id = '" . $entryId . "' LIMIT 1");
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