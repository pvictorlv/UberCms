<?php
ob_start();
require_once('../global.php');
$my_id = USER_ID;
$selectedStickerId = filter($_POST['selectedStickerId']);
$zindex = filter($_POST['zindex']);
if (isset($_POST['placeAll'])) {
    $placeAll = filter($_POST['placeAll']);
} else {
    $placeAll = NULL;
}

$getItem = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND id = '" . $selectedStickerId . "' AND isWaiting = '0' LIMIT 1");

if ($getItem->num_rows > 0) {
    $row = $getItem->fetch_assoc();

    if ($placeAll == "true") {
        $i = 0;
        $x_json = "";
        $getSame = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND skin = '" . $row['skin'] . "' AND isWaiting = '0'");
        $getSame2 = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND skin = '" . $row['skin'] . "' AND isWaiting = '0'");

        while ($row = $getSame->fetch_assoc()) {
            $i++;
            $x_json .= $row['id'];
            dbquery("UPDATE site_inventory_items SET isWaiting = '1' WHERE userId = '" . $my_id . "' AND id = '" . $row['id'] . "' AND isWaiting = '0' LIMIT 1");

            if ($i !== $getSame->num_rows) {
                $x_json .= ", ";
            }
        }

        header("X-JSON: [" . $x_json . "]");
    } else {
        header("X-JSON: [\"" . $row['id'] . "\"]");
        dbquery("UPDATE site_inventory_items SET isWaiting = '1' WHERE userId = '" . $my_id . "' AND id = '" . $selectedStickerId . "' AND isWaiting = '0' LIMIT 1");
    }
} else {
    exit;
}
?>
<?php if ($placeAll == "true") {
    while ($row = $getSame2->fetch_assoc()) { ?>
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
