<?php
require_once('../global.php');

$productId = filter($_POST['productId']);

$getItem = dbquery("SELECT * FROM site_shop_items WHERE id = '" . $productId . "'");

if ($getItem->num_rows > 0) {
    $row = $getItem->fetch_assoc();
} else {
    exit;
}
?>
<div class="webstore-item-preview <?php echo $row['skin']; ?> <?php echo $row['type']; ?>"
>
    <div class="webstore-item-mask">

    </div>
</div>

<p>
    Tem certeza de que quer comprar?
</p>

<p class="new-buttons">
    <a href="#" class="new-button" id="webstore-confirm-cancel"><b>Cancelar</b><i></i></a>
    <a href="#" class="new-button" id="webstore-confirm-submit"><b>Continuar</b><i></i></a>
</p>

<div class="clear"></div>
