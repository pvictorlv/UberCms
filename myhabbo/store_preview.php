<?php
ob_start();
require_once('../global.php');
$coins = $users->GetUserVar(USER_ID, 'credits', false);

$productId = ($_POST['productId']);

$getPreview = db::query("SELECT * FROM site_shop_items WHERE id = ?", $productId);

if ($getPreview->rowCount() > 0) {
    $row = $getPreview->fetch(2);
} else {
    exit;
}
?>
    <h4 title="<?php echo $row['skin']; ?>"><?php echo $row['ItemName']; ?></h4>
    <div id="webstore-preview-box">
    <div class="<?php echo $row['skin']; ?> <?php echo $row['type']; ?>"
         id="webstore-preview-pre"><?php if ($row['type'] == "Background") { ?>
            <div id="webstore-preview-bgpreview"><a href="#" class="toolbutton" id="webstore-preview-bg"><span
                    id="webstore-preview-bg-<?php echo $row['skin']; ?>">Visualizar</span></a>
            </div><?php } ?><?php if ($row['amount'] > 0) { ?>
        <div id="webstore-preview-count" class="webstore-item-count">
            <div>x<?php echo $row['amount']; ?><?php } ?></div><?php if ($row['ItemPack'] > 0) { ?>
                <div id="webstore-preview-page">1/<?php echo $row['amount']; ?></div>
                <div id="webstore-preview-next"></div>
                <div id="webstore-preview-prev"></div><?php } ?></div>
    </div>

    <div id="webstore-preview-price">
        Preço:<br/><b>
            <?php echo $row['price']; ?> Moedas<?php if ($row['price'] > 1) {
                echo "s";
            } ?>

        </b>
    </div>

    <div id="webstore-preview-purse">
        Tem:<br/><b><?php if ($coins > 0) {
                echo $coins; ?> Moeda<?php } else {
                echo "Não tem moedas";
            }
            if ($coins > 1) {
                echo "s";
            } ?></b><br/>
        <?php if ($row['price'] > $coins) { ?>
            <span class="webstore-preview-error">Não tem moedas suficientes!</span><br>
            <a class="clearfix" webstore-preview-purchase="" href="../credits">Comprar </a>
        <?php } ?>
    </div>

    <div id="webstore-preview-purchase" class="clearfix">
        <div class="clearfix">
            <a href="#" class="new-button <?php if ($row['price'] > $coins) {
                echo "disabled-button\" disabled=\"disabled";
            } ?>" id="webstore-purchase"><b>Comprar</b><i></i></a>
        </div>
    </div>

    <span id="webstore-preview-bg-text" style="display: none">Visualizar</span>
<?php
$type = $row['type'];

if ($type == 'Background') {
    header('X-JSON: [{"bgCssClass":"' . $row['skin'] . '","type":"Background","itemCount":1,"previewCssClass":"' . $row['skin'] . '","titleKey":""}]');
} else if ($type == 'Sticker') {
    header('X-JSON: [{"type":"Sticker","itemCount":1,"previewCssClass":"' . $row['skin'] . '","titleKey":""}]');
}
ob_end_flush();
?>