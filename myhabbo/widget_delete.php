<?php
if (!defined('Xukys')) {
    define('Xukys', true);
}
if (!defined('NOWHOS')) {
    define('NOWHOS', true);
}
include '../global.php';

if (!LOGGED_IN) {
    header('Location: ' . WWW . '/');
}

if (isset($_POST['widgetId'])) {
    if (is_numeric($_POST['widgetId'])) {
        $widgetId = $_POST['widgetId'];
        $sql = db::query("SELECT id,owner_id FROM homes_items WHERE id = ? AND home_id = '" . USER_ID . "'", $widgetId);
        $data = $sql->fetch(2);

        if (!empty($data)) {
            if ($data['owner_id'] == USER_ID) {
                db::query("DELETE from homes_items WHERE id = ? LIMIT 1", $widgetId);
            }
        }

    }
}
?>