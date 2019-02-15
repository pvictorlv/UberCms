<?php
ob_start();
require_once('../global.php');
$my_id = USER_ID;
$sql = dbquery("SELECT credits FROM users WHERE id = '" . USER_ID . "' LIMIT 1");
$myrow = $sql->fetch_assoc();

$task = filter($_POST['task']);
$selectedId = filter($_POST['selectedId']);

$getItem = dbquery("SELECT * FROM site_shop_items WHERE id = '" . $selectedId . "' LIMIT 1");

if ($getItem->num_rows > 0) {
    $row = $getItem->fetch_assoc();

    if ($myrow['credits'] >= $row['price']) {
        $newCredits = $myrow['credits'] - $row['price'];
        dbquery("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES ('" . $my_id . "', '', '" . $row['skin'] . "', '" . $row['type'] . "')");

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