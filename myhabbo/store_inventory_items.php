<?php
ob_start();

require_once('../global.php');
$my_id = USER_ID;

$type = ucwords(filter($_POST['type']));
$type = substr($type, 0, -1);

if ($type == "Widget") {
    require_once('store_inventory_items_widgets.php');
    exit;
} //$type == "Widget"
else if ($type == "Note") {
    require_once 'store_inventory_items_notes.php';
    exit;
} //$type == "Note"

$MyItems = "";
$getMyItems = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND type = '" . $type . "' AND isWaiting = '0'");
?>
    <ul id="inventory-item-list">
        <?php
        if ($getMyItems->num_rows > 0) {
            for ($n = 0; $n <= 20; $n++) {
                while ($row = $getMyItems->fetch_assoc()) {
                    if (!Contains($row['skin'], $MyItems)) {
                        $n++;
                        $MyItems .= $row['skin'] . ", ";
                        $getSameStickers = dbquery("SELECT * FROM site_inventory_items WHERE userId = '" . $my_id . "' AND skin = '" . $row['skin'] . "' AND type = '" . $type . "' AND isWaiting = '0'")->num_rows;
                        ?>
                        <li id="inventory-item-<?php
                        echo $row['id'];
                        ?>" title="">
                            <div class="webstore-item-preview <?php
                            echo $row['skin'];
                            ?> <?php
                            echo $row['type'];
                            ?>">
                                <div class="webstore-item-mask">
                                    <?php
                                    if ($getSameStickers > 1) {
                                        ?>
                                        <div class="webstore-item-count">
                                        <div>x<?php
                                            echo $getSameStickers;
                                            ?></div></div><?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                        <?php
                        if ($n == 1) {
                            header("X-JSON: [[\"Inventario\",\"" . "Catalogo" . "\"],[\"" . $row['skin'] . "\",\"" . $row['skin'] . "\",\"\",\"" . $row['type'] . "\",null," . $getSameStickers . "]]");
                        }
                    }
                }
                if ($n <= 19) {
                    ?>
                    <li class="webstore-item-empty"></li>
                    <?php
                } //$n <= 19
            }//$n = 0; $n <= 20; $n++
        } else {
            header("X-JSON: [[\"Inventario\",\"" . "Catalogo" . "\"],[]]");
            ?>
            <div class="webstore-frank">
                <div class="blackbubble">
                    <div class="blackbubble-body">

                        <p><b>Seu inventário está completamente vazio!</b></p>
                        <p>Para comprar algum colante acesse o catálogo, escolha o seu item preferido e clique em comprar!</p>

                        <div class="clear"></div>
                    </div>
                </div>
                <div class="blackbubble-bottom">
                    <div class="blackbubble-bottom-body">
                        <img src="<?php echo WWW; ?>/web-gallery/images/box-scale/bubble_tail_small.gif" alt=""
                             width="12" height="21" class="invitation-tail">
                    </div>
                </div>
                <div class="webstore-frank-image"><img src="<?php echo WWW; ?>/web-gallery/images/frank/sorry.gif"
                                                       alt="" width="57" height="88"></div>
            </div>
            <ul id="inventory-item-list">
                <li class="webstore-item-empty selected"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
                <li class="webstore-item-empty"></li>
            </ul>
            <?php
        }

        ?>
    </ul>
<?php
ob_end_flush();
?>