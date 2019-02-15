<?php
require_once '../global.php';
require_once "../nucleo/class.homes.php";

if (isset($_POST["stickers"])) {
    $var = explode('/', $_POST['stickers']);
    foreach ($var as $var_data) {
        if (empty($var_data)) {
            return;
        }
        $vardata = explode(':', $var_data);
        $xyz = explode(',', $vardata[1]);

        $sql = dbquery("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . filter($vardata[0]) . "' AND isWaiting = '1' LIMIT 1");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            dbquery("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id, link) VALUES (NULL, '" . USER_ID . "', 'sticker', '" . filter($xyz[0]) . "', '" . filter($xyz[1]) . "', '" . filter($xyz[2]) . "', '" . $row['skin'] . "', '', '" . USER_ID . "', '" . filter($vardata[0]) . "');");
        } else {
            dbquery("UPDATE homes_items SET x = '" . filter($xyz[0]) . "', y = '" . filter($xyz[1]) . "', z = '" . filter($xyz[2]) . "' WHERE id = '" . filter($vardata[0]) . "' AND owner_id = '" . USER_ID . "' LIMIT 1");
        }
    }
}
if (isset($_POST["stickienotes"])) {

    $varstickienotes = explode('/', $_POST['stickienotes']);
    //var_dump($var);
    foreach ($varstickienotes as $var_datastickienotes) {
        if (empty($var_datastickienotes)) {
            break;
        }
        $vardatastickienotes = explode(':', $var_datastickienotes);
        $xyzstickienotes = explode(',', $vardatastickienotes[1]);

        $sqlstickienotes = dbquery("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . filter($vardatastickienotes[0]) . "' AND isWaiting = '1' LIMIT 1");

        if ($sqlstickienotes->num_rows > 0) {
            $rowstickienotes = $sqlstickienotes->fetch_assoc();

            dbquery("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '" . USER_ID . "', 'sticker', '" . filter($xyzstickienotes[0]) . "', '" . filter($xyzstickienotes[1]) . "', '" . filter($xyzstickienotes[2]) . "', '" . $rowstickienotes['skin'] . "', '', '" . USER_ID . "');");
//						dbquery("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".filter($vardatastickienotes[0])."' AND userId = '".USER_ID."' LIMIT 1");
        } else {
            dbquery("UPDATE homes_items SET x = '" . filter($xyzstickienotes[0]) . "', y = '" . filter($xyzstickienotes[1]) . "', z = '" . filter($xyzstickienotes[2]) . "' WHERE id = '" . filter($vardatastickienotes[0]) . "' AND owner_id = '" . USER_ID . "' LIMIT 1");
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

        $sqlwidgets = dbquery("SELECT skin FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . filter($vardatawidgets[0]) . "' AND isWaiting = '1' LIMIT 1");

        if ($sqlwidgets->num_rows > 0) {
            $rowwidgets = $sqlwidgets->fetch_assoc();

            //dbquery("INSERT INTO homes_items (id, home_id, type, x, y, z, data, skin, owner_id) VALUES (NULL, '".USER_ID."', 'sticker', '".filter($xyzwidgets[0])."', '".filter($xyzwidgets[1])."', '".filter($xyzwidgets[2])."', '".$rowwidgets['skin']."', '', '".USER_ID."');");
//						dbquery("UPDATE site_inventory_items SET isWaiting = '0' WHERE id = '".filter($vardatawidgets[0])."' AND userId = '".USER_ID."' LIMIT 1");
        } else {
            dbquery("UPDATE homes_items SET x = '" . filter($xyzwidgets[0]) . "', y = '" . filter($xyzwidgets[1]) . "', z = '" . filter($xyzwidgets[2]) . "' WHERE id = '" . filter($vardatawidgets[0]) . "' AND owner_id = '" . USER_ID . "' LIMIT 1");
        }
    }


}

if (isset($_POST['background'])) {
    $background = filter($_POST['background']);
    $bg = explode(':', $_POST['background']);

    if (is_numeric($bg[0])) {
        $sql = dbquery("SELECT userId FROM site_inventory_items WHERE id = '" . $bg[0] . "'");
        $data = $sql->fetch_assoc();
        if ($sql->num_rows > 0) {
            if ($data['userId'] == USER_ID) {
                dbquery("UPDATE homes SET bgimage = '" . $bg[1] . "' WHERE home_id = '" . USER_ID . "'");
            }
        }

    }


}

unset($_SESSION['startSessionEditHome']);
?>
<script language="JavaScript" type="text/javascript">
    waitAndGo('/home/<?php echo $_SESSION['UBER_USER_N']; ?>');
</script>