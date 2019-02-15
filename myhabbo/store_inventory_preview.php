<?php
ob_start();
if (!defined('NOWHOS')) {
    define('NOWHOS', true);
}
define("Xukys", true);
require_once('../global.php');
$my_id = USER_ID;
$itemId = filter($_POST['itemId']);
$type = ucwords(filter($_POST['type']));
if ($type != 'Notes') {
    $type = substr($type, 0, -1);
}
$query = "SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND id = '" . $itemId . "' AND type = '" . $type . "' AND isWaiting = '0'";
$getPreview = dbquery($query);
//echo $query;

if ($getPreview->num_rows > 0 || $type == "Widget") {
    $row = $getPreview->fetch_assoc();
    $getSame = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND skin = '" . $row['skin'] . "' AND type = '" . $type . "' AND isWaiting = '0'")->num_rows;

    if ($type == "Widget") {
        if ($itemId == "5") {
            $row['skin'] = "w_guestbookwidget_pre";
        }
        if ($itemId == "17") {
            $row['skin'] = "w_traxplayerwidget_pre";
        }
        if ($itemId == "8") {
            $row['skin'] = "w_memberwidget_pre";
        }
        if ($itemId == "3") {
            $row['skin'] = "w_friendswidget_pre";
        }
        if ($itemId == "21") {
            $row['skin'] = "w_badgeswidget_pre";
        }
        if ($itemId == "15") {
            $row['skin'] = "w_ratingwidget_pre";
        }
        if ($itemId == "7") {
            $row['skin'] = "w_groupswidget_pre";
        }
        if ($itemId == "2") {
            $row['skin'] = "w_roomswidget_pre";
        }
        //if($itemId == "17") { $row['skin'] = "w_traxplayerwidget_pre"; }
    }
    header("X-JSON: [\"" . $row['skin'] . "\",\"" . $row['skin'] . "\",\"\",\"" . $type . "\",null," . $getSame . "]");
} else {
    exit;
}
?>
    <h4>&nbsp;</h4>

    <div id="inventory-preview-box"></div>

    <div id="inventory-preview-place" class="clearfix">
        <div class="clearfix">
            <a href="#" class="new-button" id="inventory-place"><b>Colocar</b><i></i></a>
        </div>
        <?php if ($getSame > 1) { ?>
            <div class="clearfix">
                <a href="#" class="new-button" id="inventory-place-all"><b>Colocar todos</b><i></i></a>
            </div>
        <?php } ?>
    </div>
<?php
ob_end_flush();
?>