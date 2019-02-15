<?php
ob_start();
require_once('../global.php');

$getCategorys = dbquery("SELECT * FROM site_items_categorys");
$getStickers = "";

$coins = $users->GetUserVar(USER_ID, 'credits', false);
?>
    <div style="position: relative;">
        <div id="webstore-categories-container">
            <h4>Categor&iacute;as:</h4>
            <div id="webstore-categories">
                <ul class="purchase-main-category">
                    <li id="maincategory-1-stickers" class="selected-main-category webstore-selected-main">
                        <div>Etiquetas</div>
                        <ul class="purchase-subcategory-list" id="main-category-items-1"><?php
                            $c = 0;
                            while ($row = $getCategorys->fetch_assoc()) {
                                ?>
                                <li id="subcategory-1-<?php $c++;
                                echo $row['id']; ?>-stickers" class="subcategory<?php if ($c == "1") {
                                    echo "-selected";
                                } ?>">
                                    <div><?php echo $row['name']; ?></div>
                                </li>
                                <?php if ($c == "1") {
                                    $getStickers = dbquery("SELECT * FROM site_shop_items WHERE categoryId = '" . $row['id'] . "'");
                                }
                            } ?>
                        </ul>
                    </li>
                    <li id="maincategory-2-backgrounds" class="main-category-no-subcategories">
                        <div>Fondos</div>
                        <ul class="purchase-subcategory-list" id="main-category-items-2">
                            <li id="subcategory-2-52-backgrounds" class="subcategory">
                                <div>store.subcategory.wallpapers</div>
                            </li>
                        </ul>
                    </li>
                    <li id="maincategory-6-stickie_notes" class="main-category-no-subcategories">
                        <div>Notas</div>
                        <ul class="purchase-subcategory-list" id="main-category-items-6">
                            <li id="subcategory-6-54-stickie_notes" class="subcategory">
                                <div>store.subcategory.all</div>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>

        <div id="webstore-content-container">
            <div id="webstore-items-container">
                <h4>Selecciona un producto haciendo clic sobre �l</h4>
                <div id="webstore-items">
                    <ul id="webstore-item-list">
                        <?php $s = 0;
                        for ($n = 0; $n <= 20; $n++) {
                            while ($row = mysql_fetch_assoc($getStickers)) {
                                $s++;
                                $n++; ?>
                                <li id="webstore-item-<?php echo $row['id']; ?>" title="">
                                    <div
                                        class="webstore-item-preview <?php echo $row['skin']; ?> <?php echo $row['type']; ?>">
                                        <div class="webstore-item-mask">

                                        </div>
                                    </div>
                                </li>
                                <?php if ($s == "1") {
                                    $price = $row['price'];
                                    header("X-JSON: [[\"Inventario\",\"" . unicodeText("Cat�logo") . "\"],[{\"type\":\"" . $row['type'] . "\",\"itemCount\":" . $row['amount'] . ",\"previewCssClass\":\"" . $row['skin'] . "\",\"titleKey\":\"\"}]]");
                                }
                            }
                            if ($n <= 19) { ?>
                                <li class="webstore-item-empty"></li>
                            <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <div id="webstore-preview-container">
                <div id="webstore-preview-default"></div>
                <div id="webstore-preview"><h4 title=""></h4>

                    <div id="webstore-preview-box"><?php if ($row['amount'] > 0) { ?>
                            <div class="webstore-item-count"><?php echo $row['amount']; ?>x
                            <div></div></div><?php } ?></div>

                    <div id="webstore-preview-price">
                        Precio:<br/><b>
                            <?php echo $price; ?> Cr�dito<?php if ($price > 1) {
                                echo "s";
                            } ?>

                        </b>
                    </div>

                    <div id="webstore-preview-purse">
                        Tem:<br/><b><?php if ($coins > 0) {
                                echo $coins; ?> Crédito<?php } else {
                                echo "Não tem moedas";
                            }
                            if ($coins > 1) {
                                echo "s";
                            } ?></b><br/>
                        <?php if ($price > $coins) { ?>
                            <span class="webstore-preview-error">Não tem moedas suficientes</span><br>
                            <a class="clearfix" webstore-preview-purchase="" href="../credits">Comprar
                                moedas</a>
                        <?php } ?>

                        <a href="../credits">Obter moedas</a>
                    </div>

                    <div id="webstore-preview-purchase" class="clearfix">
                        <div class="clearfix">
                            <a href="#" class="new-button" id="webstore-purchase"><b>Comprar</b><i></i></a>
                        </div>
                    </div>

                    <span id="webstore-preview-bg-text" style="display: none">Visualizar</span>
                </div>
            </div>
        </div>

        <div id="inventory-categories-container">
            <h4>Categorias:</h4>
            <div id="inventory-categories">
                <ul class="purchase-main-category">
                    <li id="inv-cat-stickers" class="selected-main-category-no-subcategories">
                        <div>Etiquetas</div>
                    </li>
                    <li id="inv-cat-backgrounds" class="main-category-no-subcategories">
                        <div>Fundos</div>
                    </li>
                    <li id="inv-cat-widgets" class="main-category-no-subcategories">
                        <div>Elementos</div>
                    </li>
                    <li id="inv-cat-notes" class="main-category-no-subcategories">
                        <div>Notas</div>
                    </li>
                </ul>

            </div>
        </div>

        <div id="inventory-content-container">
            <div id="inventory-items-container">
                <h4>Selecione um produto clicando nele.</h4>
                <div id="inventory-items">
                    <ul id="inventory-item-list">
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
                        <li class="webstore-item-empty"></li>
                    </ul>
                </div>
            </div>
            <div id="inventory-preview-container">
                <div id="inventory-preview-default"></div>
                <div id="inventory-preview"><h4>&nbsp;</h4>

                    <div id="inventory-preview-box"></div>

                    <div id="inventory-preview-place" class="clearfix">
                        <div class="clearfix">
                            <a href="#" class="new-button" id="inventory-place"><b>Colocar</b><i></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="webstore-close-container">
            <div class="clearfix"><a href="#" id="webstore-close" class="new-button"><b>Fechar</b><i></i></a></div>
        </div>
    </div>
<?php
ob_end_flush();
?>