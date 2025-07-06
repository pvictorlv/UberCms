<?php

define('NOWHOS', true);
define("Xukys", TRUE);
require_once('../global.php');

$stickerId = (int)$_POST['stickerId'];

$getAlreadyItem = db::query("SELECT link FROM homes_items WHERE owner_id = '" . USER_ID . "' AND id =  ? LIMIT 1",
    $stickerId);
$data = $getAlreadyItem->fetch(2);
//echo $data['link'];
$getItem = db::query("SELECT id FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1", $data['link']);


if ($getItem->rowCount() > 0) {
    db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1", $data['link']);
}
if ($getAlreadyItem->rowCount() > 0) {
    //$row = mysql_fetch_assoc($getAlreadyItem);
    db::query("DELETE FROM homes_items WHERE owner_id = '" . USER_ID . "' AND id = ? LIMIT 1", $stickerId);
    db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1", $data['link']);
}

exit;
?>