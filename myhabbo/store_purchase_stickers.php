<?php
ob_start();
require_once('../global.php');
if (!LOGGED_IN){
    exit;
}
$my_id = USER_ID;
$credits = $users->GetUserVar(USER_ID, 'credits', false);

$task = ($_POST['task']);
$selectedId = ($_POST['selectedId']);

$getItem = db::query("SELECT * FROM site_shop_items WHERE id = ? LIMIT 1", $selectedId);

if ($getItem->rowCount() > 0) {
    $row = $getItem->fetch(2);

    if ($credits >= $row['price']) {
        if ($row['skin'] == "package_product_pre") {
            $Items = explode(",", $row['ItemsContent']);
            $newCredits = $credits - $row['price'];

            if ($users->EatCredits(USER_ID, $newCredits, false)) {
                $core->Mus('updatecredits', USER_ID);
            }
            foreach ($Items as $ItemSkin) {
                db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES (?, '', ?, 'Sticker')",
                    $my_id, $ItemSkin);
            }

            header("X-JSON: " . $row['id']);
            echo "OK";
        } else if ($row['amount'] > 0) {
            $count = 1;
            $amount = $row['amount'];

            while ($count <= $amount) {
                db::query("INSERT INTO site_inventory_items (userId, var, skin, type) VALUES (?, '', '" . $row['skin'] . "', '" . $row['type'] . "')", $my_id);
                $count++;
            }

            header("X-JSON: " . $row['id']);
            echo "OK";
        } else {
            $newCredits = $credits - $row['price'];
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