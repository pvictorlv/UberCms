<?php
ob_start();
require_once('../global.php');
if (!LOGGED_IN) {
    exit;
}
$my_id = USER_ID;
$coins = $users->GetUserVar(USER_ID, 'credits', false);

$task = filter($_POST['task']);
$selectedId = filter($_POST['selectedId']);

$getItem = db::query("SELECT * FROM site_shop_items WHERE id = '" . $selectedId . "' LIMIT 1");

if ($getItem->rowCount() > 0) {
    $row = $getItem->fetch(2);

    if ($coins >= $row['price']) {
        if ($row['skin'] == "package_product_pre") {
            $Items = explode(",", $row['ItemsContent']);
            $newCredits = $coins - $row['price'];

            if ($users->EatCredits(USER_ID, $newCredits, false)) {
                $core->Mus('updatecredits', USER_ID);

            }
            foreach ($Items as $ItemSkin) {
                db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES ('" . $my_id . "', '', '" . $ItemSkin . "', 'Stickie')");
            }

            header("X-JSON: " . $row['id']);
            echo "OK";
        } else if ($row['amount'] > 0) {
            $count = 1;
            $amount = $row['amount'];

            while ($count <= $amount) {
                db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES ('" . $my_id . "', '', '" . $row['skin'] . "', '" . $row['type'] . "')");
                $count++;
            }

            header("X-JSON: " . $row['id']);
            echo "OK";
        } else {
            $newCredits = $coins - $row['price'];
            if ($users->EatCredits(USER_ID, $newCredits, false)) {
                $core->Mus('updatecredits', USER_ID);

            }
            db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES ('" . $my_id . "', '', '" . $row['skin'] . "', '" . $row['type'] . "')");

            header("X-JSON: " . $row['id']);
            echo "OK";
        }
    }
}
ob_end_flush();
exit;