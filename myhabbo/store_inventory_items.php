<?php
ob_start();

require_once('../global.php');
$my_id = USER_ID;

$type = ucwords(($_POST['type']));
$type = substr($type, 0, -1);
if ($type == "backgrounds") {
    $type = "Background";
}
if ($type == "stickers") {
    $type = "Sticker";
}

if ($type == "widgets") {
    $type = "Widget";
}
if ($type == "notes") {
    $type = "Note";
}

if ($type == "Widget") {
    require_once('store_inventory_items_widgets.php');
    exit;
} //$type == "Widget"

if ($type == "Note") {
    require_once 'store_inventory_items_notes.php';
    exit;
} //$type == "Note"
var_dump($type);

$MyItems = "";
$getMyItems = db::query("SELECT * FROM site_inventory_items WHERE userId = ? AND type = ? AND isWaiting = '0'", $my_id, $type);
?>
    <ul id="inventory-item-list">
        <?php
        if ($getMyItems->rowCount() > 0) {
            for ($n = 0; $n <= 20; $n++) {
                while ($row = $getMyItems->fetch(2)) {
                    if (!str_contains($MyItems, $row['skin'])) {
                        $n++;
                        $MyItems .= $row['skin'] . ", ";
                        $getSameStickers = db::query("SELECT * FROM site_inventory_items WHERE userId = ? AND skin = '" . $row['skin'] . "' AND type = ? AND isWaiting = '0'", $my_id, $type)->rowCount();
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
                        <p>Para comprar algum colante acesse o catálogo, escolha o seu item preferido e clique em
                            comprar!</p>

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