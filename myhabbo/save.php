<?php
require_once '../global.php';
require_once "../nucleo/class.homes.php";

if (isset($_POST["stickers"])) {
    $var = explode('/', $_POST['stickers']);
    foreach ($var as $var_data) {
        if (empty($var_data)) {
            break;
        }
        $vardata = explode(':', $var_data);
        $xyz = explode(',', $vardata[1]);

        $sql = db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1", $vardata[0]);
        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(2);
            db::query("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id, link) VALUES (NULL, '" . USER_ID . "', 'sticker', ?,?,?,?, '', '" . USER_ID . "', ?);", $xyz[0], $xyz[1], $xyz[2], $row['skin'], $vardata[0]);
        } else {
            db::query("UPDATE homes_items SET x = ?, y = ?, z = ? WHERE id = ? AND owner_id = '" . USER_ID . "' LIMIT 1", $xyz[0], $xyz[1], $xyz[2], $vardata[0]);
        }
    }
}
if (isset($_POST["stickienotes"])) {

    $stickie_notes = explode('/', $_POST['stickienotes']);
    //var_dump($var);
    foreach ($stickie_notes as $note) {
        if (empty($note)) {
            break;
        }
        $data_note = explode(':', $note);
        $coords = explode(',', $data_note[1]);

        $query = db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1",
            $data_note[0]);

        if ($query->rowCount() > 0) {
            $row_stick = $query->fetch(2);

            db::query("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '" . USER_ID . "', 'sticker', ?, ?, ?, ?, '', '" . USER_ID . "');",
                $coords[0], $coords[1], $coords[2], $row_stick['skin']);
//						db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".filter($vardatastickienotes[0])."' AND userId = '".USER_ID."' LIMIT 1");
        } else {
            db::query("UPDATE homes_items SET x = ?, y = ?, z = ? WHERE id = ? AND owner_id = '" . USER_ID . "' LIMIT 1", $coords[0], $coords[1], $coords[2], $data_note[0]);
        }
    }


}

if (isset($_POST["widgets"])) {

    $varwidgets = explode('/', $_POST['widgets']);
    //var_dump($var);
    foreach ($varwidgets as $var_datawidgets) {
        if (empty($var_datawidgets)) {
            return;
        }
        $vardatawidgets = explode(':', $var_datawidgets);
        $xyzwidgets = explode(',', $vardatawidgets[1]);

        $sqlwidgets = db::query("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = ? AND isWaiting = '1' LIMIT 1", $vardatawidgets[0]);

        if ($sqlwidgets->rowCount() > 0) {
            $rowwidgets = $sqlwidgets->fetch(2);

            //db::query("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '".USER_ID."', 'sticker', '".filter($xyzwidgets[0])."', '".filter($xyzwidgets[1])."', '".filter($xyzwidgets[2])."', '".$rowwidgets['skin']."', '', '".USER_ID."');");
//						db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".filter($vardatawidgets[0])."' AND userId = '".USER_ID."' LIMIT 1");
        } else {
            db::query("UPDATE homes_items SET x = ?, y = ?, z = ? WHERE id = ? AND owner_id = '" . USER_ID . "' LIMIT 1", $xyzwidgets[0], $xyzwidgets[1], $xyzwidgets[2], $vardatawidgets[0]);
        }
    }


}

if (isset($_POST['background'])) {
    $bg = explode(':', $_POST['background']);

    if (is_numeric($bg[0])) {
        $sql = db::query('SELECT userId FROM site_inventory_items WHERE id = ?', $bg[0]);
        $data = $sql->fetch(2);
        if ($sql->rowCount() > 0) {
            if ($data['userId'] == USER_ID) {
                db::query('UPDATE homes SET bgimage = ? WHERE home_id = ?', $bg[1], USER_ID);
            }
        }

    }


}

unset($_SESSION['startSessionEditHome']);
?>
<script language="JavaScript" type="text/javascript">
    waitAndGo('/home/<?php echo $_SESSION['UBER_USER_N']; ?>');
</script>