<?php
ob_start();
require_once('../global.php');
$my_id = USER_ID;
$selectedStickerId = ($_POST['selectedStickerId']);
$zindex = ($_POST['zindex']);
if (isset($_POST['placeAll'])) {
    $placeAll = ($_POST['placeAll']);
} else {
    $placeAll = NULL;
}

$getItem = db::query("SELECT * FROM site_inventory_items WHERE userId = ? AND id = ? AND isWaiting = '0' LIMIT 1", $my_id, $selectedStickerId);

if ($getItem->rowCount() > 0) {
    $row = $getItem->fetch(2);

    if ($placeAll == "true") {
        $i = 0;
        $x_json = "";
        $getSame = db::query("SELECT * FROM site_inventory_items WHERE userId = ? AND skin = ? AND isWaiting = '0'",
            $my_id, $row['skin']);

        while ($row = $getSame->fetch(2)) {
            $i++;
            $x_json .= $row['id'];
            db::query("UPDATE site_inventory_items SET isWaiting = '1' WHERE userId = ? AND id = ? AND isWaiting = '0' LIMIT 1", $my_id, $row['id']);

            if ($i !== $getSame->rowCount()) {
                $x_json .= ", ";
            }
        }

        header("X-JSON: [" . $x_json . "]");
    } else {
        header("X-JSON: [\"" . $row['id'] . "\"]");
        db::query("UPDATE site_inventory_items SET isWaiting = '1' WHERE userId = ? AND id = ? AND isWaiting = '0' LIMIT 1", $my_id, $selectedStickerId);
    }
} else {
    exit;
}
?>
<?php if ($placeAll == "true") {
    while ($row = $getSame2->fetch(2)) { ?>
        <div class="movable sticker <?php echo $row['skin']; ?>"
             style="left: 20px; top: 30px; z-index: <?php echo $zindex + 1; ?>" id="sticker-<?php echo $row['id']; ?>">
            <img src="<?php echo WWW ?>/web-gallery/v2/images/icon_edit.gif" width="19" height="18" class="edit-button"
                 id="sticker-<?php echo $row['id']; ?>-edit"/>
            <script language="JavaScript" type="text/javascript">
                Event.observe("sticker-<?php echo $row['id']; ?>-edit", "click", function (e) {
                    openEditMenu(e, <?php echo $row['id']; ?>, "sticker", "sticker-<?php echo $row['id']; ?>-edit");
                }, false);
            </script>
        </div>
    <?php }
} else { ?>
    <div class="movable sticker <?php echo $row['skin']; ?>"
         style="left: 20px; top: 30px; z-index: <?php echo $zindex + 1; ?>" id="sticker-<?php echo $row['id']; ?>">
        <img src="<?php echo WWW ?>/web-gallery/v2/images/icon_edit.gif" width="19" height="18"
             class="edit-button"
             id="sticker-<?php echo $row['id']; ?>-edit"/>
        <script language="JavaScript" type="text/javascript">
            Event.observe("sticker-<?php echo $row['id']; ?>-edit", "click", function (e) {
                openEditMenu(e, <?php echo $row['id']; ?>, "sticker", "sticker-<?php echo $row['id']; ?>-edit");
            }, false);
        </script>
    </div>
<?php }
ob_end_flush();
?>
