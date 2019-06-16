<?php
ob_start();
require_once('../global.php');
$my_id = USER_ID;
$credits = db::query("SELECT credits FROM users WHERE id = '" . USER_ID . "' LIMIT 1")->fetchColumn();

$task = ($_POST['task']);
$selectedId = ($_POST['selectedId']);

$getItem = db::query('SELECT * FROM site_shop_items WHERE id = ? LIMIT 1', $selectedId);

if ($getItem->rowCount() > 0) {
    $row = $getItem->fetch(2);

    if ($credits >= $row['price']) {
        $newCredits = $credits - $row['price'];
        db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES (?, '', '" . $row['skin'] . "', '" . $row['type'] . "')", $my_id);
        $users->EatCredits(USER_ID, $newCredits, false);
        $core->Mus('updatecredits', USER_ID);

        header("X-JSON: " . $row['id']);
        echo "OK";
    } else
        echo "REFRESH";
} else
    echo "REFRESH";

ob_end_flush();
exit;